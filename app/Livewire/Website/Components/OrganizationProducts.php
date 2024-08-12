<?php

namespace App\Livewire\Website\Components;

use App\Livewire\User\Components\CartIcon;
use App\Models\Product;
use Livewire\Component;
use App\Models\checkouts\catrs\Cart;
use Illuminate\Support\Facades\Validator;

class OrganizationProducts extends Component
{
    public $products = [];

    public function mount()
    {

    }

    public function render()
    {
        $this->products = Product::list()->take(9)->get();
        return view('livewire.website.components.organization-products');
    }


    public function toDetails(Product $product)
    {
        return redirect()->route('user.organization.product', [$product->id]);
    }

    public function addToCart(Product $product)
    {
        dd('sa');
        $data = [];
        $data['product_id'] = $product->id;
        $data['user_id'] = auth()->user()->id;
        $thisProduct = Cart::where('product_id', $data['product_id'])->where('user_id', $data['user_id'])->count();
        if ($thisProduct > 0) {
            $this->alertSuccess(__('app.product_already_in_cart'));
        } else {
            $max_product_in_cart = auth()->user()->organization->max_order_number;
            $current = auth()->user()->cart()->count() + auth()->user()->cart()->sum('quantity');
            if ($current > $max_product_in_cart) {

                // return redirect()->route('products')->with('message','you have max number in cart');
                $this->alertSuccessCart(__('you have max number in cart'));

            } else {
                $cart = Cart::create($data);
                $this->alertSuccessCart(__('app.product_added_succesfully'));
                $this->dispatch('update-cart-count')->to(CartIcon::class);
            }
        }
        // if (!$thisProduct) {
        //     $cart = Cart::create($data);
        //     $this->alertSuccessCart("You've successfully added the product to your cart.");
        //     $this->dispatch('update-cart-count')->to(CartIcon::class);
        // }else {
        //     $this->alertSuccess("The product you selected has already been added to your cart.");
        // }
        // $this->dispatch('post-created');
        // // return redirect()->route('user.organization.organizations');

    }


}
