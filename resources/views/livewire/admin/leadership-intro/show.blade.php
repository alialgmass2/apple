<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.leadershipintro.index') }}">@lang('app.leadershipintros')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.show')</a></li>
    </x-slot>
    <div class="table-responsive">
        <table class="table table-responsive-md table-bordered">
            <thead>
                <tr>
                    <th class="w-250px"><strong>Name</strong></th>
                    <th><strong>@lang('app.description')</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">ID</td>
                    <td>{{ $leadershipintro->id }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.title')</td>
                    <td>{{ $leadershipintro->translate('title') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.text')</td>
                    <td>{{ $leadershipintro->translate('text') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.created_at')</td>
                    <td>{{ $leadershipintro->created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
