<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.contact.index') }}">@lang('app.contacts')</a>
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
                    <td>{{ $contact->id }}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.name')</td>
                    <td>{{ $contact->name }}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.email')</td>
                    <td>{{ $contact->email }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.phone')</td>
                    <td>{{ $contact->phone }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.role')</td>
                    <td>{{ $contact->role->translate('name') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.institution')</td>
                    <td>{{ $contact->institution }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.message')</td>
                    <td>{{ $contact->message }}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.created_at')</td>
                    <td>{{ $contact->created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
