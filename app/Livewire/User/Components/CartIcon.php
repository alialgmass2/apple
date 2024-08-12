<?php

namespace App\Livewire\User\Components;

use Livewire\Attributes\On;
use Livewire\Component;

class CartIcon extends Component
{


    #[On('update-cart-count')]
    public function getCount()
    {
        return auth()->user()->cart()->count();
    }

    public function render()
    {
        $cartCount = $this->getCount();
        return view('livewire.user.components.cart-icon', [
            'cartCount' => $cartCount,
        ]);
    }
}
