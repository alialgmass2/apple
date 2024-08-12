<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\LeadershipBanner as ModelsLeadershipBanner;
use App\Models\LeadershipIntro;

class LeadershipBanner extends Component
{
    public $leadershipIntro;
    public $leadershipBanner;

    public function mount()
    {
      $this->leadershipIntro = LeadershipIntro::list()->first();
      $this->leadershipBanner = ModelsLeadershipBanner::list()->first();
    }


    public function render()
    {
        return view('livewire.website.components.leadership-banner');
    }
}
