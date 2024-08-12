<?php

namespace App\Livewire\Admin\CustomisedSolutionBanner;

use Livewire\Component;
use App\Traits\HasValidation;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use App\Models\CustomisedSolutionBanner;
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
        $customisedSolutionBanner = CustomisedSolutionBanner::list()->first();
        return view('livewire.admin.customised-solution-banner.index', [
            'customisedSolutionBanner' => $customisedSolutionBanner,
        ]);
    }

    public function closeModal()
    {
        $this->reset('state');
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = false;
    }

    public function showModalEdit(CustomisedSolutionBanner $customisedsolutionbanner)
    {
        $this->state = $customisedsolutionbanner->toArray();
        $this->editId = $customisedsolutionbanner->id;
        $this->oldImage = $customisedsolutionbanner->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(CustomisedSolutionBanner $customisedSolutionBanner)
    {
        Validator::make($this->state, $this->validateBanner())->validate();
        if (toExists('image', $this->state)) {
            $customisedSolutionBanner->deleteFile();
            $customisedSolutionBanner->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }


}
