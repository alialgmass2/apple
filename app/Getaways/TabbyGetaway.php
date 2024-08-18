<?php

namespace App\Getaways;

use App\Dtos\TabbyTransactionDTO;
use App\Models\checkouts\orders\Order;
use App\Models\checkouts\PaymentTransaction;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use DB;
use Illuminate\Support\Facades\Log;

class TabbyGetaway
{
    public const base_url = "https://api.tabby.ai/api/v2";

    public static function checkout($data)
    {


        $url = self::base_url . "/checkout";

        $userData = $data['data'];

        $body = [
            'payment' => [
                'amount' =>number_format($userData['amount'], 2,'.',''),
                'currency' => 'SAR',
                'description' => 'string',
                'buyer' => [
                    'phone' => $userData['phone'] ?? 'string',
                    'email' => auth()->user()->email ?? 'string',
                    'name' =>$userData['fname'] ?? 'string',
                    'dob' =>  '2006-01-02'
                ],
                'shipping_address' => [
                    'city' => 'string',
                    'address' => $userData['address'],
                    'zip' => $userData['zip'] ?? '123',
                ],
                'order' => [
                    'tax_amount' =>number_format($data['other']['tax'], 2,'.',''),
                    'shipping_amount' =>number_format($data['other']['delivery_price'],2,'.',''),
                    'discount_amount' =>number_format($data['other']['discount'],2,'.',''),
                    'updated_at' => "2019-08-24T14:15:22Z",
                    'reference_id' => (string)$data['order_id'],
                    'items' => self::getItems($data)
                ],
                'buyer_history' => [
                    "registered_since" => "2019-08-24T14:15:22Z",
                    "loyalty_level" => auth()->user()->orders()->count(),
                    "wishlist_count" => auth()->user()->orders()->where('payment_status','0')->where('payment_method','!=','cash')->count(),
                    "is_social_networks_connected" => true,
                    "is_phone_number_verified" => true,
                    "is_email_verified" => true
                ],
                'order_history' => self::getOrderHistory(),
                'meta' => [
                    'order_id' => (string)$data['order_id'],
                    'customer' => (string)auth()->user()->id
                ],
                'attachment' => [
                    'body' => '{"flight_reservation_details":{"pnr":"TR9088999","itinerary":[],"insurance":[],"passengers":[],"affiliate_name":"some affiliate"}}',
                    'content_type' => 'application/vnd.tabby.v1+json'
                ],
            ],


            'lang' => 'en',
            'merchant_code' => 'jawraa',
            'merchant_urls' => [
                'success' => route('checout.TabbySuccess'),
                'cancel' => route('checout.cancelTabby'),
                'failure' => route('checout.failureTabby')
            ],
        ];

   //  dd($body);
// Send the HTTP POST request
        $response = Http::withHeaders([
            'Authorization' => 'Bearer ' . env('tappyToken')
        ])->post($url, $body);


        $responseBody = $response->json();

        $data['res'] = $responseBody;

        \Cache::put('order' . auth()->user()->id, $data);
   //dd($responseBody);
        try {
            if (isset($responseBody['configuration']['available_products']['installments'][0]['web_url'])) {

                $webhochData=self::weHock(route('checout.getWebHock'));

              DB::table('webhock')->insert([
    'order_id' => $data['order_id'],
    'payload' => json_encode($webhochData),
    'payment_id' => $responseBody['payment']['id'],
    'created_at' => now()->format('Y-m-d H:i:s')
]);


                return redirect($responseBody['configuration']['available_products']['installments'][0]['web_url']);
            }
//            elseif (isset($responseBody['configuration']['products']['installments']['rejection_reason'])) {
//                return redirect()->route('checout.failureTabby')->with('message', $responseBody['configuration']['products']['installments']['rejection_reason']);
//            }
            else {
                return redirect()->route('checout.failureTabby')->with(['message'=> 'Sorry, Tabby is unable to approve this purchase. Please use an alternative payment method for your order.','icon'=>'error']);
            }
        }catch (\Exception $exception){
            return redirect()->route('checout.failureTabby')->with(['message'=> 'Sorry, Tabby is unable to approve this purchase. Please use an alternative payment method for your order.','icon'=>'error']);
        }


    }

    public static function captureRequest($data,$id=null)
    {
        $url = self::base_url . "/payments/" . ($id ?? $_GET['payment_id'] ). "/captures";

        $body = [
            "amount" => number_format($data['data']['amount'],2,'.',''),
        ];
        $response = Http::withHeaders([
            'Authorization' => 'Bearer sk_52aeb1f2-604f-47d3-9606-d0705ec00e87'
        ])->post($url, $body);

        return $response->json();
    }

    public static function retrieve($id=null)
    {
        $url = self::base_url . "/payments/" .($id ??  $_GET['payment_id']);

        $response = Http::withHeaders([
            'Authorization' => 'Bearer sk_52aeb1f2-604f-47d3-9606-d0705ec00e87'
        ])->get($url);
        return $response->json();
    }

    public static function getStatus()
    {
        $url = self::base_url . "/checkout/" . $_GET['payment_id'];

        $response = Http::withHeaders([
            'Authorization' => 'Bearer sk_52aeb1f2-604f-47d3-9606-d0705ec00e87'
        ])->get($url);
        return $response->json();
    }

    public static function weHock($link)
    {
        $url = "https://api.tabby.ai/api/v1/webhooks";

        $response = Http::withHeaders([
            'Authorization' => 'Bearer sk_52aeb1f2-604f-47d3-9606-d0705ec00e87',
            'X-Merchant-Code'=>'jawraa'
        ])->post($url, [
            "url" => $link,
            "is_test" => true,
            "header"=>[
                'title'=>'kljmlkkl',
                'value'=>'klnmkmkl'
            ]
        ]);
      //  dd($response->json());
        return $response->json();
    }

    private static function getOrderHistory()
    {

        $pastOrders=auth()->user()->orders()->whereHas('payment_transaction',function ($q){

            $q->where(function ($q){
                $q->where('status',1)->whereNot('method','cash');
            })->orwhere('method','cash');

        })->latest()->limit(5)->get();
        return $pastOrders->map(function ($order){
            $data=[];
            $data['items']=$order->items()->get();

            return [
                'purchased_at' => "2019-08-24T14:15:22Z",
                'amount' =>number_format($order->total,2,'.',''),
                'payment_method' => $order->payment_method,
                'status' =>  'new' ,
                'buyer' => [
                    'phone' => $order->addresses->phone  ?? 'string',
                    'email' => auth()->user()->email  ?? 'string',
                    'name' =>$order->addresses->fname  ?? 'string',
                    'dob' => auth()->user()->crated_at  ?? '2006-01-02'
                ],
                'shipping_address' => [
                    'city' =>  $order->addresses->city->name_en ?? 'string',
                    'address' => $order->addresses->address ?? 'string' ,
                    'zip' => $order->addresses->zip_code ?? 'string',
                ],
                'items' => self::getItems($data, 'h')
            ];
        })->toArray();
    }

    private static function getItems($data, $type = 'n')
    {
        $items = collect($data['items'])->map(function ($item) use ($type) {
            $it = [
                'title' => $item->product->title_en,
                'description' => $item->product->description_en,
                'quantity' => $item->quantity,
                'unit_price' =>number_format($item->total,2,'.',''), // Correctednumber_format usage
                'discount_amount' =>number_format($item->discount,2,'.',''), // Correctednumber_format usage
                'reference_id' => (string)$item->id, // Consider using a unique identifier instead of 'string'
                'image_url' => $item->product->getFile('banner') ?? ' ',
                'product_url' => route('user.organization.product', $item->product->id),
                'gender' => 'Male',
                'category' => $item->product->category->name_en ?? 'string',
                'color' => (string)$item->getColor() ?? ' ',
                'product_material' => 'string',
                'size_type' => 'string',
                'size' => 'string',
                'brand' => 'string'
            ];
            if ($type != 'n') {
                $q = ["ordered" => 0,
                    "captured" => 0,
                    "shipped" => 0,
                    "refunded" => 0];
                $it = array_merge($q, $it);
            }
            return $it;
        })->toArray();
        return $items;
    }
    public function get_payments_data($transaction_id)
    {
        $response = Http::withToken('sk_52aeb1f2-604f-47d3-9606-d0705ec00e87')->asForm()->get("https://api.tabby.ai/api/v2/payments");
        dd($response->json());
        if ($response->successful()) {
            return new TabbyTransactionDTO($response->json());
        } else {
            dd($response->json(),$transaction_id);
//            Log::error('Error response from server: ', ['response' => $response->body()]);
            return null; // Or handle the error as needed
        }
    }
}

