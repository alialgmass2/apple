<?php

namespace App\Livewire\Admin\Mission;

use App\Models\Mission;
use Livewire\Component;
use Livewire\Attributes\Layout;

 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public Mission $mission;

    public function render()
    {
        return view('livewire.admin.mission.show');
    }
}
