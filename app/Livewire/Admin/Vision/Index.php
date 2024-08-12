<?php

namespace App\Livewire\Admin\Vision;

use App\Models\Vision;
use Livewire\Component;
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
        $vision = Vision::list()->first();
        return view('livewire.admin.vision.index', [
            'vision' => $vision,
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

    public function showModalEdit(Vision $vision)
    {
        $this->state = $vision->toArray();
        $this->editId = $vision->id;
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(Vision $vision)
    {
        $validated = Validator::make($this->state, $this->validateVision())->validate();

        $vision->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }



}
