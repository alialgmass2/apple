<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\StudentBanner as ModelsStudentBanner;
use App\Models\StudentIntro;

class StudentBanner extends Component
{
    public $studentIntro;
    public $studentBanner;

    public function mount()
    {
        $this->studentIntro = StudentIntro::list()->first();
        $this->studentBanner = ModelsStudentBanner::list()->first();
    }

    public function render()
    {
        return view('livewire.website.components.student-banner');
    }
}
