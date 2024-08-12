<?php

namespace App\Livewire\Admin\Payments;

use App\Models\PaymentTransaction;
use App\Services\PaymentsService;
use Carbon\Carbon;
use Livewire\Component;
use App\Traits\HasModal;
use Livewire\WithPagination;
use App\Traits\HasValidation;
use Livewire\Attributes\Layout;
use App\Models\checkouts\orders\Order;


 #[Layout(ADMIN_LAYOUT)]
class Index extends Component
{
    use WithPagination, HasValidation, HasModal;
    protected $paginationTheme = 'bootstrap';
    public $state = [];
    public ?string $method = null;
    public ?string $from = null;
    public ?string $to = null;

    public function render()
    {
        $payments =(new PaymentsService())->get_transactions_from_to($this->from,$this->to,$this->method);
        return view('livewire.admin.payment-details.index', [
            'payments' => $payments,
        ]);
    }

 }
