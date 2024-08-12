<?php

namespace App\Livewire\Admin\Service;

use App\Models\Service;
use Livewire\Component;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{

    public Service $service;

    public function render()
    {
        return view('livewire.admin.service.show');
    }
}
