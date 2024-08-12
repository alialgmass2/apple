<?php

namespace App\Livewire\User\Organization\Offer;

use App\Models\OrganizationOffer;
use App\Models\ProductOffer;
use Livewire\Attributes\Layout;
use Livewire\Component;
#[Layout(ORGANIZATION_LAYOUT)]
class OfferDetails extends Component
{
    public $offer;
    public $categories;
    public $products;
    public $offerId;
    public $more = true;
    public $currentCategory;
    public $productsCount;
    public $limit = 6;

    public function mount($offerId)
    {
        $this->offerId = $offerId;
        $offer = ProductOffer::where('organization_offer_id',$offerId)->with('product',function ($query){
            $this->currentCategory != null ? $query->where('category_id',$this->currentCategory) : $query->get();
        })->whereHas('product');
        $offer->count() <= 6 ? $this->more = false : '';
        $this->offer = OrganizationOffer::where('id',$offerId)->first()?->offer()->first();
        $nonRepeat = [];

        foreach ($offer->get() as $key => $value) {
            if (++$key <= $this->limit) {
                $product = $value;
                $this->products[] = $product;
            }
        }
        foreach ($offer->get() as $key => $value) {
            $categories = $value->product->category()->first();
            if (!in_array($categories->id,$nonRepeat)){
                $this->categories[] = $categories;
            }
            $nonRepeat[] = $categories->id;
        }
        if (!checkOfferExpiration($this->offer->start_date,$this->offer->end_date,$this->offer->status)) {
            $this->redirect('user/organizations');
        }
    }

    public function filterCategories($id = null)
    {
        $this->currentCategory = $id;
        $this->limit = 6;
        $this->getProduct($id);
    }
    public function productLimit()
    {
        $this->limit = $this->limit + 6;
        $this->getProduct();
    }
    public function getProduct($id = null)
    {
        $products = ProductOffer::where('organization_offer_id', $this->offerId)
            ->with('product')
            ->whereHas('product', function ($query) {
                if ($this->currentCategory !== null) {
                    $query->where('category_id', $this->currentCategory);
                }
        });
        $this->products = $products->take($this->limit)->get();
        $this->more = $products->count() <= $this->limit ? false : true;
    }
    public function getCategories()
    {
        $nonRepeat = [];
        foreach ($this->products as $key => $value) {
            $categories = $value->product->category()->first();
            if (!in_array($categories->id,$nonRepeat)){
                $this->categories[] = $categories;
            }
            $nonRepeat[] = $categories->id;
        }
    }
    public function render()
    {
        return view('livewire.user.organization.offer.offer-details');
    }
}
