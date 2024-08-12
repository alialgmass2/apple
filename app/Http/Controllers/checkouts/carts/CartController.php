<?php

namespace App\Http\Controllers\checkouts\carts;

use App\Http\Controllers\Controller;
use App\Http\Requests\checkouts\carts\StoreRequest;
use App\Models\checkouts\catrs\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $carts = auth()->user()->cart()->with('product')->get();
      //  $product_ids = auth()->user()->cart()->pluck('product_id')->toArray();

        $sub_total = 0;
        $discount = 0;

        foreach ($carts as $cart) {
            $totalS = $cart->price * $cart->quantity ;
            $sub_total += $totalS;
            $discount += $totalS * getPrice($cart->product_id)/100;
        }
//        dd($discount);
        $delivery_price=0;
        if($sub_total!=0){
            $delivery_price=auth()->user()->organization->delivery_price;
        }
        $total = $sub_total -  $discount ;

        $tax = $total * 15 / 100;
        $total += $tax;
//        dd($total,$tax,$sub_total,$discount);
        return view('checouts.cart.carts', compact('carts','tax', 'sub_total','delivery_price', 'discount', 'total'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::pluck('name', 'id')->toArray();

// view
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $res = addCart($request->product_id);
        if ($res == 'maxNum'){
            return redirect()->route('products')->with('message','you have max number in cart');
        }else{
            return redirect()->route('products')->with('message','add successfully');
        }
    }

    public function update(Cart $cart, Request $request)
    {
        $request->validate(['type' => 'required|in:+,-']);
        if ($request->type == '+') {
            $max_product_in_cart=auth()->user()->organization->max_order_number;
            $current =auth()->user()->cart()->sum('quantity');
            if($current<$max_product_in_cart){
                $cart->update(['quantity' => $cart->quantity + 1]);
            }

        }
        if ($request->type == '-') {
            if ($cart->quantity > 1) {
                $cart->update(['quantity' => $cart->quantity - 1]);
            }
        }
        return redirect()->route('carts.index');

    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return $this->index();
    }
    public function destroyAll(){
        auth()->user()->cart()->delete();
        return $this->index();
    }
}
