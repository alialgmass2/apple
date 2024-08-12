<?php

namespace App\Livewire\Admin\Notification;

use Livewire\Attributes\Layout;
use Livewire\Component;
use Illuminate\Notifications\DatabaseNotification as Notifications;
#[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    public $notifications;
    public $type;
    public function mount()
    {
        $this->type = 'admin';
        $this->notifications = authAdmin()->notifications()->orderBy('created_at')->get();
    }

    public function render()
    {
        return view('livewire.user.components.notification');
    }

    public function goToDetails($id)
    {
        $notification = authAdmin()->notifications()->where('id',$id);
        $order_id = $notification->first()->data['order_id'];
        $notification->update(['read_at'=>now()]);
        return \redirect()->route('admin.orders.show',$order_id);
    }
    public function markRead($id)
    {
        authAdmin()->notifications()->where('id',$id)->update(['read_at'=>now()]);
        $this->notifications = authAdmin()->notifications()->orderBy('created_at')->get();
    }
}
