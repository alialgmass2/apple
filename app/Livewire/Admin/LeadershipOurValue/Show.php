<?php

namespace App\Livewire\Admin\LeadershipOurValue;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\LeadershipOurValue;

 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public LeadershipOurValue $leadershipourvalue;

    public function render()
    {
        return view('livewire.admin.leadership-our-value.show');
    }


}
