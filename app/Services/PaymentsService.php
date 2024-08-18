<?php

namespace App\Services;


use App\Dtos\TransactionDTO;
use App\Models\checkouts\PaymentTransaction;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Log;

class PaymentsService
{
    public string $url = 'https://eu-prod.oppwa.com/v1/checkouts';
    public string $payment_url = 'https://eu-prod.oppwa.com/v1/registrations';

    public function create_request($data, $order)
    {
        $payment_data = [
            'entityId' => $this->getEntityId($data['methods']),
            'amount' => number_format(round($data['amount'], 2), 2, '.', ''),
            'currency' => 'SAR',
            'customParameters[3DS2_enrolled]' => true,
            // 'customParameters[order]' => $order,
            //  'customParameters[method]' => $data['methods'],
            'customer.email' => auth()->user()->email,
            'billing.street1' => $data['address'],
            'billing.city' => toExists('city', $data) ? $data['city'] : '',
            'billing.state' => toExists('state', $data) ? $data['state'] : '',
            'billing.country' => 'SA',
            'billing.postcode' => $data['zip'],
            'customer.givenName' => $data['fname'],
            'customer.surname' => $data['lname'],
            'merchantTransactionId' => $data['merchantTransactionId'],
            'paymentType' => 'DB',

            'shopperResultUrl' => route('checouts.checkPaymentStatus')
        ];

//        if (!$data['methods'] == 'MADA') {
//
//            $payment_data['testMode'] = 'EXTERNAL';
//
//        }

        $res = Http::withToken(env('payment_token'))->asForm()->post($this->url, $payment_data);

        $id = '';

        if (isset($res->json()['id'])) {
            $id = $res->json()['id'];

        }
        return $id;
    }

    public function getEntityId($method)
    {
        $entityId = env('visaMasterEntityId');
        if ($method == 'MADA') {

            $entityId = env('madaEntityId');


        }
        return $entityId;
    }

    public function payment($data)
    {
        if (strlen($data['expiryMonth']) == 1) {
            $data['expiryMonth'] = '0' . $data['expiryMonth'];
        }
        if (strlen($data['expiryYear']) == 2) {
            $data['expiryYear'] = '20' . $data['expiryYear'];
        }
        $payment_data = [
            'entityId' => $this->getEntityId($data['methods']),
            'amount' => number_format(round($data['amount'], 2), 2, '.', ''),
            'currency' => 'SAR',
            'customParameters[3DS2_enrolled]' => true,
            'customer.email' => auth()->user()->email,
            'billing.street1' => $data['address'],
            'billing.city' => toExists('city', $data) ? $data['city'] : '',
            'billing.state' => toExists('state', $data) ? $data['state'] : '',
            'billing.country' => 'SA',
            'billing.postcode' => $data['zip'],
            'customer.givenName' => $data['fname'],
            'customer.surname' => $data['lname'],
            'merchantTransactionId' => $data['merchantTransactionId'],

            'paymentBrand' => $data['methods'],
            'card.number' => $data['card_number'],
            'card.holder' => $data['holder_name'],
            'card.expiryMonth' => $data['expiryMonth'],
            'card.expiryYear' => $data['expiryYear'],
            'card.cvv' => $data['cvv'],
            //'shopperResultUrl' => route('checouts.checkPaymentStatus'),
        ];
        if (!$data['methods'] == 'MADA') {

            $payment_data['testMode'] = 'EXTERNAL';

        }
        $res = Http::withToken(env('payment_token'))->asForm()->post($this->payment_url, $payment_data);

        return $res;

    }

    public function checkPaymentStatus()
    {
        $id = $_GET['id'];

        $payment_data = Cache::get('order' . auth()->user()->id);

        $entityId = $this->getEntityId($payment_data['data']['methods']);

        $res = Http::withToken(env('payment_token'))->asForm()->get('https://eu-prod.oppwa.com/v1/checkouts/' . $id . '/payment', [

            'entityId' => $entityId,

        ]);
        $res = $res->json();

        return $res;


    }

    public function checkPaymentStatusSecound()
    {
        $id = $_GET['id'];

        $payment_data = Cache::get('order' . auth()->user()->id);

        $entityId = $this->getEntityId($payment_data['data']['methods']);

        $res = Http::withToken(env('payment_token'))->asForm()->get(' https://eu-prod.oppwa.com/v1/payments/' . $id, [

            'entityId' => $entityId,

        ]);
        $res = $res->json();
        return $res;


    }

    public function get_transactions_from_to(?string $from = null, ?string $to = null, $method = "VISA")
    {
        $format = 'Y-m-d H:i:s';
        $from = $from ? Carbon::parse($from)->format($format) : Carbon::now()->subMonths(1)->format($format);
        $to = $to ? Carbon::parse($to)->format($format) : Carbon::now()->format($format);
        $data = [
            'entityId' => $this->getEntityId($method),
            'date.from' => $from,
            'date.to' => $to,
            'limit' => '300'
            // 'currency' => 'SAR',
//            'testMode' => 'INTERNAL'
        ];


        try {

            $response = Http::withToken(env('payment_token'))
                ->get('https://eu-prod.oppwa.com/v3/query', $data);
            if ($response->successful()) {
                $records = [];
                foreach ($response->json()['records'] as $record) {
                    if ($record['paymentType'] == 'DB') {
                        array_push($records, new TransactionDTO($record));
                    }
                }

                return $records;
            } else {
                Log::error('Error response from server: ', ['response' => $response->body()]);

                return []; // Or handle the error as needed
            }
        } catch (\Exception $e) {
            dd($e->getMessage());
            Log::error('HTTP Request failed: ', ['error' => $e->getMessage()]);
            return []; // Or handle the error as needed
        }
    }

    public function refund($transaction_id)
    {
        $payment = PaymentTransaction::where('transaction_id', $transaction_id)->first();
        $id = $payment->payment_id;
        if (!isset($id)) {
            $paymentFromHyperPay = $this->get_payment_with_transaction_id($transaction_id);
            $id = $paymentFromHyperPay->id ?? null;
        }
        if (isset($id)) {
            $data = [
                'entityId' => $this->getEntityId($payment->method ?? 'VISA'),
                'amount' => $payment->amount,
                'paymentType' => 'RF',
                'currency' => 'SAR',

            ];
            $res = Http::withToken(env('payment_token'))->asForm()->post('https://eu-prod.oppwa.com/v1/payments/' . $id, $data);
            return $res->json();
        }
        return [];

    }

    public function get_payment_with_transaction_id($transaction_id, $method = 'MADA',$id = null)
    {
        try {

            $payment = PaymentTransaction::where('transaction_id', $transaction_id)->first();
            $data = [
                'entityId' => $this->getEntityId(strtoupper($payment->method ?? $method)),
                'merchantTransactionId' => '1291722248012'
            ];

            $response = Http::withToken(env('payment_token'))->asForm()->get('https://eu-prod.oppwa.com/v3/query', $data);
            if ($response->successful()) {
                $record = [];
                foreach ($response->json()['records'] as $record_item) {
                    if ($record_item['paymentType'] == 'DB') {
                        if($id){
                            if ($record_item['id'] == $id){
                                $record = $record_item;
                            }
                        }else{
                            $record = $record_item;
                        }
                    }
                }
                return new TransactionDTO($record);
            } else {

                Log::error('Error response from server: ', ['response' => $response->body()]);
                return null; // Or handle the error as needed
            }
        } catch (Exception $e) {
            Log::error('HTTP Request failed: ', ['error' => $e->getMessage()]);
            return null; // Or handle the error as needed
        }
    }
}


//        $url = '';
//        if (isset($res->json()['redirect'])) {
//            $redirect = $res->json()['redirect'];
//            $base_url=$redirect['url'];
//            $params=$redirect['parameters'];
//            foreach ($params as $key=>$value){
//                if($key==0){
//                    $url=$base_url.'?'.$value['name'].'='.$value['value'];
//                }else{
//                    $url.='&'.$value['name'].'='.$value['value'];
//                }
//            }
//
//        }
//        return $url;
