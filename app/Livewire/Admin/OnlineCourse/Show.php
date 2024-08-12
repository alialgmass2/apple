<?php

namespace App\Livewire\Admin\OnlineCourse;

use App\Models\OnlineCourse;
use Livewire\Component;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
        public OnlineCourse $onlinecourse;
    public function render()
    {
        return view('livewire.admin.online-course.show');
    }
}
