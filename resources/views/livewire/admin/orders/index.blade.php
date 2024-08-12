<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.order')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.order')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-center">
                    <h4 class="card-title d-flex justify-content-center">
                        {{-- <a href="#" class="btn btn-sm btn-outline-light">
                            <i class="fa-solid fa-arrow-left-long"></i> &nbsp;
                            Back
                        </a> --}}
                        <x-admin.select class="w-100" title="method" error="method" wire:model.live="method">
                            <option value="all">All</option>
                            <option value="visa">Visa</option>
                            <option value="mada">Mada</option>
                            <option value="tabby">Tabby</option>
                            <option value="cash">cash</option>
                        </x-admin.select> &nbsp;&nbsp;
                        <x-admin.select title="Transaction Id" error="organization_id" wire:model.live="organization_id">
                            <option value="">@lang('app.choose')</option>
                            @forelse ($organizations as $organization)
                                <option value="{{ $organization->id }}">{{ $organization->translate('name') }}</option>
                            @empty
                            @endforelse
                        </x-admin.select> &nbsp;&nbsp;
                        <x-admin.input title="transaction" error="transaction" wire:model.live="transaction" /> &nbsp;&nbsp;
                        <x-admin.input title="from" error="from" type="date" wire:model.live="from" /> &nbsp;&nbsp;
                        <x-admin.input title="to" error="to" type="date" wire:model.live="to" />
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th><strong>@lang('app.number')</strong></th>
                                    <th><strong>@lang('app.price')</strong></th>
                                    <th><strong>@lang('app.date')</strong></th>
                                    <th><strong>@lang('app.payment_method')</strong></th>
                                    <th><strong>@lang('app.payment_status')</strong></th>
                                    <th><strong>@lang('app.organization')</strong></th>
                                    <th><strong>@lang('app.actions')</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)

                                <tr>
                                    <td><strong>{{ $order->order_number }}</strong></td>
                                    <td>{{ $order->total }} SAR</td>
                                    <td>{{ \Carbon\Carbon::parse($order->created_at)->format('F m Y') }}</td>
                                    <td>{{$order->payment_transaction->method}}</td>
                                    {{-- <td>{{$order->payment_transaction->status ==1 ? 'true' : 'false'}}</td> --}}
                                    <td><span class="  order_status" style="background-color: {{ handleColorsForOrderStatauses($order->order_status) }}; color: {{ handleTextColorsForOrderStatauses($order->order_status) }};"
                                        ;>{{ ucfirst(strtolower(str_replace('_',' ',$order->order_status))) }}</span>
                                    </td>
                                    <td>{{$order->user->organization->name_en}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a wire:click.prevent="show({{ $order->id }})"
                                                class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                    wire:loading.class="disabled"></i></a>
                                            <a class="btn btn-xs sharp me-1 text-primary fz-16px"
                                               onclick="print({{ $order->id }})">
                                                <i class="fa-solid fa-print"></i>
                                            </a>
                                            <a href="{{route('order_pdf',$order->id)}}" class="btn btn-xs sharp me-1 text-primary fz-16px">
                                                <i class="fa-regular fa-file-pdf"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $orders->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL START --}}
    <x-admin.modal title="order" :isModalShow="$isModalShow" :isEditMode="$isEditMode">

        <div class="col-xl-12 col-lg-12">
            <x-admin.input title="name_en" error="name_en" wire:model="state.name_en" />
        </div>
        <div class="col-xl-12 col-lg-12">
            <x-admin.input title="name_ar" error="name_ar" wire:model="state.name_ar" />
        </div>
        <x-slot name="buttons">
            @if ($isEditMode)
            <x-admin.button-submit title="submit" wire:click.prevent="update({{ $editId }})" />
            @else
            <x-admin.button-submit title="submit" wire:click.prevent="store" />
            @endif
        </x-slot>
    </x-admin.modal>
    {{-- MODAL END --}}


</div>
