<?php

namespace App\Livewire\Admin\Orders;

use App\Getaways\TabbyGetaway;
use App\Models\Organization;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;
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
    public string $method = 'all';
    public string|null $transaction = null;
    public int|null $organization_id = null;
    public string $from = '';
    public string $to = '';

    public function render()
    {
//        (new TabbyGetaway())->get_payments_data('ds');
        $cache = Cache::get('order_pram');
        if ($cache){
            $cache['method'] != null ? $this->method = $cache['method'] : null;
            $cache['transaction'] != null ? $this->transaction = $cache['transaction'] : null;
            $cache['organization_id'] != null ? $this->organization_id = $cache['organization_id'] : null;
            $cache['from'] != null ? $this->from = $cache['from'] : '';
            $cache['to'] != null ? $this->to = $cache['to'] : '';
            Cache::forget('order_pram');
        }
        $orders = Order::listAdmin($this->method,$this->from,$this->to,$this->organization_id,transactionId:(string)$this->transaction)->latest()->paginate(10);
        $organizations = Organization::listDropown()->get();
        return view('livewire.admin.orders.index', [
            'orders' => $orders,
            'organizations' => $organizations
        ]);
    }
    public function show($id)
    {
        $pram = [
            'method'=>$this->method,
            'transaction'=>$this->transaction,
            'organization_id'=>$this->organization_id,
            'from'=>$this->from,
            'to'=>$this->to
        ];
        Cache::put('order_pram',$pram);
        return redirect()->route('admin.orders.show',[$id]);
    }

 }
