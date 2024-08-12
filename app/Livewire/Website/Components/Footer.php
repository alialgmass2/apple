<?php

namespace App\Livewire\Website\Components;

use Livewire\Attributes\Locked;
use Livewire\Component;
use App\Traits\HasModalWebsite;

class Footer extends Component
{
    use HasModalWebsite;

    #[Locked]
    public $isModalShow = false;

    public function render()
    {
        return view('livewire.website.components.footer');
    }
}
