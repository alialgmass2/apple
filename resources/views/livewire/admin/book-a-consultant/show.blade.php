<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.bookaconsulation.index') }}">@lang('app.book_a_consulation')</a>
        </li>
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
                    <td>{{ $bookaconsulation->id }}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.name')</td>
                    <td>{{ $bookaconsulation->name }}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.email')</td>
                    <td>{{ $bookaconsulation->email }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.phone')</td>
                    <td>{{ $bookaconsulation->phone }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.role')</td>
                    <td>{{ $bookaconsulation->role->translate('name') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.institution')</td>
                    <td>{{ $bookaconsulation->institution }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.message')</td>
                    <td>{{ $bookaconsulation->message }}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.created_at')</td>
                    <td>{{ $bookaconsulation->created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
