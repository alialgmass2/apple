<?php

namespace App\Livewire\Admin\StudentFeature;

use App\Models\StudentFeature;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    public StudentFeature $studentfeature;

    public function render()
    {
        return view('livewire.admin.student-feature.show');
    }
}
