<?php

namespace App\Livewire\Admin\LearnShopNow;

use Livewire\Component;
use App\Models\LearnShopNow;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Validator;
use Livewire\Features\SupportFileUploads\WithFileUploads;


 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{


    use HasValidation, WithFileUploads;
    #[Locked]
    public $isModalShow = false;
    #[Locked]
    public $isEditMode = false;
    #[Locked]
    public $editId;
    public $state = [];
    public $oldImage;

    public function render()
    {
        $learnShopNow = LearnShopNow::list()->first();
        return view('livewire.admin.learn-shop-now.index', [
            'learnShopNow' => $learnShopNow,
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

    public function showModalEdit(LearnShopNow $learnshopnow)
    {
        $this->state = $learnshopnow->toArray();
        $this->editId = $learnshopnow->id;

        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(LearnShopNow $learnshopnow)
    {
        $validated = Validator::make($this->state, $this->validateTraning())->validate();

        $learnshopnow->update($validated);



        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

}
