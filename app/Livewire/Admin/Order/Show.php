<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    public Order $order;

    public function render()
    {
        return view('livewire.admin.order.show');
    }
}
