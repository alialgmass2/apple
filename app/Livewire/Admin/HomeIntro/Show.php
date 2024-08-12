<?php

namespace App\Livewire\Admin\HomeIntro;

use App\Models\HomeIntro;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    public HomeIntro $homeintro;

    public function render()
    {
        return view('livewire.admin.home-intro.show');
    }
}
