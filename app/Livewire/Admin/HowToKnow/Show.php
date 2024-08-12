<?php

namespace App\Livewire\Admin\HowTo;

use App\Models\HowTo;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    public HowTo $howto;

    public function render()
    {
        return view('livewire.admin.how-to.show');
    }
}
