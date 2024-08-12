<?php

namespace App\Livewire\Admin\Organization;

use App\Livewire\Website\Product\Product;
use App\Models\Organization;
use App\Models\OrganizationDiscount;
use App\Traits\HasModal;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(ADMIN_LAYOUT)]
class Discount extends Component
{
    use HasModal;

    public Organization $organization;
    public $editId;
    public $data;
    public $state;

    public function mount($organization)
    {
        $this->data = \App\Models\Product::listAdminDiscount()->get();
        $this->editId = $organization->id;

//        if (OrganizationDiscount::where('organization_id',$organization->id)->exists()){
//        dd($this->data);
            foreach ($this->data as $discount) {
//                dd($discount->customDiscount);
                $discountData = $discount->customDiscount->first();
                if ($discountData?->organization_id == $organization->id) {
                    $this->state[$discountData->product_id] = $discountData->discount;
                }
            }
//        }else{
//            $this->state = [];
//        }

    }
    public function render()
    {
        $products  = $this->data->toQuery()->paginate(6);
        return view('livewire.admin.organization.discount',compact('products'));
    }
    public function discountStore()
    {
        foreach ($this->state as $product_id => $discount) {
            OrganizationDiscount::updateOrCreate([
                'product_id' => $product_id,
                'organization_id' => $this->editId,
            ],
            [
                'product_id' => $product_id,
                'organization_id' => $this->editId,
                'discount' => $discount,
            ]
            );
        }
        $this->isModalShow = false;
        $this->isModalHeader = false;
        $this->alertSuccess('Data updated');

    }
}
