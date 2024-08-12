<?php

namespace App\Livewire\Website\Components;

use Livewire\Component;
use App\Models\EveryOneCreate as ModelsEveryOneCreate;

class EveryOneCreate extends Component
{
    public $everyOneCreate;

    public function mount()
    {
        $this->everyOneCreate = ModelsEveryOneCreate::listAdmin()->first();
    }

    public function render()
    {
        return view('livewire.website.components.every-one-create');
    }
}
