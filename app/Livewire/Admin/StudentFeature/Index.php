<?php

namespace App\Livewire\Admin\StudentFeature;

use Livewire\Component;
use App\Traits\HasValidation;
use Livewire\WithFileUploads;
use App\Models\StudentFeature;
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
        $studentFeatures = StudentFeature::listAdmin()->get();
        return view('livewire.admin.student-feature.index', [
            'studentFeatures' => $studentFeatures,
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

    public function showModalEdit(StudentFeature $studentFeature)
    {
        $this->state = $studentFeature->toArray();
        $this->editId = $studentFeature->id;
        $this->oldImage = $studentFeature->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function store()
    {
        $validated = Validator::make($this->state, $this->validateFeature())->validate();
        $studentFeature = StudentFeature::create($validated);
        if (toExists('image', $this->state)) {
            $studentFeature->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(StudentFeature $studentFeature)
    {
        $validated = Validator::make($this->state,$this->validateFeature($studentFeature->id))->validate();

        $studentFeature->update($validated);

        if (toExists('image', $this->state)) {
            $studentFeature->deleteFile();
            $studentFeature->uploadFile($this->state['image']);
        }

        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(StudentFeature $studentFeature)
    {
        $studentFeature->delete();
        $this->dispatch('success');
    }



}
