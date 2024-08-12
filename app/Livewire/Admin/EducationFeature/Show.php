<?php

namespace App\Livewire\Admin\EducationFeature;

use App\Models\EducationFeature;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    public EducationFeature $educationfeature;

    public function render()
    {
        return view('livewire.admin.education-feature.show');
    }
}
