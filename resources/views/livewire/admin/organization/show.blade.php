<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.organization.index') }}">@lang('app.organizations')</a></li>
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
                    <td>{{ $organization->id }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.banner')</td>
                    <td><img class="image-preview" src="{{ $organization->getFile('banner') }}" alt="@lang('app.alt_image')" /></td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.image')</td>
                    <td><img class="image-preview" src="{{ $organization->getFile() }}" alt="@lang('app.alt_image')" /></td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.banner_dashboard')</td>
                    <td><img class="image-preview" src="{{ $organization->getFile('banner_dashboard') }}" alt="@lang('app.alt_image')" /></td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.logo_login')</td>
                    <td><img class="image-preview" src="{{ $organization->getFile('logo_login') }}" alt="@lang('app.alt_image')" /></td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.education_level')</td>
                    <td>{{ $organization->educationLevel->translate('name') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.region')</td>
                    <td>{{ $organization->region->translate('name') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.city')</td>
                    <td>{{ $organization->city->translate('name') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.name')</td>
                    <td>{{ $organization->translate('name') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.domain')</td>
                    <td>{{ $organization->domain }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.email')</td>
                    <td>{{ $organization->email }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.discount')</td>
                    <td>{{ $organization->discountView }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.delivery_price')</td>
                    <td>{{ $organization->delivery_price }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.max_order_number')</td>
                    <td>{{ $organization->max_order_number }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.address')</td>
                    <td>{{ $organization->address }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.created_at')</td>
                    <td>{{ $organization->created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
