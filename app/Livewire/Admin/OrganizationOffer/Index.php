<?php

namespace App\Livewire\Admin\OrganizationOffer;

use App\Models\Category;
use App\Models\Offer;
use App\Models\Organization;
use App\Models\OrganizationOffer;
use App\Models\Product;
use App\Models\ProductOffer;
use App\Models\SubCategory;
use App\Traits\HasModal;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithPagination;


#[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use WithPagination, HasValidation,  HasModal;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $organization_id = '';
    public $activeOrganization_id = '';
    public $isModelProduct = false;
    public $categories = [];
    public $subCategories = [];
    public $productOffer = [];
    public $products = [];

    public function mount()
    {
        $this->categories = Category::list()->get();
    }

    public function render($data = null)
    {
        $organizationOffer = OrganizationOffer::listAdmin($this->organization_id??'')->paginate(6);
        $organizations = Organization::listDropown()->get();
        $offers = Offer::listDropdown()->get();
       return view('livewire.admin.organization-offer.index', [
            'offers' => $offers,
            'organizations' => $organizations,
            'organizationOffer' => $organizationOffer,
        ]);

    }
    public function showModal()
    {
        $this->editId = '';
        $this->isModelProduct = false;
        $this->isEditMode = false;
        $this->isModalShow = true;
        $this->isModalHeader = false;
    }
     public function showModalEdit(OrganizationOffer $offer)
    {
        $this->state = $offer->toArray();
        $this->editId = $offer->id;
        $this->isEditMode = true;
        $this->isModelProduct = false;
        $this->isModalShow = true;
    }

    public function showModalProduct(OrganizationOffer $offer,$org_id)
    {
        $this->activeOrganization_id =$org_id;
        $this->state['product_id'] = $offer->ProductOffer()->pluck('product_id')->toArray();
//        $this->products = Product::whereIn('id', $this->state['product_id'])->get();
        $this->editId = $offer->id;
        $this->isEditMode = false;
        $this->isModelProduct = true;
        $this->isModalShow = true;
    }
    public function updatedStateCategoryId($value)
    {
        $this->products = Product::dropdownList($value)->get();
    }

    public function store()
    {
        $validated = \Validator::make($this->state,$this->validateOrganizationOffer())->validate();
        OrganizationOffer::create($validated);
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(OrganizationOffer $offer)
    {
        $validated = \Validator::make($this->state, $this->validateOrganizationOffer($offer->id))->validate();
        $offer->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');
    }

    public function assignProduct(OrganizationOffer $offer)
    {
        foreach ($this->state['product_id'] as $item) {
            $isset = null ;
            foreach (ProductOffer::where(['product_id' => $item])->with('organization_offer')->get() as $data){
               if ($data->organization_offer->organization_id == $this->activeOrganization_id){
                   $isset = true;
                   break;
               }
            }
            if ($isset == null){
                ProductOffer::updateOrCreate(
                    [
                        'organization_offer_id' => $offer->id,
                        'product_id' => $item,

                    ],[
                        'organization_offer_id' => $offer->id,
                        'product_id' => $item,
                        'offer_id' => $offer->offer_id,
                    ]
                );
            }
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');
    }

    public function delete(OrganizationOffer $offer)
    {
        $offer->delete();
        $this->dispatch('success');
    }

}
