<?php

namespace App\Http\Controllers\checkouts;

use App\Dtos\FetchCitiesRequestDTO;
use App\Getaways\TabbyGetaway;
use App\Http\Controllers\Controller;
use App\Http\Requests\checkouts\StoreRequest;
use App\Mail\OrderMail;
use App\Models\checkouts\Address;
use App\Models\checkouts\orders\Order;
use App\Models\checkouts\orders\OrderItems;
use App\Models\checkouts\PaymentTransaction;
use App\Models\Region;
use App\Services\AramexService;
use App\Services\PaymentsService;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Log;
use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\InvoiceDate;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\Seller;
use Salla\ZATCA\Tags\TaxNumber;

class CheckoutController extends Controller
{
    private PaymentsService $paymentsService;
    public string $type ='';
    public function __construct(PaymentsService $paymentsService)
    {
        $this->paymentsService = $paymentsService;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = auth()->user();
        if ($user->cart()->count() == 0) {
            return redirect()->route('carts.index');
        }
        // $cities = City::pluck('name_en', 'id')->toArray();
        $regions = Region::pluck(toLocale('name'), 'id')->toArray();
        // $regions = Region::select('id',toLocale('name'))->get();
        $products = $this->getProducts();
        $sub_total = $products['sub_total'];
        $discount = $products['discount'];
        $total = $products['total'];
        $tax = $products['tax'];
        $delivery_price = $products['delivery_price'];
        $products_arr = $products['products'];
        // return view('checouts.checkout.checkouts', compact('sub_total', 'discount', 'tax', 'total', 'products_arr', 'cities', 'regions', 'delivery_price'));
        return view('checouts.checkout.checkouts', compact('sub_total', 'discount', 'tax', 'total', 'products_arr', 'regions', 'delivery_price'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {

        $user = auth()->user();
        if ($user->cart()->count() == 0) {
            return redirect()->route('carts.index')->with('message', 'payment faild.');
        }

        $merchantTransactionId = $user->id . time();

        $data = $request->validated();
        $this->type = $data['type'];
        if ($data['type'] == 'organization') {
            $data['address'] = auth()->user()->organization->address ?? 'organization address';
        }
        $product_data = $this->getProducts($data['type']);
        $products = $product_data['products'];

        $data['delivery_cost'] = auth()->user()->organization->delivery_price;
        $data['vat'] = 15;
        $data['amount'] = $product_data['total'];
        $data['merchantTransactionId'] = $merchantTransactionId;

        $methods = $data['methods'];
        $data['order_id'] = time() . auth()->user()->id;
        $order = ['data' => $data, 'products' => $products, 'other' => $product_data];
        Cache::put('order' . auth()->user()->id, $order);
        // if ($data['payment_option'] == 'card') {
        if ($data['methods'] == 'tabby') {
            try {
                $order = $this->sttabbyfirst($order);
                return TabbyGetaway::checkout($order);
            } catch (\Exception $exception) {
                return redirect()->route('checout.failureTabby')->with(['message'=> 'Sorry, Tabby is unable to approve this purchase. Please use an alternative payment method for your order.','icon'=>'error']);
            }

        } else if ($data['methods'] != 'cash') {
            $id = $this->paymentsService->create_request($data, $order);
            if ($id == '') {
                return redirect()->route('user.checouts.create')->with('payment faild try another time');
            }
            return view('checouts.checkout.paymentform', compact('id', 'methods'));

            // return $this->checkPaymentStatus($res, $order);
        } else {
            $order['data']['methods'] = 'cash';
            $order_id = $this->storeOrder($order, 0);
            $this->storeOrderItems($order_id, $order['products']);
            auth()->user()->cart()->delete();
            $this->sendMail($order_id);
            // return redirect()->route('checout.order.index')->with('message', 'order created  successfully.');
            return redirect()->route('user.orders.index')->with('message', 'order created successfully.');
        }


    }

    public function sttabbyfirst($payment_data)
    {


        $order_id = $this->storeOrder($payment_data, 0);
        $items = $this->storeOrderItems($order_id, $payment_data['products']);
        $payment_data['items'] = $items;
        $payment_data['order_id'] = $order_id;


        return $payment_data;

    }

    public function getWebHock(Request $request)
    {

        $data = $request->json()->all();


        $order_id = $data['order']['reference_id'];
        $webhock= \DB::table('webhock')->where('order_id',$order_id)->latest()->first();
        $id=$webhock->payment_id;
        $payment_data = [
            'order_id' => $order_id,
            'data' =>
                ['amount' => $data['amount'] ?? 0]
        ];
        $order = Order::find($payment_data['order_id']);
        if(  $order && $order->payment_status ==0){
            $res_ret = TabbyGetaway::retrieve($id);

            if (!(isset($res_ret['status']) && $res_ret['status'] = 'Authorized ')) {
                $this->removeOrder($order_id);
            }
            $res_cap = TabbyGetaway::captureRequest($payment_data, $id);

            if (!(isset($res_cap['status']) && $res_cap['status'] = 'CLOSED ')) {
                $this->removeOrder($order_id);
            }


            if($order){
                $order->update([
                    'payment_status' => 1,
                ]);
                $order->payment_transaction()->update(['status' => 1]);
                $order->user->cart()->delete();
                Cache::forget('order' . $order->user->id);
            }
        }


        return response()->json(['message' => 'order created  successfully.']);
    }

    public function storeTabby($id = null)
    {
        $payment_data = Cache::get('order' . auth()->user()->id);
        $res_ret = TabbyGetaway::retrieve();
        if (!(isset($res_ret['status']) && $res_ret['status'] = 'Authorized ')) {

            return    $this->failureTabby();
        }

        $res_cap = TabbyGetaway::captureRequest($payment_data);
        if (!(isset($res_cap['status']) && $res_cap['status'] = 'CLOSED ')) {

            return   $this->failureTabby();
        }
        $order = Order::find($payment_data['order_id']);
        $order->update([
            'payment_status' => 1,
        ]);
        $order->payment_transaction()->update(['status' => 1]);
        $this->sendMail($payment_data['order_id']);
        auth()->user()->cart()->delete();
        Cache::forget('order' . auth()->user()->id);
        return redirect()->route('user.orders.index')->with(['message'=> 'order created  successfully.']);
    }

    public function cancelTabby()
    {

        $payment_data = Cache::get('order' . auth()->user()->id);
        $this->removeOrder($payment_data['order_id']);
        Cache::forget('order' . auth()->user()->id);
        return redirect()->route('checouts.create')->with(['message'=> 'payment canceled','icon'=>'error']);
    }

    public function failureTabby()
    {

        $payment_data = Cache::get('order' . auth()->user()->id);
        // dd($payment_data);
        if (isset($payment_data['order_id'])) {
            $this->removeOrder($payment_data['order_id']);
        } else {
            $this->removeOrder($payment_data['data']['order_id']);
        }

        Cache::forget('order' . auth()->user()->id);
//        if (isset($payment_data['res']['configuration']['products']['installments']['rejection_reason'])) {
//            return redirect()->route('checouts.create')->with('message', $payment_data['res']['configuration']['products']['installments']['rejection_reason']);
//        }
        return redirect()->route('checouts.create')->with(['message'=> 'Sorry, Tabby is unable to approve this purchase. Please use an alternative payment method for your order.','icon'=>'error']);;
    }

    public function removeOrder($order_id)
    {
        $order = Order::find($order_id);
        if ($order) {
            $order->items()->delete();

            $order->delete();

        }
    }

    public function checkPaymentStatus()
    {
        $res = $this->paymentsService->checkPaymentStatus();

        if (isset($res) && $res['result']['code'] == '000.000.000') {

            $payment_data = Cache::get('order' . auth()->user()->id);
            $payment_data['data']['payment_id']=$res['id'];
            try {
                DB::beginTransaction();
                $order_id = $this->storeOrder($payment_data);

                $this->storeOrderItems($order_id, $payment_data['products']);
                DB::commit();
            } catch (\Exception $exception) {
                DB::rollBack();
                $data = $payment_data['data'];

                return redirect()->route('checouts.create')->with('message', $exception->getMessage());
            }
            auth()->user()->cart()->delete();
            $this->sendMail($order_id);
            // return redirect()->route('checout.order.index')->with('message', 'payment success.');
            return redirect()->route('user.orders.index')->with('message', 'order created  successfully.');

        } else {
            $payment_data = Cache::get('order' . auth()->user()->id);
            $data = $payment_data['data'];
            $transaction_id = $this->storePayment($data, 0);
            if (isset($res['result'])) {
                return redirect()->route('checouts.create')->with('message', implode(',', $res['result']));
            }
            return redirect()->route('checouts.create')->with('message', 'payment faild.');
        }

    }


    private function storeOrder($payment_data, $payment_status = 1)
    {
        $data = $payment_data['data'];
        $transaction_id = $this->storePayment($data, $payment_status);
        $address_id = $this->storeAdress($payment_data['data']);
        $order = Order::create([
            'order_number' => $data['merchantTransactionId'],
            'user_id' => auth()->user()->id,
            'address_id' => $address_id,
            'payment_status' => $payment_status,
            'order_details' => ['vat'=>$data['vat'],'delivery_cost'=>$data['delivery_cost']],
            'payment_method' => $payment_data['methods'] ?? 'cash',
            'payment_transaction_id' => $transaction_id,
            'subtotal' => $data['amount'],
            'total' => $data['amount'],
        ]);
        $data = [
            'user_id' => auth()->user()->id,
            'order_id' => $order->id,
            'type' => 'create',
        ];
        sendNotification($data);
        return $order->id;

    }

    private function storeOrderItems($order_id, $products)
    {
        $items = [];
        foreach ($products as $product) {
            $items[] = OrderItems::create([
                'order_id' => $order_id,
                'product_id' => $product['id'],
                'price' => $product['amount'],
                'quantity' => $product['quantity'],
                'vat' => $product['vat'],
                'discount' => $product['discount'],
                'color_code' => $product['color_code'],
                'total' => $product['subTotal'],
            ]);
        }
        return $items;
    }

    private function storePayment($data, $satus)
    {
        $payment = PaymentTransaction::create([
            'amount' => $data['amount'],
            'status' => $satus,
            'method' => $data['methods'],
            'user_id' => auth()->user()->id,
            'transaction_id' => $data['merchantTransactionId'],
            'payment_id'=>$data['payment_id']
        ]);
        return $payment->id;
    }

    private function storeAdress($data)
    {
        if ($data['type'] == 'organization') {
            $address = Address::create([
                'user_id' => auth()->user()->id,
                'address' => $data['address'],
                'phone' => $data['phone'],
                'country_code' => 20,
                'fname' => $data['fname'],
                'lname' => $data['lname'],
                // 'short_national_id' => $data['short_national_id'] ?? '',
                // 'zip_code' => $data['zip'] ?? '',
                'type' => $data['type'],
                // 'region_id' => $data['state'] ?? '',
                // 'city_id' => $data['city'] ?? '',
                // 'distracts' => $data['distracts'] ?? '',

            ]);

        } else {
            $address = Address::create([
                'user_id' => auth()->user()->id,
                'address' => $data['address'],
                'phone' => $data['phone'],
                'country_code' => 20,
                'short_national_id' => $data['short_national_id'],
                'zip_code' => $data['zip'],
                'type' => $data['type'],
                'region_id' => $data['state'],
                'city_id' => $data['city'],
                'distracts' => $data['distracts'],
                'fname' => $data['fname'],
                'lname' => $data['lname'],

            ]);

        }
        return $address->id;
    }

    private function getProducts($type = '')
    {
        $user = auth()->user();
        $carts = $user->cart()->with('product')->get();
        $amount = 0;
        $discount = 0;
        $products = [];
        foreach ($carts as $cart) {
            $totalS = $cart->price * $cart->quantity;
            $amount += $totalS;
            $discount += $totalS * getPrice($cart->product_id) / 100;
            $subTotal = $amount - $discount;
            if ($this->type && $this->type != 'organization') {
                $subTotal += auth()->user()->organization->delivery_price / count($carts);
            }
            $tax = $subTotal * 15 / 100;
            $subTotal += $tax;
            $product = $cart->product()->first();
            $products[] = [
                'id' => $product->id,
                'image' => $cart->product->getFile('default_img'),
                'amount' => $cart->price * $cart->quantity,
                'vat' => $tax,
                'discount' => $discount,
                'subTotal' => $subTotal,
                'quantity' => $cart->quantity,
                'title' => $cart->product->translate('title'),
                'product' => $cart->product,
                'color_code' => $cart->getColor()
            ];
        }

//        $discount = $user->organization->discount;
        if ($type != '' && $type == 'organization') {
            $delivery_price = 0;
        } else {
            $delivery_price = $user->organization->delivery_price;
        }

        $total = $amount - $discount;
        $amount += $delivery_price;
        $total += $delivery_price;
        $tax = $total * 15 / 100;
        $total += $tax;

        return ['products' => $products, 'discount' => $discount, 'total' => $total, 'tax' => $tax, 'sub_total' => $amount, 'delivery_price' => $delivery_price];
    }
    public function sendMail($order_id){
        $order =Order::find($order_id);
        $qr=$this->createQr($order);
        \Mail::to(auth()->user()->email)->send(new OrderMail($order,$qr));
    }
    public function createQr($order){
        return GenerateQrCode::fromArray([
            new Seller('شركة ضوابط التقنية للتجارة'), // seller name
            new TaxNumber('300925605200003'), // seller tax number
            new InvoiceDate($order->created_at), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
            new InvoiceTotalAmount($order->total), // invoice total amount
            new InvoiceTaxAmount(number_format($order->total*15/100)) // invoice tax amount sell
            // TODO :: Support others tags
        ])->render();
    }


}
