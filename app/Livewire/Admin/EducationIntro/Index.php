<?php

namespace App\Livewire\Admin\EducationIntro;

use Livewire\Component;
use App\Traits\HasValidation;
use App\Models\EducationIntro;
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
        $educationIntro = EducationIntro::list()->first();
        return view('livewire.admin.education-intro.index', [
            'educationIntro' => $educationIntro,
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

    public function showModalEdit(EducationIntro $educationintro)
    {
        $this->state = $educationintro->toArray();
        $this->editId = $educationintro->id;
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(EducationIntro $educationintro)
    {
        $validated = Validator::make($this->state, $this->validateEducationIntro())->validate();

        $educationintro->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }



}
