<?php

namespace App\Livewire\Admin\HomeIntro;

use Livewire\Component;
use App\Models\HomeIntro;
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
        $homeIntro = HomeIntro::list()->first();
        return view('livewire.admin.home-intro.index', [
            'homeIntro' => $homeIntro,
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

    public function showModalEdit(HomeIntro $homeintro)
    {
        $this->state = $homeintro->toArray();
        $this->editId = $homeintro->id;
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(HomeIntro $homeintro)
    {
        $validated = Validator::make($this->state, $this->validateHomeIntro())->validate();

        $homeintro->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }



}
