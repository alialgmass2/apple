<?php

namespace App\Livewire\Website\Components;

use App\Models\Service;
use Livewire\Component;

class Services extends Component
{
    public $services;

    public function mount()
    {
        $this->services = Service::list()->get();
    }

    public function render()
    {
        return view('livewire.website.components.services');
    }
}
