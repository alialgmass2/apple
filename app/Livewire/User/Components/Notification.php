<?php

namespace App\Livewire\User\Components;

use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Notifications\DatabaseNotification as Notifications;
#[Layout(USER_LAYOUT)]
class Notification extends Component
{
    public $notifications;
    public $type;
    public function mount()
    {
        $this->type = 'user';
        $this->notifications = authUser()->notifications()->orderBy('created_at')->get();
    }

    public function render()
    {
        return view('livewire.user.components.notification');
    }

    public function goToDetails($id)
    {
        $notification = authUser()->notifications()->where('id',$id);
        $order_id = $notification->first()->data['order_id'];
        $notification->update(['read_at'=>now()]);
        return \redirect()->route('user.orders.show',$order_id);
    }
    public function markRead($id)
    {
        authUser()->notifications()->where('id',$id)->update(['read_at'=>now()]);
        $this->notifications = authUser()->notifications()->orderBy('created_at')->get();
    }
}
