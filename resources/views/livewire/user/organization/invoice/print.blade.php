@php use Carbon\Carbon; @endphp
<div class=" " id="editor">

    <!-- Start Header -->
    <div class="header">
        <div class=" header_container">
            <div class="navbar">
                <div class="navbar-logo">
                    <img width="250px" src="{{ asset('images/logo.png') }}" alt="logo"/>
                </div>
                <div>
                    <p class="invoice">Inovice : <span class="">{{$order->order_number}}</span></p>
                    <p class="invoice"> Date : <span
                            class="">{{Carbon::parse($order->created_at)->format('d/m/Y')}}</span></p>
                </div>
            </div>
            <div class="bill">
                <div class=" col-6">
                    <P class="title mb-2"> Customer Information </P>
                    <div class="bill_padding">
                        <p class="invoice mb-0">name :
                            <span>{{$order->addresses()->first()?->fname}} {{$order->addresses()->first()?->lname}}</span>
                        </p>


                        <p class="invoice mb-0">E-mail : <span>{{$user->email}}</span></p>
                        <p class="invoice mb-0">Phone : <span>{{$order->addresses()->first()?->phone}}</span></p>
                        <p class="invoice mb-0">user type : <span>{{$user->user_type}}</span></p>
                        @if($order->addresses()->first()->type == 'home')
                            @php
                                $address = $order->addresses()->with(['city','region'])
                            @endphp

                            <p class="invoice mb-0">Region :
                                <span>{{$order->addresses()->first()->region()->first()->name_en}}</span>
                            </p>
                            <p class="invoice mb-0">@lang('app.city') :
                                <span>{{$order->addresses()?->first()->city()->first()->name_en}}</span>
                            </p>
                            <p class="invoice mb-0">@lang('app.distracts') :
                                <span>{{$order->addresses()->first()?->distracts}}</span>
                            </p>
                            <p class="invoice mb-0">Zip code :
                                <span>{{$order->addresses()->first()->zip_code}}</span>
                            </p>
                        @endif
                    </div>
                </div>
                <div class="organization  col-6">
                    <P class="title mb-2"> organization Information </P>
                    <div class="bill_padding">
                        <p class="invoice mb-0">name : <span>{{$orgnization->name_en}}</span></p>
                        <p class="invoice mb-0">region : <span>{{$orgnization->region()->first()?->name_en}}</span></p>
                        <p class="invoice mb-0">city : <span>{{$orgnization->city()->first()?->name_en}}</span></p>
                        <p class="invoice mb-0">address : <span>{{$orgnization->address}}</span></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End Header -->
    <div class="header_container content">
        <table class="table table-responsive-md table-bordered table-striped">
            <thead>
            <tr>
                <th class="w-250px"><strong>Item</strong></th>
                <th><strong>Unit Price</strong></th>
                <th><strong>Quantity</strong></th>
                <th><strong>unit discount</strong></th>
                <th><strong>total discount</strong></th>
                <th><strong> vat</strong></th>
                <th><strong>total after discount and vat</strong></th>
            </tr>
            </thead>
            <tbody>
            @forelse($order->items as $item)
                @if($item->product != '')
                    <tr>
                        <td class="font-bold">{{$item->product?->title_en}}</td>
                        <td>{{$item->price  /  $item->quantity}}</td>
                        <td>{{$item->quantity}}</td>
                        <td class="font-bold">{{$item->discount  / $item->quantity}}</td>
                        <td class="font-bold">{{$item->discount}}</td>
                        <td>{{$item->vat}}</td>
                        <td>{{$item->total}}</td>

                    </tr>
                @endif
            @empty
            @endforelse
            </tbody>
        </table>
        <p class="invoice_summary"> Invoice summary</p>
        <div class="invoice_qr">
            <div class="w-50 ">
                <table class="table table-responsive-md table-bordered table-striped-columns">

                    <tbody>
                    <tr>
                        <td class="font-bold"> Total price before discount</td>
                        <td>{{$order->items?->sum('price')}} SAR</td>
                    </tr>
                    <tr>
                        <td class="font-bold"> discount</td>
                        <td>{{$order->items?->sum('discount')}} SAR</td>
                    </tr>
                    <tr>
                        <td class="font-bold">Vat </td>
                        <td>{{number_format($order->items?->sum('vat'),2)}}</td>
                    </tr>
                    <!--<tr>-->
                    <!--    <td class="font-bold"> total after discount and vat without delivery</td>  -->
                    <!--    <td>{{$order->items?->sum('total')}} SAR</td>  -->
                    <!--</tr>-->

                    @if($order->addresses()->first()->type == 'home')
                            <tr>
                                <td class="font-bold"> delivery</td>
                                <td>{{$order->order_details['delivery_cost'] ?? 0}} SAR</td>
                            </tr>
                    @endif

                    <!--<tr>-->
                    <!--    <td class="font-bold">total price after discount and Vat</td>-->
                    <!--    <td>{{$order->items}}</td>-->
                    <!--</tr>-->

                    <tr>
                        <td class="font-bold"> Total</td>
                        <td>{{$order->total}} SAR</td>
                    </tr>


                    </tbody>
                </table>
            </div>
            <img class="qr" src="{{$qr}}" alt="QR Code">

        </div>
    </div>

</div>


 