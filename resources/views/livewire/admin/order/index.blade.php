<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.order')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.order')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">

                        <a href="#" class="btn btn-sm btn-outline-light">
                            <i class="fa-solid fa-arrow-left-long"></i> &nbsp;
                            @lang('app.back')
                        </a>
                    </h4>
                    <h4 class="card-title">
                        {{-- <x-admin.button-create title="order" wire:click="showModal" /> --}}
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>@lang('app.id')</strong></th>
                                    <th><strong>@lang('app.product')</strong></th>
                                    <th><strong>@lang('app.price')</strong></th>
                                    <th><strong>@lang('app.actions')</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)

                                <tr>
                                    <td><strong>{{ $order->id }}</strong></td>
                                    <td>{{ $order->product->translate('title') }}</td>
                                    <td>
                                        @if ($order->is_with_discount)
                                        <del>{{ $order->product->price }} SAR</del> {{ $order->price }} SAR
                                        @else
                                        {{ $order->price }} SAR
                                        @endif
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('admin.order.show',[$order->id]) }}" class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                    wire:loading.class="disabled"></i></a>
                                            {{-- <a href="#" class="btn btn-xs sharp me-1 text-primary fz-16px"
                                                wire:loading.class="disabled"
                                                wire:click.prevent="showModalEdit({{ $order->id }})"><i
                                                    class="fa-regular fa-pen-to-square"></i></a> --}}
                                            {{-- <a href="#" class="btn btn-xs sharp text-danger fz-16px"><i
                                                    class="fa fa-trash-can" wire:loading.class="disabled"
                                                    wire:confirm="Are you sure you need to delete ?"
                                                    wire:click.prevent="delete({{ $order->id }})"></i></a> --}}
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
