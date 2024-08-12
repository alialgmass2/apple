<?php

namespace App\Livewire\Admin\Course;

use App\Models\Course;
use App\Models\EducationLevel;
use App\Traits\HasModal;
use App\Traits\HasValidation;
use Illuminate\Support\Facades\Validator;
use Livewire\Attributes\Layout;
use Livewire\Component;
use Livewire\WithFileUploads;
use Livewire\WithPagination;

#[Layout(ADMIN_LAYOUT)]
class Index extends Component
{

    use WithFileUploads, WithPagination, HasValidation, HasModal;
    protected $paginationTheme = 'bootstrap';

    public $state = [];
    public $educationLevels = [];
    public $oldBanner;
    public $oldImage;

    public function mount()
    {
        $this->educationLevels = EducationLevel::listDropdown()->get();
    }

    public function render()
    {
        $courses = Course::listAdmin()->paginate();
        return view('livewire.admin.course.index', [
            'courses' => $courses,
        ]);
    }

    public function showModalEdit(Course $course)
    {
        $this->state = $course->toArray();
        if ($course->education_level_id == NULL) {
            $this->state['education_level_id'] = 'ALL';
        }
        $this->editId = $course->id;
        $this->oldImage = $course->getFile();
        $this->oldBanner = $course->getFile('banner');
        $this->isEditMode = true;
        $this->isModalShow = true;

    }

    public function store()
    {
        $validated = Validator::make($this->state, $this->validateCourses())->validate();
        if ($this->state['education_level_id'] == 'ALL') {
            $validated['education_level_id'] = null;
        }
        $course = Course::create($validated);

        if (toExists('image', $this->state)) {
            $course->uploadFile($this->state['image']);
        }
        if (toExists('banner', $this->state)) {
            $course->uploadFile($this->state['banner'], 'banner');
        }

        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }

    public function update(Course $course)
    {
        $validated = Validator::make($this->state, $this->validatecourses($course->id))->validate();
        if ($this->state['education_level_id'] == 'ALL') {
            $validated['education_level_id'] = NULL;
        }

        $course->update($validated);
        if (toExists('image', $this->state)) {
            $course->deleteFile();
            $course->uploadFile($this->state['image']);
        }
        if (toExists('banner', $this->state)) {
            $course->deleteFile('banner');
            $course->uploadFile($this->state['banner'], 'banner');
        }

        $this->closeModal();
        $this->alertSuccess('Data updated');

    }

    public function delete(Course $course)
    {
        $course->delete();
        $this->dispatch('success');
    }

}
