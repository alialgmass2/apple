<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\LeadershipOurValue as ModelsLeadershipOurValue;

class LeadershipOurValue extends Component
{
    public $leadershipOurValue;

    public function mount()
    {
        $this->leadershipOurValue = ModelsLeadershipOurValue::list()->first();
    }

    public function render()
    {
        return view('livewire.website.components.leadership-our-value');
    }
}
