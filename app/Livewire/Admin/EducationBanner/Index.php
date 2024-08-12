<?php

namespace App\Livewire\Admin\EducationBanner;

use App\Models\EducationBanner;
use App\Traits\HasValidation;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

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
        $educationBanner = EducationBanner::list()->first();
        return view('livewire.admin.education-banner.index', [
            'educationBanner' => $educationBanner,
        ]);
    }

    public function closeModal()
    {
        $this->reset('state');
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = false;
    }

    public function showModalEdit(EducationBanner $educationbanner)
    {
        $this->state = $educationbanner->toArray();
        $this->editId = $educationbanner->id;
        $this->oldImage = $educationbanner->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(EducationBanner $educationbanner)
    {
        Validator::make($this->state, $this->validateBanner())->validate();
        if (toExists('image', $this->state)) {
            $educationbanner->deleteFile();
            $educationbanner->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

}
