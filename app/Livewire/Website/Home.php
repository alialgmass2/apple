<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout(HOME_LAYOUT)]
class Home extends Component
{
    public function render()
    {
        return view('livewire.website.home');
    }
}
