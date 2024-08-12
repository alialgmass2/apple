<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\CustomisedSolution as ModelsCustomisedSolution;
use App\Models\CustomisedSolutionBanner;

class CustomisedSolution extends Component
{
    public $customisedSolutionBanner;
    public $customisedSolution;

    public function mount()
    {
        $this->customisedSolutionBanner = CustomisedSolutionBanner::list()->first();
        $this->customisedSolution = ModelsCustomisedSolution::list()->first();
    }

    public function render()
    {
        return view('livewire.website.components.customised-solution');
    }
}
