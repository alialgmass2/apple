<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\EducationBanner as ModelsEducationBanner;
use App\Models\EducationIntro;

class EducationBanner extends Component
{
    public $educationBanner;
    public $educationIntro;

    public function mount()
    {
        $this->educationIntro = EducationIntro::list()->first();
        $this->educationBanner = ModelsEducationBanner::list()->first();
    }

    public function render()
    {
        return view('livewire.website.components.education-banner');
    }
}
