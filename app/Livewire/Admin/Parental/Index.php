<?php

namespace App\Livewire\Admin\Parental;

use Livewire\Component;
use App\Models\Parental;
use App\Traits\HasValidation;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use Illuminate\Support\Facades\Validator;


 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{

    use WithFileUploads,HasValidation;

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
        $parentals = Parental::list()->get();
        return view('livewire.admin.parental.index', [
            'parentals' => $parentals,
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

    public function showModalEdit(Parental $parental)
    {
        $this->state = $parental->toArray();
        $this->editId = $parental->id;
        $this->oldImage = $parental->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }


    public function update(Parental $parental)
    {
        $validated = Validator::make($this->state,$this->validateParental($parental->id))->validate();

        $parental->update($validated);

        if (toExists('image', $this->state)) {
            $parental->deleteFile();
            $parental->uploadFile($this->state['image']);
        }

        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(Parental $parental)
    {
        $parental->delete();
        $this->dispatch('success');
    }

}
