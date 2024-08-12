<?php
namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;


#[Layout(HOME_LAYOUT)]
class Welcome extends Component
{
    public function render()
    {
        dd('#HERE# ',app()->getLocale());
        return view('livewire.website.welcome');
    }
}
