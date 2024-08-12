<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.payments')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.payments')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-flex justify-content-center">
                        {{-- <a href="#" class="btn btn-sm btn-outline-light">
                            <i class="fa-solid fa-arrow-left-long"></i> &nbsp;
                            Back
                        </a> --}}
                        <x-admin.select class="w-100" title="method" error="method" wire:model.live="method">
                            <option value="VISA">Visa & Master</option>
                            <option value="MADA">Mada</option>
                        </x-admin.select>
                        <x-admin.input title="from" error="from" type="date" wire:model.live="from" />
                        <x-admin.input title="to" error="to" type="date" wire:model.live="to" />
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th><strong>@lang('app.transaction_id')</strong></th>
                                    <th><strong>@lang('app.amount')</strong></th>
                                    <th><strong>@lang('app.payment_method')</strong></th>
                                    <th><strong>@lang('app.payment_status')</strong></th>
                                    <th><strong>@lang('app.date')</strong></th>
                                    <th><strong>@lang('app.actions')</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($payments as $index=>$payment)

                                <tr>
                                    <td><strong>{{ $payment?->merchantTransactionId }}</strong></td>
                                    <td>{{ $payment->amount }} SAR</td>
                                    <td>{{$payment->paymentBrand . ' - '  .$payment->card['last4Digits'] ?? ''}}</td>
                                    <td>
                                        @php($payment_status = ($payment->result['code'] == '000.000.000'))
                                        <span class="  order_status" style="background-color: {{ $payment_status ? '#0dfc0d' : '#f71616' }};"
                                              ;>{{ $payment_status ? 'Payment Succeed' : 'Payment Failed' }}
                                        </span>
                                    </td>
                                    {{-- <td>{{$payment->payment_transaction->status ==1 ? 'true' : 'false'}}</td> --}}
                                    <td>{{\Carbon\Carbon::parse($payment->timestamp)->format('F m y')}}</td>
                                    <td>
                                        <div class="d-flex justify-content-center">
                                            <a href="{{ route('admin.payments.show',$payment->merchantTransactionId) }}"
                                                class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                    wire:loading.class="disabled"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
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
