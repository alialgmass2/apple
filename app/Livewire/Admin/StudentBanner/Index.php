<?php

namespace App\Livewire\Admin\StudentBanner;

use Livewire\Component;
use App\Models\StudentBanner;
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
        $studentBanner = StudentBanner::list()->firstOrfail();
        return view('livewire.admin.student-banner.index', [
            'studentBanner' => $studentBanner,
        ]);
    }

    public function closeModal()
    {
        $this->reset('state');
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = false;
    }

    public function showModalEdit(StudentBanner $studentbanner)
    {
        $this->state = $studentbanner->toArray();
        $this->editId = $studentbanner->id;
        $this->oldImage = $studentbanner->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(StudentBanner $studentbanner)
    {
        Validator::make($this->state, $this->validateBanner())->validate();
        if (toExists('image', $this->state)) {
            $studentbanner->deleteFile();
            $studentbanner->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }


}
