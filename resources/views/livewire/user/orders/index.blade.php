<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.order')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">{{__('app.dashboard')}}</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.order')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card dashboard-card py-4 px-4 dashboard-card-bg d-flex position-relative" style="background-image:url('{{ authUser()->organization->getFile('banner_dashboard') }}'); background-size: cover;">
                <h3 class="text-white">{{ authUser()->organization->translate('name') }}</h3>
                <div class="d-flex">
                    <div>
                        <div class="card-icon dashboard-card-profile">
                            <img src="{{ authUser()->organization->getFile() }}" class="dashboard-icon" alt="" />
                        </div>
                    </div>
                    <div class="ms-2 text-white d-flex flex-column justify-content-center">
                        <p class="text-white mb-0 fs-16">{{ authUser()->email }}</p>
                        <p class="text-white mb-0 fs-16">
                            @if (authUser()->user_type == "TEACHER")
                            Educator
                            @else
                            Student
                            @endif
                        </p>
                        {{-- <p class="mb-0 fs-14">0123123</p> --}}
                        <p class="fs-14">{{ authUser()->organization->city->translate('name') }}</p>
                    </div>
                    {{-- <img src="{{ authUser()->organization->getFile() }}" class="profile-orgnization-logo" alt=""  /> --}}
                </div>

            </div>

        </div>
        <div class="col-lg-12">
            <div class="card">

                <div class="card-body">
                    @if($orders)
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th>@lang('app.transaction_id')</th>
                                    <th><strong>@lang('app.price')</strong></th>
                                    <th><strong>@lang('app.payment_method')</strong></th>
                                    <th><strong>@lang('app.payment_status')</strong></th>
                                    <th><strong>@lang('app.date')</strong></th>
                                    <th><strong>@lang('app.actions')</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($orders as $order)

                                <tr>
                                    <td><strong>{{ $order->payment_transaction_id }}</strong></td>
                                    <td>{{ $order->total }}</td>
                                    <td>{{$order->payment_transaction->method}}</td>
                                    {{-- <td>{{$order->payment_transaction->status ==1 ? 'true' : 'false'}}</td> --}}
                                    <td><span class="badge badge-primary" style="background-color: {{ handleColorsForOrderStatauses($order->order_status) }};color: {{ handleTextColorsForOrderStatauses($order->order_status) }};"
                                        ;>{{ ucfirst(strtolower(str_replace('_',' ',$order->order_status))) }}</span>
                                    </td>
                                    <td>{{\Carbon\Carbon::parse($order->created_at)->format('Y-m-d')}}</td>
                                    <td>
                                        <div class="d-flex justify-content-start icon_gap">
                                            <a href="{{ route('user.orders.show',[$order->id]) }}"
                                                class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                    wire:loading.class="disabled"></i>
                                            </a>
                                            <a class="btn btn-xs sharp me-1 text-primary fz-16px"
                                               onclick="print({{ $order->id }})">
                                                <i class="fa-solid fa-print"></i>
                                            </a>

                                           <a href="{{route('order_pdf',$order->id)}}" class="btn btn-xs sharp me-1 text-primary fz-16px" >
                                                <i class="fa-regular fa-file-pdf"></i>
                                            </a>


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
                    @endif
                </div>


            </div>
        </div>
    </div>
    {{-- MODAL START --}}
    <x-admin.modal title="order" :isModalShow="$isModalShow" :isEditMode="$isEditMode">

        <div class="col-xl-12 col-lg-12" >
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

    @push('js')
    <script>
        @if(Session::has('message'))
// console.log('from swal');
// Swal.fire("success","{{Session::get('message') ?? 'success'}}","success")
Swal.fire("success","Thank you for your purchase. Your product has been successfully ordered.","success")
// Swal.fire({
// title: "{{Session::get('message') ?? 'success'}}",
// text: "{{Session::get('message') ?? 'success'}}",
// icon: "success"
// });
// swal("{{Session::get('message') ?? 'success'}}");

@endif
    </script>
    @endpush



    <div class=" d-none"  id="editor">
    </div>



</div>
