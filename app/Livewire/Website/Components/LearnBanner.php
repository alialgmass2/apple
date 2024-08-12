<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\Training;
use App\Models\LearnIntro;
use App\Models\LearnBanner as ModelsLearnBanner;

class LearnBanner extends Component
{
    public $learnBanner;
    public $learnIntro;
    public $training;
    public function mount()
    {
        $this->learnBanner = ModelsLearnBanner::list()->first();
        $this->learnIntro = LearnIntro::list()->first();
        $this->training = Training::list()->first();

    }


    public function render()
    {
        return view('livewire.website.components.learn-banner');
    }
}
