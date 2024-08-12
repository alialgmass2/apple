<?php

namespace App\Livewire\Admin\StudentIntro;

use Livewire\Component;
use App\Models\StudentIntro;
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
        $studentIntro = StudentIntro::list()->first();
        return view('livewire.admin.student-intro.index', [
            'studentIntro' => $studentIntro,
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

    public function showModalEdit(StudentIntro $studentintro)
    {
        $this->state = $studentintro->toArray();
        $this->editId = $studentintro->id;
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(StudentIntro $studentintro)
    {
        $validated = Validator::make($this->state, $this->validateHomeIntro())->validate();

        $studentintro->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }


}
