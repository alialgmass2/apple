<?php

namespace App\Livewire\User\Organization\Checkout;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout(ORGANIZATION_LAYOUT)]
class Checkouts extends Component
{
    public function render()
    {
        return view('livewire.user.organization.checkout.checkouts');
    }
}
