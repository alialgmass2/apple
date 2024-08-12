<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;


 #[Layout(HOME_LAYOUT)]
class StudentsAndParents extends Component
{
    public function render()
    {
        return view('livewire.website.students-and-parents');
    }
}
