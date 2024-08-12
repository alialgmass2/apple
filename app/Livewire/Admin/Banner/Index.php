<?php

namespace App\Livewire\Admin\Banner;

use App\Models\Banner;
use Livewire\Component;
use App\Traits\HasValidation;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Validator;

 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use WithFileUploads, HasValidation;
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
        $banner = Banner::list()->firstOrfail();
        return view('livewire.admin.banner.index', [
            'banner' => $banner,
        ]);
    }


    public function closeModal()
    {
        $this->reset('state');
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = false;
    }

    public function showModalEdit(Banner $banner)
    {
        $this->state = $banner->toArray();
        $this->editId = $banner->id;
        $this->oldImage = $banner->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }


    public function update(Banner $banner)
    {
        Validator::make($this->state,$this->validateBanner())->validate();
        if (toExists('image', $this->state)) {
            $banner->deleteFile();
            $banner->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }



}
