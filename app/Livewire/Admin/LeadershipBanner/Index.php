<?php

namespace App\Livewire\Admin\LeadershipBanner;

use Livewire\Component;
use App\Traits\HasValidation;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use App\Models\LeadershipBanner;
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
        $leadershipbanner = LeadershipBanner::list()->firstOrfail();
        return view('livewire.admin.leadership-banner.index', [
            'leadershipbanner' => $leadershipbanner,
        ]);
    }


    public function closeModal()
    {
        $this->reset('state');
        $this->editId = '';
        $this->isEditMode = false;
        $this->isModalShow = false;
    }

    public function showModalEdit(LeaderShipBanner $leadershipbanner)
    {
        $this->state = $leadershipbanner->toArray();
        $this->editId = $leadershipbanner->id;
        $this->oldImage = $leadershipbanner->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }


    public function update(leaderShipBanner $leadershipbanner)
    {
        Validator::make($this->state,$this->validateBanner())->validate();
        if (toExists('image', $this->state)) {
            $leadershipbanner->deleteFile();
            $leadershipbanner->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }


}
