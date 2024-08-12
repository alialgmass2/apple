<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\EducatorBanner as ModelsEducatorBanner;
use App\Models\EducatorIntro;

class EducatorBanner extends Component
{
    public $educatorBanner;
    public $educatorIntro;

    public function mount()
    {
        $this->educatorBanner = ModelsEducatorBanner::list()->first();
        $this->educatorIntro = EducatorIntro::list()->first();
    }

    public function render()
    {
        return view('livewire.website.components.educator-banner');
    }
}
