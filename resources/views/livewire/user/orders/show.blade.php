<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('user.orders.index') }}">@lang('app.orders')</a>
        </li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.show')</a></li>
    </x-slot>
    <div class="table-responsive position-relative pt-0 table-bordered">
        <div class="container mt-0">
            {{--
            <hr> --}}
            <h3 class="text-left">Order Items</h3>
            @if($order->items)
                <hr>
                <div class="row d-flex justify-content-start align-items-center">
                    @forelse($order->items as $item)
                        @if($item->product != '')
                            <div class="col-md-4 mb-4">
                                <a href="javascript:void(0);" class="product-item-link">
                                    <div class="product-item">
                                        <div class="image d-flex justify-content-center align-items-center">
                                            <img src="{{ $item->product->getFile('default_img') }}" alt="" />

                                        </div>
                                        @php
                                            $sub_total = $item->price * $item->quantity; //100
                                            $total     = $sub_total -  ($sub_total*auth()->user()->organization->discount)/100;
                                            $tax       = $total * 15 / 100;
        //                                    $delivery_price = auth()->user()->organization->delivery_price ;
        //                                    $total     += $delivery_price;
                                            $total     = $total + $tax;
                                        @endphp
                                        <div class="details">
                                            <h1 class="mb-1">{{ $item->product->translate('title') }}</h1>

                                            <p class="fz-14px text-black mb-0">price: {{ $item->price }} SAR</p>
                                            <p class="fz-14px text-black mb-0">discount: {{ $item->discount??'' }} SAR</p>
                                            <p class="fz-14px text-black mb-0">vat: {{ $item->vat??'' }} SAR</p>
                                            @if($item->getColor())
                                                <p class="color">
                                                    <span class="color_title">colour:</span>
                                                    <span class="color_circle" style="background:{{ $item->getColor() }}"></span>
                                                </p>
                                            @endif
                                            <hr>
                                            <div class="d-flex justify-content-between">
                                                <p class="fz-14px text-black mb-0">Qty : {{$item->quantity}}</p>
                                                <p class="fz-14px text-black mb-0">Total : {{number_format((float)$item->total,2,'.','') }}</p>
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            </div>
                        @endif
                    @empty

                    @endforelse

                </div>
            @endif
      
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
      </div>

</div>
