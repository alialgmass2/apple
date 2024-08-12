<?php

namespace App\Livewire\Admin\EducatorIntro;

use Livewire\Component;
use App\Models\EducatorIntro;
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
        $educatorIntro = EducatorIntro::list()->first();
        return view('livewire.admin.educator-intro.index', [
            'educatorIntro' => $educatorIntro,
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

    public function showModalEdit(EducatorIntro $educatorintro)
    {
        $this->state = $educatorintro->toArray();
        $this->editId = $educatorintro->id;
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(EducatorIntro $educatorintro)
    {
        $validated = Validator::make($this->state, $this->validateHomeIntro())->validate();

        $educatorintro->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

}
