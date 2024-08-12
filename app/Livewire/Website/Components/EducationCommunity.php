<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\EducationCommunity as ModelsEducationCommunity;

class EducationCommunity extends Component
{
    public $educationCommunity;

    public function mount()
    {
        $this->educationCommunity = ModelsEducationCommunity::list()->first();

    }

    public function render()
    {
        return view('livewire.website.components.education-community');
    }
}
