<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\Technical as ModelsTechnical;

class Technical extends Component
{
    public $technical;

    public function mount()
    {
        $this->technical = ModelsTechnical::list()->first();
    }

    public function render()
    {
        return view('livewire.website.components.technical');
    }
}
