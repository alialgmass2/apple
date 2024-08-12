<?php

namespace App\Livewire\User\Organization\Product;

use App\Livewire\User\Components\CartIcon;
use App\Models\checkouts\catrs\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Product as ModelsProduct;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Attributes\On;
use Livewire\Component;

#[Layout(ORGANIZATION_LAYOUT)]
class ProductMenu extends Component
{
    #[Locked]
    public $products;
    public $categories;
    public $currentCategory;
    public $limit = 6;

    #[Locked]
    public $isModalShowOrder = false;
    public $state = [];
    public $cities = [];
    // public $isLoading = true;

    public function mount($category = null)
    {
        $this->currentCategory = $category != 'all' ? $category : null;
        $this->products = $category != 'all' ? \App\Models\Product::where('category_id',$category)->limit($this->limit)->get() : \App\Models\Product::limit($this->limit)->get();
        $this->categories = \App\Models\Category::orderBy('order','desc')->get();
    }
    public function filterCategories($id = null)
    {
        $this->limit = 6;
        $this->currentCategory = $id;
        $this->products = \App\Models\Product::where(function ($q) use ($id){
            $id == null ? $q :$q->where('category_id',$id);
        })->limit(request('limit') ?? $this->limit)->get();
        $this->categories = $this->categories->toQuery()->orderBy('order','desc')->get();
    }
    public function productLimit()
    {
        $this->limit = $this->limit + 6;
        $this->categories = $this->categories->toQuery()->orderBy('order','desc')->get();
        if ($this->currentCategory == null){
            $this->products = \App\Models\Product::limit($this->limit)->get();
        }else{
            $this->products = \App\Models\Product::where('category_id',$this->currentCategory)->limit($this->limit)->get();
        }
    }
    public function render()
    {
        return view('livewire.user.organization.product.product-menu');
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

        if (authUser()->organization->discount != 0) {
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

//    public function toDetails(Product $product)
//    {
//        return redirect()->route('user.organization.product', [$product->id]);
//    }
    public function addToCart($productId)
    {

        $product = ModelsProduct::findOrFail($productId);
        $data = [];
        $data['product_id'] = $product->id;
        $data['user_id'] = auth()->user()->id;

        $thisProduct = Cart::where('product_id', $data['product_id'])->where('user_id', $data['user_id'])->count();
        if ($thisProduct > 0) {
            $this->alertSuccess(__('app.product_already_in_cart'));

        } else {
            $max_product_in_cart=auth()->user()->organization->max_order_number;

            $current =auth()->user()->cart()->count()+auth()->user()->cart()->sum('quantity');
            if($current> $max_product_in_cart){

               // return redirect()->route('products')->with('message','you have max number in cart');
                $this->alertSuccessCart(__('you have max number in cart'));
                $this->dispatch('update-cart-count')->to(CartIcon::class);
            }else{
                $cart = Cart::create($data);
                $this->alertSuccessCart(__('app.product_added_succesfully'));
                $this->dispatch('update-cart-count')->to(CartIcon::class);
            }

        }

    }

}
