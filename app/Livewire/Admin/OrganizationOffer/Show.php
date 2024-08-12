<?php

namespace App\Livewire\Admin\OrganizationOffer;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Organization;
use App\Models\OrganizationOffer;
use App\Models\Product;
use App\Models\ProductOffer;
use App\Traits\HasModal;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


#[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    use WithPagination, HasValidation,  HasModal;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $organization_id = '';
    public $categories = [];
    public $subCategories = [];
    public $org = '';
    public $offerData = '';
    public $percent = '';
    public $products = '';
    public $id = '';

    public function mount($id)
    {
        $this->id = $id;
        $offers = OrganizationOffer::where('id',$id);
        $off = $offers->with(['organization','offer'])->first();
        $this->org = $off->organization->translate('name');
        $this->offerData = $off->offer->translate('title');
        $this->percent = $off->offer->percent;
        $this->products = $offers->first()->ProductOffer()->with('product.category')->get();
    }
    public function render()
    {
        $organizations = Organization::listDropown()->get();
        return view('livewire.admin.organization-offer.show', [
            'organizations' => $organizations,
        ]);

    }
    public function delete(ProductOffer $offer)
    {
        $offer->delete();
        $this->alertSuccess('Data deleted');
        $offers = OrganizationOffer::where('id',$this->id);
        $offer = $offers->with(['organization','offer']);
        $this->products = $offer->first()->ProductOffer()->with('product.category')->get();
    }
}
