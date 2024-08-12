<?php

namespace App\Livewire\Admin\EducatorIntro;

use Livewire\Component;
use App\Models\EducatorIntro;
use Livewire\Attributes\Layout;

 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public EducatorIntro $educatorintro;

    public function render()
    {
        return view('livewire.admin.educator-intro.show');
    }
}
