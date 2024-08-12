<!DOCTYPE html>
<html lang="en">

<head>

    <!-- All Meta -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="author" content="DexignLab">
    <meta name="robots" content="">
    <meta name="keywords"
          content="bootstrap admin, card, clean, credit card, dashboard template, elegant, invoice, modern, money, transaction, Transfer money, user interface, wallet">
    <meta name="description"
          content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
    <meta property="og:title" content="Dompet - Payment Admin Dashboard Bootstrap Template">
    <meta property="og:description"
          content="Dompet is a clean-coded, responsive HTML template that can be easily customised to fit the needs of various credit card and invoice, modern, creative, Transfer money, and other businesses.">
    <meta property="og:image" content="https://dompet.dexignlab.com/xhtml/social-image.png">
    <meta name="format-detection" content="telephone=no">

    <!-- Mobile Specific -->
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- favicon -->
    <link rel="shortcut icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <!-- Page Title Here -->
    <title>{{ $title ?? 'DEFAULT TITLE' }}</title>



    <link href="{{ asset('vendor/jquery-nice-select/css/nice-select.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('vendor/nouislider/nouislider.min.css') }}">
    <!-- Style css -->
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
</head>
<body style="background-color: #FFFFFF">

<div class="table-responsive position-relative pt-0 table-bordered">
    <div class="container mt-0">
        {{--
        <hr> --}}
        <h3 class="text-left">Order Items</h3>
        <hr>
        <div class="row d-flex justify-content-start align-items-center">
            @forelse($order->items as $item)
                @if($item->product != '')
                    <div class="col-md-4 mb-4">
                        <a href="javascript:void(0);" class="product-item-link">
                            <div class="product-item">
                                <div class="image d-flex justify-content-center align-items-center">
                                    <img src="{{ $item->product->getFile('default_img') }}" alt="" style="height: 112px;width:111px" />

                                </div>
                                @php
                                    $sub_total = $item->total; //100
                                    $tax       = $item->vat;
                                    $total     = $item->total;
                                @endphp
                                <div class="details">
                                    <h1 class="mb-1">{{ $item->product->translate('title') }}</h1>

                                    <p class="fz-14px text-black mb-0">{{ $item->price }} SAR</p>
                                    <div class="d-flex justify-content-between">
                                        <p class="fz-14px text-black mb-0">Qty : {{$item->quantity}}</p>
                                        <p class="fz-14px text-black mb-0">Total : {{number_format((float)$total,2,'.','') }} SAR</p>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
            @empty

            @endforelse

        </div>
    </div>
    <table class="table table-responsive-md mt-5 table-bordered  xtable-striped">
        <thead>
        <tr>
            <th class="w-250px"><strong>Name</strong></th>
            <th><strong>@lang('app.description')</strong></th>
        </tr>
        </thead>
        <tbody>
        <tr>
            <td class="font-bold">ID</td>
            <td>{{ $order->id }}</td>
        </tr>
        <tr>
            <td class="font-bold">Payment Transaction Id</td>
            <td>{{ $order->payment_transaction_id }}</td>
        </tr>
        <tr>
            <td class="font-bold">Order Number</td>
            <td>{{ $order->order_number }}</td>
        </tr>
        <tr>
            <td class="font-bold">@lang('app.price')</td>
            <td>{{ $order->total }} SAR</td>
        </tr>

        <tr>
            <td class="font-bold">@lang('app.created_at')</td>
            <td>{{ $order->created_at }}</td>
        </tr>
        <tr>
            <td class="font-bold">@lang('app.address')</td>
            <td>{{ $order->addresses->address ?? '' }}</td>
        </tr>
        <tr>
            <td class="font-bold">@lang('app.phone')</td>
            <td>{{ $order->addresses->phone ?? '' }}</td>
        </tr>
        @if ( $order->addresses->type != 'organization')
            <tr>
                <td class="font-bold">@lang('app.short_national_id')</td>
                <td>{{ $order->addresses->short_national_id ?? '' }}</td>
            </tr>
            <tr>
                <td  class="font-bold">@lang('app.zip_code')</td>
                <td>{{ $order->addresses->zip_code ?? '' }}</td>
            </tr>
            <tr>
                <td  class="font-bold">@lang('app.state')</td>
                <td>{{ $order->addresses->region->name_en ?? '' }}</td>
            </tr>
            <tr>
                <td  class="font-bold">@lang('app.city')</td>
                <td>{{ $order->addresses->city->name_en ?? '' }}</td>
            </tr>
            <tr>
                <td  class="font-bold">@lang('app.distracts')</td>
                <td>{{ $order->addresses->distracts ?? '' }}</td>
            </tr>
        @endif
        <tr>
            <td class="font-bold">@lang('app.method')</td>
            <td>{{$order->payment_transaction?->method}}</td>
        </tr>
        {{-- <tr>
            <td class="font-bold">@lang('app.status')</td>
            <td>{{$order->payment_transaction?->status ==1 ? 'true' : 'false'}}</td>
        </tr> --}}
        <tr>
            <td class="font-bold">@lang('app.order_status')</td>
            <td><span class="badge badge-primary"
                      style="background-color: {{ handleColorsForOrderStatauses($order->order_status) }};color: {{ handleTextColorsForOrderStatauses($order->order_status) }};">{{
                            ucfirst(strtolower(str_replace('_',' ',$order->order_status))) }}</span></td>
        </tr>
        <tr>
            <td class="font-bold"></td>
            <td> <img src="{{$qr}}" alt="QR Code" /></td>
        </tr>

        </tbody>
    </table>
</div>
</body>
</html>
