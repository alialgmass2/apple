<?php

namespace App\Livewire\Admin\EducatorBanner;

use Livewire\Component;
use App\Traits\HasValidation;
use Livewire\WithFileUploads;
use App\Models\EducatorBanner;
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
        $educatorBanner = EducatorBanner::list()->firstOrfail();
        return view('livewire.admin.educator-banner.index', [
            'educatorBanner' => $educatorBanner,
        ]);
    }

    public function closeModal()
    {
        $this->reset('state');
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = false;
    }

    public function showModalEdit(EducatorBanner $educatorbanner)
    {
        $this->state = $educatorbanner->toArray();
        $this->editId = $educatorbanner->id;
        $this->oldImage = $educatorbanner->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(EducatorBanner $educatorbanner)
    {
        Validator::make($this->state, $this->validateBanner())->validate();
        if (toExists('image', $this->state)) {
            $educatorbanner->deleteFile();
            $educatorbanner->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

}
