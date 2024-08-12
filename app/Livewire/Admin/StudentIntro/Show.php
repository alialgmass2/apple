<?php

namespace App\Livewire\Admin\StudentIntro;

use Livewire\Component;
use App\Models\StudentIntro;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public StudentIntro $studentintro;

    public function render()
    {
        return view('livewire.admin.student-intro.show');
    }

}
