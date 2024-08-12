<?php

namespace App\Livewire\Admin\Training;

use App\Models\Training;
use App\Traits\HasValidation;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Livewire\Component;
use Livewire\WithFileUploads;

#[Layout(ADMIN_LAYOUT)]
class Index extends Component
{

    use HasValidation, WithFileUploads;
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
        $training = Training::list()->first();
        return view('livewire.admin.training.index', [
            'training' => $training,
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

    public function showModalEdit(Training $training)
    {
        $this->state = $training->toArray();
        $this->editId = $training->id;
        $this->oldImage = $training->getFile();

        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(Training $training)
    {
        $validated = Validator::make($this->state, $this->validateTraning())->validate();

        $training->update($validated);

        if (toExists('image', $this->state)) {
            $training->deleteFile();
            $training->uploadFile($this->state['image']);
        }

        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

}
