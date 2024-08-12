<?php

namespace App\Livewire\User\Organization\Cart;

use Livewire\Component;
use Livewire\Attributes\Layout;

#[Layout(ORGANIZATION_LAYOUT)]
class Carts extends Component
{
    public function render()
    {
        return view('livewire.user.organization.cart.carts');
    }
}
