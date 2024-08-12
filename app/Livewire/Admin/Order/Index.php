<?php

namespace App\Livewire\Admin\Order;

use App\Models\Order;
use Livewire\Component;
use App\Traits\HasModal;
use Livewire\WithPagination;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use WithPagination, HasValidation,  HasModal;
    protected $paginationTheme = 'bootstrap';

    public $state = [];

    public function render()
    {
        $orders = Order::orderPaid();
        return view('livewire.admin.order.index', [
            'orders' => $orders,
        ]);
    }


     public function showModalEdit(Order $order)
    {
        dd('#HERE#');
        $this->state = $order->toArray();
        $this->editId = $order->id;
        $this->isEditMode = true;
        $this->isModalShow = true;
    }

    public function store()
    {
        dd('#HERE#');
        $validated = Validator::make($this->state,$this->validateOrder())->validate();
        Order::create($validated);
        $this->closeModal();
        $this->alertSuccess('Data Saved');

    }
    public function update(Order $order)
    {
        dd('#HERE#');
        $validated = Validator::make($this->state, $this->validateOrder($order->id))->validate();
        $order->update($validated);
        $this->closeModal();
        $this->alertSuccess('Data updated');
    }

    public function delete(Order $order)
    {
        dd('#HERE#');
        $order->delete();
        $this->dispatch('success');
    }


}
