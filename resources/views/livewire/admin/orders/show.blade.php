<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.orders.index') }}">@lang('app.orders')</a>
        </li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.show')</a></li>
    </x-slot>
    <div class="table-responsive position-relative pt-0">
        <div class="container mt-0">
            {{--
            <hr> --}}
            @if ($order->order_status != 'DELIVERED')
                <h3 class="fw-bold mb-3 fs-26">Update Status Control</h3>
                <div class="  d-flex justify-content-between align-items-center">
                    <div class="col-6">
                        <x-admin.select error="status" title="Statuses" wire:model.defer="state.status" class=" rounded-1 mb-0">
                            <option value="">Choose</option>
                            @forelse ($orderStatauses as $key => $orderStataus)
                                <option value="{{ $key }}" {{$orderStataus == $order->order_status ? "selected":''}}> {{ ucfirst(strtolower(str_replace('_',' ',$orderStataus))) }}</option>
                            @empty
                            @endforelse
                        </x-admin.select>
                    </div>
                    <div class="col-5">
                        @if ($order->order_status != 'DELIVERED')
                            <button class="rounded-1 btn btn-sm btn-outline-dark mb-3" wire:loading.class="disabled"
                                    wire:click.prevent="updateStatus">
                                @lang("app.update")
                            </button>
                        @endif
                    </div>
                </div>
            @endif

            <h3 class="text-left">Order Items</h3>
            <hr>
            <div class="row d-flex justify-content-start align-items-center">
                @foreach($order->items as $item)
                @if($item->product != '')
                <div class="col-md-4 mb-4">
                    <a href="javascript:void(0);" class="product-item-link">
                        <div class="product-item ">
                            <div class="image d-flex justify-content-center align-items-center">
                                <img src="{{ $item->product->getFile('default_img') }}" alt="" />
                            </div>
                            <div class="details">
                                <h1 class="mb-1">{{ $item->product->translate('title') }}</h1>
                                <p class="fz-14px text-black mb-0">{{ $item->price }} SAR</p>
                                @if($item->getColor())
                                                <p class="color">
                                                    <span class="color_title">colour:</span>
                                                    <span class="color_circle" style="background:{{ $item->getColor() }}"></span>
                                                </p>
                                            @endif
                                <div class="d-flex justify-content-between">
                                    <p class="fz-14px text-black mb-0">Qty : {{$item->quantity}}</p>
                                    <p class="fz-14px text-black mb-0">Total : {{$item->total }}</p>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
                @endif
                @endforeach
            </div>
        <h3 class="fw-bold mb-3 fs-26">Order Details</h3>
        <table class="table table-responsive-md mt-5 table-bordered  xtable-striped">
            <thead>
                <tr>
                    <th class="w-250px"><strong>Name</strong></th>
                    <th><strong>Description</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">System Id</td>
                    <td>{{ $order->id }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.order_status')</td>
                    <td><span class="badge badge-primary"
                            style="background-color: {{ handleColorsForOrderStatauses($order->order_status) }};color: {{ handleTextColorsForOrderStatauses($order->order_status) }};">{{
                            ucfirst(strtolower(str_replace('_',' ',$order->order_status))) }}</span></td>
                </tr>
                <tr>
                    <td  class="font-bold">Payment Transaction Id</td>
                    <td>{{ $order->payment_transaction_id }}</td>
                </tr>
                <tr>
                    <td  class="font-bold">Order Number</td>
                    <td>{{ $order->order_number }}</td>
                </tr>

                <tr>
                    <td  class="font-bold">@lang('app.price')</td>
                    <td>{{ $order->total }} SAR</td>
                </tr>

                <tr>
                    <td  class="font-bold">@lang('app.created_at')</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
                <tr>
                    <td  class="font-bold">@lang('app.address')</td>
                    <td>{{ $order->addresses->address ?? '' }}</td>
                </tr>
                <tr>
                    <td  class="font-bold">@lang('app.phone')</td>
                    <td>{{ $order->addresses->phone ?? '' }}</td>
                </tr>

                @if ( $order->addresses->type != 'organization')
                <tr>
                    <td  class="font-bold">@lang('app.short_national_id')</td>
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



            </tbody>
        </table>
        @if($payment)
            @if($order->payment_transaction?->method != 'tabby')
                @include('components.admin.order.other-method-details')
            @elseif($order->payment_transaction?->method == 'tabby')
                @include('components.admin.order.tabby-details')
            @endif
        @endif


    </div>

  </div>
</div>
