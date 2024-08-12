<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\EveryOneCode as ModelsEveryOneCode;

class EveryOneCode extends Component
{
    public $everyOneCodes = [];

    public function mount()
    {
        $this->everyOneCodes = ModelsEveryOneCode::list()->get();
    }

    public function render()
    {
        return view('livewire.website.components.every-one-code');
    }
}
