<?php

namespace App\Livewire\Admin\OnlineCourse;

use Livewire\Component;
use App\Models\OnlineCourse;
use App\Traits\HasValidation;
use Livewire\WithFileUploads;
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
        $onlineCourses = OnlineCourse::listAdmin()->get();
        return view('livewire.admin.online-course.index', [
            'onlineCourses' => $onlineCourses,
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

    public function showModalEdit(OnlineCourse $onlinecourse)
    {
        $this->state = $onlinecourse->toArray();
        $this->editId = $onlinecourse->id;
        $this->oldImage = $onlinecourse->getFile();
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function store()
    {
        $validated = Validator::make($this->state, $this->validateOnlineCourse())->validate();
        $onlineCourse = OnlineCourse::create($validated);
        if (toExists('image', $this->state)) {
            $onlineCourse->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data Saved');
    }
    public function update(OnlineCourse $onlinecourse)
    {
        $validated = Validator::make($this->state, $this->validateOnlineCourse($onlinecourse->id))->validate();
        $onlinecourse->update($validated);
        if (toExists('image', $this->state)) {
            $onlinecourse->deleteFile();
            $onlinecourse->uploadFile($this->state['image']);
        }
        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(OnlineCourse $onlinecourse)
    {
        $onlinecourse->delete();
        $this->dispatch('success');
    }

}
