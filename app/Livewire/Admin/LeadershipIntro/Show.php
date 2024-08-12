<?php

namespace App\Livewire\Admin\LeadershipIntro;

use Livewire\Component;
use App\Models\LeadershipIntro;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{


    public LeadershipIntro $leadershipintro;

    public function render()
    {
        return view('livewire.admin.leadership-intro.show');
    }


}
