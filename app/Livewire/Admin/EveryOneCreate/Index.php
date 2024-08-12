<?php

namespace App\Livewire\Admin\EveryOneCreate;

use Livewire\Component;
use App\Traits\HasValidation;
use Livewire\WithFileUploads;
use App\Models\EveryOneCreate;
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
        $everyOneCreate = EveryOneCreate::listAdmin()->first();
        return view('livewire.admin.every-one-create.index', [
            'everyOneCreate' => $everyOneCreate,
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

    public function showModalEdit(EveryOneCreate $everyonecreate)
    {
        $this->state = $everyonecreate->toArray();
        $this->editId = $everyonecreate->id;
        $this->oldImage = $everyonecreate->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function store()
    {
        $validated = Validator::make($this->state, $this->validateEveryOneCreate())->validate();
        $everyOneCreate = EveryOneCreate::create($validated);
        if (toExists('image', $this->state)) {
            $everyOneCreate->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data Saved');
    }
    public function update(EveryOneCreate $everyonecreate)
    {
        $validated = Validator::make($this->state, $this->validateEveryOneCreate($everyonecreate->id))->validate();
        $everyonecreate->update($validated);
        if (toExists('image', $this->state)) {
            $everyonecreate->deleteFile();
            $everyonecreate->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(EveryOneCreate $everyonecreate)
    {
        $everyonecreate->delete();
        $this->dispatch('success');
    }

}
