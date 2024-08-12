<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\Training;

class Trainings extends Component
{
    public $training;

    public function mount()
    {
        $this->training = Training::list()->first();
    }

    public function render()
    {
        return view('livewire.website.components.trainings');
    }
}
