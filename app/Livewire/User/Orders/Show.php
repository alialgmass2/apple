<?php

namespace App\Livewire\User\Orders;

use Livewire\Component;
use Livewire\Attributes\Layout;
use App\Models\checkouts\orders\Order;
use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\InvoiceDate;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\Seller;
use Salla\ZATCA\Tags\TaxNumber;

 #[Layout(USER_LAYOUT)]
class Show extends Component
{
    public $order;
    public $qr;
    public function mount(Order $order)
    {
        $displayQRCodeAsBase64 = GenerateQrCode::fromArray([
            new Seller('شركة ضوابط التقنية للتجارة'), // seller name
            new TaxNumber('300925605200003'), // seller tax number
            new InvoiceDate($order->created_at), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
            new InvoiceTotalAmount($order->total), // invoice total amount
            new InvoiceTaxAmount(number_format($order->total*15/100)) // invoice tax amount sell
            // TODO :: Support others tags
        ])->render();

        $this->qr=$displayQRCodeAsBase64;
        abort_if($order->user_id != authUser()->id,"404");
        $this->order = $order->load('items');


    }

    public function render()
    {
        return view('livewire.user.orders.show');
    }
}
