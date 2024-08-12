<?php

namespace App\Livewire\User\Organization\Product;

use App\Livewire\User\Components\CartIcon;
use App\Models\checkouts\catrs\Cart;
use App\Models\City;
use App\Models\Order;
use App\Models\Product as ModelsProduct;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout(ORGANIZATION_LAYOUT)]
class Product extends Component
{
    #[Locked]
    public $productId;
    public $product;

    #[Locked]
    public $isModalShowOrder = false;
    public $state = [];
    public $cities = [];
    public $colors = [];
    public $color ;
    public $images = [];

    public function mount($productId)
    {
        $this->product = ModelsProduct::details($productId)->firstOrFail();
        $this->cities = City::listDropdown()->get();
        $this->colors = $this->product->getColors();
        if ($this->colors != null){
            $colorId = $this->colors[0]['id'];
            $this->images = $this->product->getFiles('default',$colorId);
            $this->color = $colorId;
        }else{
            $this->images = $this->product->getFiles('default');
        }
    }

    public function render()
    {
        return view('livewire.user.organization.product.product');
    }

    // SHOW MODAL
    #[On('open-modal-order')]
    public function showModalOrder()
    {
        $this->isModalShowOrder = true;
    }

    // CLOSE MODAL
    public function closeModal()
    {
        $this->isModalShowOrder = false;
    }
    // CLOSE MODAL
    public function closeModalOrder()
    {
        $this->isModalShowOrder = false;
    }
    public function colorImage($id)
    {
        if ($this->product->getFiles('default',$id) != null){
            $this->images = $this->product->getFiles('default',$id);
            $this->color = $id;
        }
        $this->render();
    }

    public function orderNow()
    {

        Validator::make($this->state, [
            'type' => 'required|string|in:DELIVER_TO_HOME,DELIVER_TO_ORGANIZATION',
            'phone' => 'required|string|max:30',
            'address' => 'required_if:type,DELIVER_TO_HOME|string',
            'city_id' => 'required|integer|exists:cities,id',
            'district' => 'required|string|max:100',
            'short_national_id' => 'required|string|min:5|max:100',
            'zip_code' => 'required|string|min:5|max:100',
        ])->validate();

        $priceIs = 0;
        $isWithDiscount = 0;

        if (authUser() != null && authUser()->organization->discount != 0) {
            $priceIs = calculateDiscountForOrder($this->product->price, authUser()->organization->discount);
            $isWithDiscount = 1;
        } else {
            $priceIs = $this->product->price;
            $isWithDiscount = 0;
        }

        Order::create([
            'user_id' => authUser()->id,
            'organization_id' => authUser()->organization_id,
            'product_id' => $this->product->id,
            'deliver_type' => $this->state['type'],
            'address' => toExists('address', $this->state) ? $this->state['address'] : '',
            'phone' => toExists('phone', $this->state) ? $this->state['phone'] : '',
            'is_with_discount' => $isWithDiscount,
            'price' => $priceIs,
            'city_id' => $this->state['city_id'],
            'district' => $this->state['district'],
            'short_national_id' => $this->state['short_national_id'],
            'zip_code' => $this->state['zip_code'],
        ]);
        $this->reset('state');
        $this->closeModalOrder();
        $message = 'Ordered Successfully';
        $this->alertSuccess($message);
    }

    public function addToCart($productId)
    {

        $res = addCart($productId , $this->color);
        if ($res == 'maxNum'){
            $this->alertSuccessCart(__('you have max number in cart'));
            $this->dispatch('update-cart-count')->to(CartIcon::class);
        }else{
            $this->alertSuccessCart(__('app.product_added_succesfully'));
            $this->dispatch('update-cart-count')->to(CartIcon::class);
        }

//        $product = ModelsProduct::findOrFail($productId);
//        $data = [];
//        $data['product_id'] = $product->id;
//        $data['user_id'] = auth()->user()->id;
//        $data['color_code']=$this->color;
//
//        $thisProduct = Cart::where('product_id', $data['product_id'])->where('user_id', $data['user_id'])->count();
//        if ($thisProduct > 0) {
//            $this->alertSuccess(__('app.product_already_in_cart'));
//        } else {
//            $max_product_in_cart=auth()->user()->organization->max_order_number;
//            $current =auth()->user()->cart()->count()+auth()->user()->cart()->sum('quantity');
//            if($current>$max_product_in_cart){
//               // return redirect()->route('products')->with('message','you have max number in cart');
//                $this->alertSuccessCart(__('you have max number in cart'));
//                $this->dispatch('update-cart-count')->to(CartIcon::class);
//            }else{
//                $cart = Cart::create($data);
//                $this->alertSuccessCart(__('app.product_added_succesfully'));
//                $this->dispatch('update-cart-count')->to(CartIcon::class);
//            }

//        }

        // if (!$thisProduct) {
        //     $cart = Cart::create($data);
        //     $this->alertSuccessCart("You've successfully added the product to your cart.");
        //     $this->dispatch('update-cart-count')->to(CartIcon::class);
        // }else {
        //     $this->alertSuccess("The product you selected has already been added to your cart.");
        // }

        // $product = ModelsProduct::findOrFail($productId);
        // $data = [];
        // $data['product_id'] = $product->id;
        // $data['user_id'] = auth()->user()->id;
        // $thisProduct = Cart::where('product_id', $data['product_id'])->where('user_id', $data['user_id'])->first();
        // if (!$thisProduct) {
        //     $cart = Cart::create($data);
        // }

        // return redirect()->route('user.organization.product',[$product->id]);

    }

}
