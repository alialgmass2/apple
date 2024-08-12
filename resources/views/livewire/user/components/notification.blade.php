<div>
    <x-slot name="title"> @lang('app.notification')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.notification')</a></li>
    </x-slot>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-responsive-md">
                        <thead>
                        <tr>
                            <th><strong>@lang('app.id')</strong></th>
                            @if($type == 'admin')
                                <th><strong>@lang('app.user')</strong></th>
                            @endif
                            <th><strong>@lang('app.title')</strong></th>
                            <th><strong>@lang('app.date')</strong></th>
                            <th><strong>@lang('app.actions')</strong></th>
                        </tr>
                        </thead>
                        <tbody>
                        @forelse ($notifications as $key => $notification)

                            <tr @if(!$notification->read_at) style="background-color: #ffcb0821" @endif>
                                <td><strong>{{ ++$key }}</strong></td>
                                @if($type == 'admin')
                                    <td>{{ \App\Models\User::find($notification->data['user_id']??0)?->email }}</td>
                                @endif
                                <td>{{ $notification->data['title_en']}}</td>
                                <td>{{\Carbon\Carbon::parse($notification->created_at)->ago()}}</td>
                                <td>
                                    <div class="d-flex justify-content-start">
                                        <a wire:click.prevent="goToDetails('{{$notification->id}}')"
                                           class="btn btn-xs sharp text-warning fz-16px" title="More details"><i class="fa fa-eye"></i>
                                        </a>
                                        @if(!$notification->read_at)
                                            &nbsp;&nbsp;
                                            <a wire:click.prevent="markRead('{{$notification->id}}')" title="Mark as read"
                                               class="btn btn-xs sharp text-warning fz-16px"><i class="fa-regular fa-envelope-open"></i>
                                            </a>
                                        @endif
                                    </div>
                                </td>
                            </tr>

                        @empty

                        @endforelse
                        </tbody>
                    </table>
                </div>
{{--                {{ $notifications->links() }}--}}
            </div>
        </div>
    </div>
</div>
