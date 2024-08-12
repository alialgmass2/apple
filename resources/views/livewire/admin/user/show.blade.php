<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.user.index') }}">@lang('app.users')</a>
        </li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.show')</a></li>
    </x-slot>
    <div class="table-responsive">
        <table class="table table-responsive-md table-bordered">
            <thead>
                <tr>
                    <th class="w-250px"><strong>@lang('app.name')</strong></th>
                    <th><strong>@lang('app.description')</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">ID</td>
                    <td>{{ $user->id }}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.user_type')</td>
                    <td>{{ $user->user_type }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.region')</td>
                    <td>{{ $user->region->translate('name') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.city')</td>
                    <td>{{ $user->city->translate('name') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.education_level')</td>
                    <td>{{ $user->educationLevel->translate('name') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.organization')</td>
                    <td>{{ $user->organization->translate('name') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.email')</td>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <td class="font-bold">Otp Verified</td>
                    <td>{{ $user->otp_verified }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
