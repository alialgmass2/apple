<?php

namespace App\Livewire\Website\Components;

use App\Models\Mission;
use App\Models\MissionBanner;
use Livewire\Component;

class OurMission extends Component
{
    public $missionBanner;
    public $missions = [];

    public function mount()
    {
        $this->missionBanner = MissionBanner::list()->first();
        $this->missions = Mission::list()->get();
    }

    public function render()
    {
        return view('livewire.website.components.our-mission');
    }
}
