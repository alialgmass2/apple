<div>
    <x-slot name="title">
        @lang('app.profile')
    </x-slot>
    <x-slot name="breadcrumb">
        @if (authUser()->user_type == "TEACHER")
        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">@lang('app.educator_dashboard')</a></li>
        @else
        <li class="breadcrumb-item"><a href="{{ route('user.dashboard') }}">@lang('app.student_dashboard')</a></li>
        @endif
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.profile')</a></li>
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
 
        <!--<div class="col-xl-4 col-xxl-4">-->
        <!--    <div class="card dashboard-card py-4 px-4 h-auto">-->
        <!--        <h4>Orders Count</h4>-->
        <!--        <div class="card-btns d-flex justify-content-between">-->
        <!--            <h5>{{ $orders->total() }}</h5>-->
        <!--            {{-- <a class="btn btn-dark btn-sm">Add New <i class="fa-solid fa-plus"></i></a> --}}-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--<div class="col-xl-4 col-xxl-4">-->
        <!--    <div class="card dashboard-card py-4 px-4 h-auto">-->
        <!--        <h4>Course</h4>-->
        <!--        <div class="card-btns d-flex justify-content-between">-->
        <!--            <h5>0</h5>-->
        <!--            {{-- <a class="btn btn-dark btn-sm">Add New <i class="fa-solid fa-plus"></i></a> --}}-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
        <!--<div class="col-xl-4 col-xxl-4">-->
        <!--    <div class="card dashboard-card py-4 px-4 h-auto">-->
        <!--        <h4>Other</h4>-->
        <!--        <div class="card-btns d-flex justify-content-between">-->
        <!--            <h5>0</h5>-->
        <!--            {{-- <a class="btn btn-dark btn-sm">Add New <i class="fa-solid fa-plus"></i></a> --}}-->
        <!--        </div>-->
        <!--    </div>-->
        <!--</div>-->
 
    </div>
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <h4 class="mb-4">Orders</h4>
             
        </div>
        <div class="col-xl-12 col-xxl-12">
            <div class="card dashboard-card py-4 px-4 h-auto">
                <div class="table-responsive">
                    <table class="table table-responsive-md table-bordered">
                        <thead>
                            <tr>
                                <th><strong>@lang('app.id')</strong></th>
                                <th><strong>@lang('app.price')</strong></th>
                                <th><strong>@lang('app.actions')</strong></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($orders as $order)

                            <tr>
                                <td><strong>{{ $order->id }}</strong></td>
                                <td>{{ $order->total }}   </td>
                                {{--
                                <td>
                                    @if ($order->is_with_discount)
                                    <del>{{ $order->product->price }} SAR</del> ${{ $order->price }} SAR
                                    @else
                                    {{ $order->price }} SAR
                                    @endif
                                </td> --}}
                                {{-- <td>{{ $order->product->translate('title') }}</td>
                                <td>
                                    @if ($order->is_with_discount)
                                    <del>{{ $order->product->price }} SAR</del> ${{ $order->price }} SAR
                                    @else
                                    {{ $order->price }} SAR
                                    @endif
                                </td> --}}
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <a href="{{ route('user.orders.show',[$order->id]) }}"
                                            class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
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
    {{-- <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <h4 class="mb-4">Orders</h4>
        </div>
        <div class="col-xl-12 col-xxl-12">
            <div class="card dashboard-card py-4 px-4 h-auto">
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center text-dark">
                        #1 <img src="{{ asset('images/card/3.jpg') }}" alt="" class="rounded ms-1  article-img" />
                        <div class="d-flex justify-content-center align-items-start flex-column ps-2">
                            <h6 class="mb-0">An Article</h6>
                            <p class="mb-0 fs-14">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <x-admin.action type="edit" />
                        <x-admin.action type="delete" />
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-12 col-xxl-12">
            <div class="card dashboard-card py-4 px-4 h-auto">
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center text-dark">
                        #1 <img src="{{ asset('images/card/3.jpg') }}" alt="" class="rounded ms-1  article-img" />
                        <div class="d-flex justify-content-center align-items-start flex-column ps-2">
                            <h6 class="mb-0">An Article</h6>
                            <p class="mb-0 fs-14">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <x-admin.action type="edit" />
                        <x-admin.action type="delete" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-xxl-12">
            <div class="card dashboard-card py-4 px-4 h-auto">
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center text-dark">
                        #1 <img src="{{ asset('images/card/3.jpg') }}" alt="" class="rounded ms-1  article-img" />
                        <div class="d-flex justify-content-center align-items-start flex-column ps-2">
                            <h6 class="mb-0">An Article</h6>
                            <p class="mb-0 fs-14">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <x-admin.action type="edit" />
                        <x-admin.action type="delete" />
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-12 col-xxl-12">
            <div class="card dashboard-card py-4 px-4 h-auto">
                <div class="d-flex justify-content-between">
                    <div class="d-flex justify-content-center align-items-center text-dark">
                        #1 <img src="{{ asset('images/card/3.jpg') }}" alt="" class="rounded ms-1  article-img" />
                        <div class="d-flex justify-content-center align-items-start flex-column ps-2">
                            <h6 class="mb-0">An Article</h6>
                            <p class="mb-0 fs-14">Lorem ipsum, dolor sit amet consectetur adipisicing elit.</p>
                        </div>
                    </div>
                    <div class="d-flex justify-content-center align-items-center">
                        <x-admin.action type="edit" />
                        <x-admin.action type="delete" />
                    </div>
                </div>
            </div>
        </div>

    </div> --}}
</div>
