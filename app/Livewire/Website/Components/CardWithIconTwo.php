<?php

namespace App\Livewire\Website\Components;

use App\Models\StudentFeature;
use Livewire\Component;

class CardWithIconTwo extends Component
{
    public $studentFeatures = [];
    public function mount()
    {
        $this->studentFeatures = StudentFeature::list()->get();
    }

    public function render()
    {
        return view('livewire.website.components.card-with-icon-two');
    }
}
