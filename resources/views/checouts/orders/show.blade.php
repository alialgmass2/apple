
@extends('checouts.app-organization')
@section('content')
<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">@lang('app.orders')</a>
        </li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.show')</a></li>
    </x-slot>
    <div class="table-responsive ">
        <div class="order-product-container" >



        </div>
        <table class="table table-responsive-md mt-3">
            <thead>
                <tr>
                    <th class="w-250px"><strong>Name</strong></th>
                    <th><strong>@lang('app.description')</strong></th>

                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>ID</td>
                    <td>{{ $order->id }}</td>
                </tr>


                <tr>
                    <td>@lang('app.price')</td>
                    <td>

                        {{ $order->total }} SAR

                    </td>
                </tr>

                <tr>
                    <td>@lang('app.created_at')</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
                <tr>
                    <td>address</td>
                    <td>{{ $order->addresses->address ?? '' }}</td>
                </tr>
                <tr>
                    <td>phone</td>
                    <td>{{ $order->addresses->phone ?? '' }}</td>
                </tr>
                <tr>
                    <td>short_national_id</td>
                    <td>{{ $order->addresses->short_national_id ?? '' }}</td>
                </tr>
                <tr>
                    <td>zip_code</td>
                    <td>{{ $order->addresses->zip_code ?? '' }}</td>
                </tr>
                <tr>
                    <td>state</td>
                    <td>{{ $order->addresses->region->name_en ?? '' }}</td>
                </tr>
                <tr>
                    <td>city</td>
                    <td>{{ $order->addresses->city->name_en ?? '' }}</td>
                </tr>
                <tr>
                    <td>distracts</td>
                    <td>{{ $order->addresses->distracts ?? '' }}</td>
                </tr>
                <tr>
                    <td>method</td>
                <td>
                    {{$order->payment_transaction->method}}
                </td>
                </tr>
                <tr>
                    <td>status</td>
                <td>
                    {{$order->payment_transaction->status ==1 ? 'true' : 'false'}}
                </td>
                </tr>

            </tbody>
        </table>
    </div>
    <div class="table-responsive">
        <table class="table">
            <thead class="text-center">
            <tr>
                <th class="py-1">products</th>

                <th class="py-1">price</th>
                <th class="py-1">quantity</th>
                <th class="py-1">total</th>
            </tr>
            </thead>
            <tbody class="text-center">
            @forelse($order->items as $item)
                @if($item->product != '')
                    <tr>
                        <td class="py-1">
                            <p class="card-text fw-bold mb-25">{{$item->product->title_en ?? '-'}}</p>
                        </td>

                        <td class="py-1">
                            @if($item->quantity !=0)
                            <span class="fw-bold">{{$item->price/$item->quantity }}</span>
                            @else
                                <span class="fw-bold">0</span>
                            @endif
                        </td>
                        <td class="py-1">
                            <span class="fw-bold">{{$item->quantity}}</span>
                        </td>
                        <td class="py-1">
                            <span class="fw-bold">{{$item->total }}</span>
                        </td>
                    </tr>
                @endif
            @empty

            @endforelse
            </tbody>
        </table>
    </div>
</div>
@stop
