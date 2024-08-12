<?php

namespace App\Livewire\Admin\EveryOneCode;

use App\Models\EveryOneCode;
use App\Traits\HasValidation;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

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
        $everyOneCodes = EveryOneCode::listAdmin()->get();
        return view('livewire.admin.every-one-code.index', [
            'everyOneCodes' => $everyOneCodes,
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

    public function showModalEdit(EveryOneCode $everyonecode)
    {
        $this->state = $everyonecode->toArray();
        $this->editId = $everyonecode->id;
        $this->oldImage = $everyonecode->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function store()
    {
        $validated = Validator::make($this->state, $this->validateEveryOneCode())->validate();
        $everyOneCode = EveryOneCode::create($validated);
        if (toExists('image', $this->state)) {
            $everyOneCode->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data Saved');
    }
    public function update(EveryOneCode $everyonecode)
    {
        $validated = Validator::make($this->state, $this->validateEveryOneCode($everyonecode->id))->validate();
        $everyonecode->update($validated);
        if (toExists('image', $this->state)) {
            $everyonecode->deleteFile();
            $everyonecode->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(EveryOneCode $everyonecode)
    {
        $everyonecode->delete();
        $this->dispatch('success');
    }

}
