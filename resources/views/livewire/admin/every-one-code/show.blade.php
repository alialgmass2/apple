<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.everyonecode.index') }}">@lang('app.everyonecodes')</a></li>
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
                    <td>{{ $everyonecode->id }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.image')</td>
                    <td>{!! handlePreviewFile($everyonecode->getFile()) !!}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.title')</td>
                    <td>{{ $everyonecode->translate('title') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.text')</td>
                    <td>{{ $everyonecode->translate('text') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.url')</td>
                    <td><a class="text-black" target="_blank" href="{{ $everyonecode->url }}">{{ $everyonecode->url }}</a></td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.created_at')</td>
                    <td>{{ $everyonecode->created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>