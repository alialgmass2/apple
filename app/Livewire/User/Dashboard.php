<?php

namespace App\Livewire\User;

use Livewire\Component;
use Livewire\Attributes\Layout;

 #[Layout(USER_LAYOUT)]
class Dashboard extends Component
{
    public function render()
    {
        return view('livewire.user.dashboard');
    }
}
