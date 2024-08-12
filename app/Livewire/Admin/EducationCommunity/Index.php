<?php

namespace App\Livewire\Admin\EducationCommunity;

use Livewire\Component;
use App\Traits\HasValidation;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use App\Models\EducationCommunity;
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
        $educationCommunities = EducationCommunity::list()->get();
        return view('livewire.admin.education-community.index', [
            'educationCommunities' => $educationCommunities,
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

    public function showModalEdit(EducationCommunity $educationcommunity)
    {
        $this->state = $educationcommunity->toArray();
        $this->editId = $educationcommunity->id;
        $this->oldImage = $educationcommunity->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }


    public function update(EducationCommunity $educationcommunity)
    {
        $validated = Validator::make($this->state,$this->validateEducationCommunity($educationcommunity->id))->validate();

        $educationcommunity->update($validated);

        if (toExists('image', $this->state)) {
            $educationcommunity->deleteFile();
            $educationcommunity->uploadFile($this->state['image']);
        }

        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(EducationCommunity $educationcommunity)
    {
        $educationcommunity->delete();
        $this->dispatch('success');
    }



}
