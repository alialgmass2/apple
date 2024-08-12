<?php

namespace App\Livewire\Admin\LeadershipIntro;

use Livewire\Component;
use App\Traits\HasValidation;
use App\Models\LeadershipIntro;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Validator;


 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{

    use HasValidation;
    #[Locked]
    public $isModalShow = false;
    #[Locked]
    public $isEditMode = false;
    #[Locked]
    public $editId;
    public $state = [];


    public function render()
    {
        $leadershipIntro = LeadershipIntro::list()->first();
        return view('livewire.admin.leadership-intro.index', [
            'leadershipIntro' => $leadershipIntro,
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

    public function showModalEdit(LeadershipIntro $leadershipintro)
    {
        $this->state = $leadershipintro->toArray();
        $this->editId = $leadershipintro->id;
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(LeadershipIntro $leadershipintro)
    {
        $validated = Validator::make($this->state, $this->validateHomeIntro())->validate();

        $leadershipintro->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

}
