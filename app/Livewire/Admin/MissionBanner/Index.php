<?php

namespace App\Livewire\Admin\MissionBanner;

use Livewire\Component;
use App\Models\MissionBanner;
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
        $missionBanner = MissionBanner::list()->first();
        return view('livewire.admin.mission-banner.index', [
            'missionBanner' => $missionBanner,
        ]);
    }

    public function closeModal()
    {
        $this->reset('state');
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = false;
    }

    public function showModalEdit(MissionBanner $missionbanner)
    {
        $this->state = $missionbanner->toArray();
        $this->editId = $missionbanner->id;
        $this->oldImage = $missionbanner->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(MissionBanner $missionbanner)
    {
        Validator::make($this->state, $this->validateBanner())->validate();
        if (toExists('image', $this->state)) {
            $missionbanner->deleteFile();
            $missionbanner->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

}
