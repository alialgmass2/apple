<?php

namespace App\Livewire\User\Organization\Course;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\Course as ModelsCourse;


 #[Layout(ORGANIZATION_LAYOUT)]
class Course extends Component
{
    public $courseId;
    public $course;

    public function mount($courseId)
    {
        $this->course = ModelsCourse::details($courseId)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.user.organization.course.course');
    }
}
