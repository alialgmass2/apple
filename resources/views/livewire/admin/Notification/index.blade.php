<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.notification')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.notification')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div id="notification" class="main-notification-list Notification-scroll">
                        @if($notifications != null)
                            @foreach($notifications as $notification)
                                <a class="d-flex p-3 border-bottom" wire:click.prevent="goToDetails({{$notification->data['order_id']}})">
                                    <div class="mr-3">
                                        <h5 class="notification-label mb-1">{{$notification->data['title_en']}}</h5>
                                        {{--                    <div class="notification-subtext">{{$notification->data['user']}}</div>--}}
                                        <div class="">{{$notification->created_at}}</div>
                                    </div>
                                    <div class="mr-auto" >
                                        <i class="las la-angle-left text-left text-muted"></i>
                                    </div>
                                </a>
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
