<?php

namespace App\Livewire\Admin\LearnBanner;

use Livewire\Component;
use App\Models\LearnBanner;
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
        $learnBanner = LearnBanner::list()->first();
        return view('livewire.admin.learn-banner.index', [
            'learnBanner' => $learnBanner,
        ]);
    }

    public function closeModal()
    {
        $this->reset('state');
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = false;
    }

    public function showModalEdit(LearnBanner $learnbanner)
    {
        $this->state = $learnbanner->toArray();
        $this->editId = $learnbanner->id;
        $this->oldImage = $learnbanner->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(LearnBanner $learnbanner)
    {
        Validator::make($this->state, $this->validateBanner())->validate();
        if (toExists('image', $this->state)) {
            $learnbanner->deleteFile();
            $learnbanner->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

}
