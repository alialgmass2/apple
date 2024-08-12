<?php

namespace App\Livewire\Website\Components;

use App\Models\checkouts\orders\Order;
use App\Models\User;
use Livewire\Component;
use Livewire\Attributes\Layout;
use Illuminate\Support\Facades\Validator;
use Salla\ZATCA\GenerateQrCode;
use Salla\ZATCA\Tags\InvoiceDate;
use Salla\ZATCA\Tags\InvoiceTaxAmount;
use Salla\ZATCA\Tags\InvoiceTotalAmount;
use Salla\ZATCA\Tags\Seller;
use Salla\ZATCA\Tags\TaxNumber;
#[Layout(INVOICE_LAYOUT)]
class Invoice extends Component
{
    public Order $order;
    public $qr;
    public $user;
    public $orgnization;

    public function mount($order)
    {
        $this->qr = GenerateQrCode::fromArray([
            new Seller('شركة ضوابط التقنية للتجارة'), // seller name
            new TaxNumber('300925605200003'), // seller tax number
            new InvoiceDate($order->created_at), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
            new InvoiceTotalAmount($order->total), // invoice total amount
            new InvoiceTaxAmount(number_format($order->total*15/100)) // invoice tax amount sell
            // TODO :: Support others tags
        ])->render();
        abort_if($order->user_id != authUser()->id && authAdmin() == null,"404");
        $this->order = $order->load('items');
        $this->user = User::find($this->order?->user_id);
        $this->orgnization = $this->user->organization()->first();
    }
    public function render()
    {
//        if (str_contains(request()->url(),'order-pdf')){
//            abort_if($this->order == null,404);
//            $displayQRCodeAsBase64 = GenerateQrCode::fromArray([
//                new Seller('شركة ضوابط التقنية للتجارة'), // seller name
//                new TaxNumber('300925605200003'), // seller tax number
//                new InvoiceDate($this->order->created_at), // invoice date as Zulu ISO8601 @see https://en.wikipedia.org/wiki/ISO_8601
//                new InvoiceTotalAmount($this->order->total), // invoice total amount
//                new InvoiceTaxAmount(number_format($this->order->total*15/100)) // invoice tax amount sell
//                // TODO :: Support others tags
//            ])->render();
//            $qr=$displayQRCodeAsBase64;
//            abort_if($this->order->user_id != authUser()->id && !authAdmin(),"unathroized action");
//            $order = $this->order->load('items');
//            $pdf = \PDF::loadView('livewire.user.organization.invoice.print', ['user'=>$this->user,'orgnization'=>$this->orgnization,'qr'=>$this->qr,'order'=>$this->order]);
//            $pdf->download('sample.pdf');
////            return downloadPdf('livewire.user.organization.invoice.print',['user'=>$this->user,'orgnization'=>$this->orgnization,'qr'=>$this->qr,'order'=>$this->order]);
//        }else{
            return view('livewire.user.organization.invoice.print');
//        }
    }

}
