<?php

namespace App\Livewire\Admin\HowToKnow;

use App\Models\HowToKnow;
use App\Models\Product;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Validator;


 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{

//    #[Locked]
//    public $isModalShow = false;
//    #[Locked]
//    public $isEditMode = false;
//    #[Locked]
//    public $editId;
//    public $state = [];
    // public $howToKnow = [];

    public function mount()
    {
        $this->products = Product::all();
    }

    public function render()
    { 
        $howToKnow = HowToKnow::with('student')->latest()->get(); 
        return view('livewire.admin.how-to-know.index', [
            'howToKnow' => $howToKnow,
        ]);
    }


//    public function showModal()
//    {
//        $this->editId = '';
//        $this->isEditMode = false;
//        $this->isModalShow = true;
//    }

//    public function closeModal()
//    {
//        $this->reset('state');
//        $this->editId = '';
//        $this->isEditMode = false;
//        $this->isModalShow = false;
//    }

//    public function showModalEdit(HowTo $howto)
//    {
//        $this->state = $howto->toArray();
//        $this->editId = $howto->id;
//        $this->isEditMode = true;
//        $this->isModalShow = true;
//    }

//    public function store()
//    {
//        $validated = Validator::make($this->state, [
//            'product_id' => 'required|integer|exists:products,id',
//            'title_en' => 'required|string',
//            'title_ar' => 'required|string',
//            'text_en' => 'required|string',
//            'text_ar' => 'required|string',
//        ])->validate();
//
//        HowTo::create($validated);
//        $this->closeModal();
//        $this->alertSuccess('Data Saved');
//
//    }
//    public function update(HowTo $howto)
//    {
//        $validated = Validator::make($this->state, [
//            'product_id' => 'required|integer|exists:products,id',
//            'title_en' => 'required|string',
//            'title_ar' => 'required|string',
//            'text_en' => 'required|string',
//            'text_ar' => 'required|string',
//        ])->validate();
//
//        $howto->update($validated);
//        $this->closeModal();
//        $this->alertSuccess('Data updated');
//
//    }
//
//    public function delete(HowTo $howto)
//    {
//        $howto->delete();
//        $this->dispatch('success');
//    }


}
