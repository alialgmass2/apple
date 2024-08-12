<?php

namespace App\Livewire\User\Profile;

// use App\Models\Order;
use Livewire\Component;
use App\Traits\HasModal;
use Livewire\WithPagination;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;
use App\Models\checkouts\orders\Order;

#[Layout(USER_LAYOUT)]
class Show extends Component
{
    use WithPagination, HasValidation,  HasModal;
    protected $paginationTheme = 'bootstrap';

    public function render()
    {
        $orders = Order::where('user_id',authUser()->id)->paginate(30);
        return view('livewire.user.profile.show', [
            'orders' => $orders,
        ]);
    }
}
