<?php

namespace App\Livewire\Admin\Orders;

use App\Getaways\TabbyGetaway;
use App\Services\PaymentsService;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;
use App\Enums\OrderStatus;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;
use App\Models\checkouts\orders\Order;
use Illuminate\Support\Facades\Validator;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    use HasValidation;
    public $order;
    public $state = [];
    public function mount(Order $order)
    {
        $this->order = $order->load('items');
    }

    public function render()
    {
        $orderStatauses = OrderStatus::array();
        if ($this->order->payment_transaction->method == 'tabby'){
//            dd($this->order->payment_transaction->payment_id);
            $payment = (new TabbyGetaway())->get_payments_data($this->order->payment_transaction->payment_id);
            dd($payment);
        }else{
            $payment = (new PaymentsService())->get_payment_with_transaction_id($this->order->payment_transaction->transaction_id);
        }

        return view('livewire.admin.orders.show',[
            'orderStatauses' => $orderStatauses,
            'payment' => $payment
        ]);
    }

    public function updateStatus()
    {
        Validator::make($this->state, $this->validateUpdateOrderStatus())->validate();
        abort_if($this->order->order_status == 'DELIVERED',501,'un atorized action');
        $this->order->update([
        'order_status' => $this->state['status'],
        ]);
        switch ($this->state['status']){
            case 'ORDER_PLACED';
                $title_en = 'Your order has been placed';
                $title_ar = 'الاوردر الخاص بكم تم قبولة بنجاح';
            break;
            case 'IN_PROGRESS';
                $title_en = 'Your order is in progress';
                $title_ar = 'الاوردر الخاص بكم تحت المعالجة الان';
            break;
            case 'SHIPPED';
                $title_en = 'Your order is shipped';
                $title_ar = 'الاوردر الخاص بكم تم التوصيل';
            break;
            case 'OUT_FOR_DELIVERY';
                $title_en = 'Your order is out for delivery';
                $title_ar = 'الاوردر الخاص بك في طريقة اليكم';
            break;
            case 'CANCELLED';
                $title_en = 'Your order is cancelled';
                $title_ar = 'الاوردر الخاص بك تم الغائه';
                (new PaymentsService())->refund($this->order->payment_transaction->transaction_id);
            break;
            default;
                $title_en = 'Your order is delivered pleas give feedback';
                $title_ar = 'الاوردر الخاص بك تم التوصيل الرجاء اعطائنا رائيكم';
        }
        $data = [
            'user_id' => $this->order->user_id,
            'order_id' => $this->order->id,
            'type' => 'update',
            'title_en' => $title_en,
            'title_ar' => $title_ar,
        ];
        sendNotification($data);
        $this->alertSuccess("Status Updated");
        $this->reset('state');
    }
}
