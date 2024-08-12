<?php

namespace App\Livewire\User\Organization\Organization;

use App\Models\Product;
use App\Traits\HasModalWebsite;
use Livewire\Component;
use Livewire\Attributes\Layout;


 #[Layout(ORGANIZATION_LAYOUT)]
class Organizations extends Component
{

    public function render()
    {
        return view('livewire.user.organization.organization.organizations');
    }
}
