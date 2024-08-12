<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;


 #[Layout(HOME_LAYOUT)]
class Leadership extends Component
{
    public function render()
    {
        return view('livewire.website.leadership');
    }
}
