<?php

namespace App\Livewire\Admin\LearnIntro;

use Livewire\Component;
use App\Models\LearnIntro;
use Livewire\Attributes\Layout;

 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    public LearnIntro $learnintro;

    public function render()
    {
        return view('livewire.admin.learn-intro.show');
    }

}
