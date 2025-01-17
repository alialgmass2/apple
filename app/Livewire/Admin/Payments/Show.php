<?php

namespace App\Livewire\Admin\Payments;

use App\Services\PaymentsService;
use Livewire\Component;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;


 #[Layout(ADMIN_LAYOUT)]
class Show extends Component
{
    use HasValidation;
    public $index;
    public $id;
    public function mount($index,$id)
    {
        $this->index = $index;
        $this->id = $id;
    }

    public function render()
    {
        $payment = (new PaymentsService())->get_payment_with_transaction_id($this->index,null,$this->id);
        return view('livewire.admin.payment-details.show', [
            'payment' => $payment,
        ]);
    }

}
