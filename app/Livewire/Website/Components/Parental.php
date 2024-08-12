<?php

namespace App\Livewire\Website\Components;

use App\Models\Parental as ModelsParental;
use App\Models\ParentalTitle;
use Livewire\Component;

class Parental extends Component
{
    public $parental;
    public $parentalTitles;

    public function mount()
    {
        $this->parental = ModelsParental::list()->first();
        $this->parentalTitles = ParentalTitle::list()->get();
    }

    public function render()
    {
        return view('livewire.website.components.parental');
    }
}
