<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.order.index') }}">@lang('app.orders')</a>
        </li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.show')</a></li>
    </x-slot>
    <div class="table-responsive position-relative">
        <div class="order-product-container">
            <a href="javascript:void(0);" class="product-item-link">
                <div class="product-item">
                    <div class="image d-flex justify-content-center align-items-center">
                        <img src="{{ $order->product->getFile('default_img') }}" alt="" />
                    </div>
                    <div class="details">
                        <h1 class="mb-1">{{ $order->product->translate('title') }}</h1>
                        @if ($order->is_with_discount)
                        <p class="fz-14px text-black"><del>{{ $order->product->price }} SAR </del>{{ $order->price }}
                            SAR
                        </p>
                        @else
                        <p class="fz-14px text-black">{{ $order->price }} SAR</p>
                        @endif
                    </div>
                </div>
            </a>
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
                    <td>@lang('app.product')</td>
                    <td>{{ $order->product->translate('title') }}</td>
                </tr>

                <tr>
                    <td>@lang('app.organization')</td>
                    <td>{{ $order->organization->translate('name') }}</td>
                </tr>
                <tr>
                    <td>@lang('app.deliver_type')</td>
                    <td>{{ $order->deliver_type }}</td>
                </tr>
                <tr>
                    <td>@lang('app.phone')</td>
                    <td>{{ $order->phone }}</td>
                </tr>

                <tr>
                    <td>@lang('app.city')</td>
                    <td>{{ $order->city->translate('name') }}</td>
                </tr>

                <tr>
                    <td>@lang('app.district')</td>
                    <td>{{ $order->district }}</td>
                </tr>

                <tr>
                    <td>@lang('app.address')</td>
                    <td>{{ $order->address }}</td>
                </tr>
                <tr>
                    <td>@lang('app.short_national_id')</td>
                    <td>{{ $order->short_national_id }}</td>
                </tr>

                <tr>
                    <td>@lang('app.zip_code')</td>
                    <td>{{ $order->zip_code }}</td>
                </tr>

                <tr>
                    <td>@lang('app.price')</td>
                    <td>
                        @if ($order->is_with_discount)
                        <del>{{ $order->product->price }} SAR</del> {{ $order->price }} SAR
                        @else
                        {{ $order->price }} SAR
                        @endif
                    </td>
                </tr>

                <tr>
                    <td>@lang('app.created_at')</td>
                    <td>{{ $order->created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
