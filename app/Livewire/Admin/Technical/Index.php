<?php

namespace App\Livewire\Admin\Technical;

use App\Models\Technical;
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
        $technical = Technical::list()->first();
        return view('livewire.admin.technical.index', [
            'technical' => $technical,
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

    public function showModalEdit(Technical $technical)
    {
        $this->state = $technical->toArray();
        $this->editId = $technical->id;
        $this->oldImage = $technical->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function update(Technical $technical)
    {
        $validated = Validator::make($this->state, $this->validateParental($technical->id))->validate();

        $technical->update($validated);
        if (toExists('image', $this->state)) {
            $technical->deleteFile();
            $technical->uploadFile($this->state['image']);
        }

        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

}
