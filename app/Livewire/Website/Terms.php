<?php

namespace App\Livewire\Website;

use Livewire\Attributes\Layout;
use Livewire\Component;


#[Layout(HOME_LAYOUT)]
class Terms extends Component
{
    public function render()
    {
        return view('components.website.components.terms_Condition.terms');
    }
}
