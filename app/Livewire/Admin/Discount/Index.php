<?php

namespace App\Livewire\Admin\Discount;

use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Validator;

 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{

    #[Locked]
    public $isModalShow = false;
    #[Locked]
    public $isEditMode = false;
    #[Locked]
    public $editId;
    public $state = [];
    public $products = [];

    public function mount()
    {
        $this->products = Product::all();
    }

    public function render()
    {
        $discounts = product::latest()->get();
        return view('livewire.admin.discount.index', [
            'discounts' => $discounts,
        ]);
    }



    public function showModal()
    {
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = true;
    }

    public function closeModal()
    {
        $this->reset('state');
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = false;
    }

    public function showModalEdit(Product $product)
    {
        // $this->state = $product->toArray();
        $this->state['product_id'] = $product->id;
        $this->state['discount'] = $product->discount;
        $this->editId = $product->id;
        $this->isEditMode = true;
        $this->isModalShow = true;
    }

    public function store()
    {
        $validated = Validator::make($this->state, [
            'product_id' => 'required|integer|exists:products,id',
            'discount' => 'required|numeric',
        ])->validate();

        $product = Product::findOrFail($this->state['product_id']);
        $product->update([
            'discount' => $this->state['discount'],
        ]);
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(Product $product)
    {
        $validated = Validator::make($this->state, [
            'product_id' => 'required|integer|exists:products,id',
            'discount' => 'required|numeric',
        ])->validate();

        $product->update([
            'discount' => $this->state['discount'],
        ]);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(product $product)
    {
        $product->update([
            'discount' => 0,
        ]);
        $this->dispatch('success');
    }


}
