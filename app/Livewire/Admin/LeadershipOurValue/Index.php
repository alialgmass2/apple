<?php

namespace App\Livewire\Admin\LeadershipOurValue;

use Livewire\Component;
use App\Traits\HasValidation;
use App\Models\LeadershipIntro;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use App\Models\LeadershipOurValue;
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
        $leadershipOurValue = LeadershipOurValue::list()->first();
        return view('livewire.admin.leadership-our-value.index', [
            'leadershipOurValue' => $leadershipOurValue,
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

    public function showModalEdit(LeadershipOurValue $leadershipourvalue)
    {
        $this->state = $leadershipourvalue->toArray();
        $this->editId = $leadershipourvalue->id;
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(LeadershipOurValue $leadershipourvalue)
    {
        $validated = Validator::make($this->state, $this->validateHomeIntro())->validate();

        $leadershipourvalue->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

}
