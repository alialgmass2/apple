<?php

namespace App\Livewire\Website;

use Livewire\Component;
use Livewire\Attributes\Layout;


 #[Layout(HOME_LAYOUT)]
class LearnAndBuy extends Component
{
    public function render()
    {
        return view('livewire.website.learn-and-buy');
    }

    public function toLogin()
    {
        return redirect()->route('user.login');
    }

}
