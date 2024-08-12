<?php

namespace App\Livewire\Website\Components;

use App\Models\EducationFeature;
use Livewire\Component;

class CardsSectionWithIcon extends Component
{
    public $educationFeatures = [];
    public function mount()
    {
        $this->educationFeatures = EducationFeature::list()->get();
    }

    public function render()
    {
        return view('livewire.website.components.cards-section-with-icon');
    }
}
