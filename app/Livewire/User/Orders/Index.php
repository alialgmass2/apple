<?php

namespace App\Livewire\User\Orders;

use Livewire\Component;
use App\Traits\HasModal;
use Livewire\WithPagination;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;


 #[Layout(USER_LAYOUT)]
class Index extends Component
{
    use WithPagination, HasValidation, HasModal;

    protected $paginationTheme = 'bootstrap';

    public $state = [];

    public function render()
    {
        // session()->flash('message',__('app.data_saved'));
        $orders = auth()->user()->orders()->latest()->orderPaid()->paginate();
        return view('livewire.user.orders.index', [
            'orders' => $orders,
        ]);
    }
}
