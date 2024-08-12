<?php

namespace App\Livewire\Admin\EducationFeature;

use Livewire\Component;
use App\Traits\HasValidation;
use Livewire\WithFileUploads;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Locked;
use App\Models\EducationFeature;
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
        $educationFeatures = EducationFeature::listAdmin()->get();
        return view('livewire.admin.education-feature.index', [
            'educationFeatures' => $educationFeatures,
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

    public function showModalEdit(EducationFeature $educationFeature)
    {
        $this->state = $educationFeature->toArray();
        $this->editId = $educationFeature->id;
        $this->oldImage = $educationFeature->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function store()
    {
        $validated = Validator::make($this->state, $this->validateFeature())->validate();
        $educationFeature = EducationFeature::create($validated);
        if (toExists('image', $this->state)) {
            $educationFeature->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(EducationFeature $educationFeature)
    {
        $validated = Validator::make($this->state,$this->validateFeature($educationFeature->id))->validate();

        $educationFeature->update($validated);

        if (toExists('image', $this->state)) {
            $educationFeature->deleteFile();
            $educationFeature->uploadFile($this->state['image']);
        }

        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(EducationFeature $educationFeature)
    {
        $educationFeature->delete();
        $this->dispatch('success');
    }



}
