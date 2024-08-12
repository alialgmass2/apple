<?php

namespace App\Livewire\Admin\LearnIntro;

use Livewire\Component;
use App\Models\LearnIntro;
use App\Traits\HasValidation;
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
        $learnIntro = LearnIntro::list()->first();

        return view('livewire.admin.learn-intro.index', [
            'learnIntro' => $learnIntro,
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

    public function showModalEdit(LearnIntro $learnintro)
    {
        $this->state = $learnintro->toArray();
        $this->editId = $learnintro->id;
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(LearnIntro $learnintro)
    {
        $validated = Validator::make($this->state, $this->validateHomeIntro())->validate();

        $learnintro->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');
    }


}
