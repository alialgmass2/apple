<?php

namespace App\Services\Transactions;

use App\Dtos\TabbyTransactionDTO;
use App\Dtos\TransactionDTO;
use App\Models\checkouts\orders\Order;
use App\Models\checkouts\Transactions\Transaction;
use App\Models\PaymentTransaction;
use Carbon\Carbon;
use Illuminate\Support\Facades\Http;
use Log;

class TransactionService
{
    public function getEntityId($method)
    {
        $entityId = env('visaMasterEntityId');
        if ($method == 'MADA') {

            $entityId = env('madaEntityId');
        }
        return $entityId;
    }
    public  function create($method ='VISA')
    {
        $format = 'Y-m-d H:i:s';
        $from = Carbon::now()->subMonths(30)->format($format);
        $to =   Carbon::now()->format($format);
        $data = [
            'entityId' => $this->getEntityId($method),
            'date.from' => $from,
            'date.to' => $to,
            'limit' => '500'
            // 'currency' => 'SAR',
//            'testMode' => 'INTERNAL'
        ];
            $response = Http::withToken(env('payment_token'))
                ->get('https://eu-prod.oppwa.com/v3/query', $data);

                $records = [];
                foreach ($response->json()['records'] as $record) {
                    if ($record['paymentType'] == 'DB') {
                        $data =  new TransactionDTO($record);
                        $transaction =  PaymentTransaction::where('transaction_id',$data->merchantTransactionId)->first();
                        $transaction ? $order[] = $transaction : '';
//                        $records[]= Transaction::create([
//                             'transaction_id'=>$data->merchantTransactionId ,
//                             'amount'=>$data->amount,
//                             'order_id'=>$order ? $order->id : 0,
//                             'type'=>'hyper_pay',
//                             'payment_method'=>$data->paymentBrand,
//                             'status'=>$data->result['code'] =='000.000.000' ,
//                             'status_message'=>$data->result['description'],
//                             'last4Digits'=>$data->card['last4Digits'],
//                             'user_name'=>$data->customer['givenName'] .' '. $data->customer['surname'],
//                             'user_email'=>$data->customer['email'],
//                             'user_phone'=>$order ? $order->addresses->phone : '',
//                             'payment_type'=>'debit',
//                        ]);

                    }
                }
dd($order);
    }
    public function tabby()
    {
        $response = Http::withToken('sk_52aeb1f2-604f-47d3-9606-d0705ec00e87')->asForm()->get("https://api.tabby.ai/api/v2/payments");
        if ($response->successful()) {
            dd($response->json());

            return new TabbyTransactionDTO($response->json());
        } else {
            dd($response->json());
//            Log::error('Error response from server: ', ['response' => $response->body()]);
            return null; // Or handle the error as needed
        }
    }
}
