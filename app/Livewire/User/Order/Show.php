<?php

namespace App\Livewire\User\Order;

use App\Models\Order;
use Livewire\Attributes\Layout;
use Livewire\Component;

#[Layout(USER_LAYOUT)]
class Show extends Component
{
    public $order;
    public function mount($orderId)
    {
        $this->order = Order::detailsByUserId($orderId, authUser()->id)->firstOrFail();
    }

    public function render()
    {
        return view('livewire.user.order.show');
    }
}
