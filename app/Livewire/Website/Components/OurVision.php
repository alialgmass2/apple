<?php

namespace App\Livewire\Website\Components;

use App\Models\Vision;
use Livewire\Component;

class OurVision extends Component
{
    public $vision;
    public function mount()
    {
        $this->vision = Vision::list()->first();
    }
    public function render()
    {
        return view('livewire.website.components.our-vision');
    }
}
