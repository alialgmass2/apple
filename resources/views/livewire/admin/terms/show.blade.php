<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.terms.index') }}">@lang('app.terms')</a>
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
            @php
                $lang = config('app.locale');
                $title = 'title_'.$lang;
                $sub_title = 'sub_title_'.$lang;
                $content = 'content_'.$lang;
            @endphp
                <tr>
                    <td class="font-bold">ID</td>
                    <td>{{ $terms->id }}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.title')</td>
                    <td>{{ $terms->$title }}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.sub_title')</td>

                    <td>{{ $terms->$sub_title }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.terms')</td>
                    <td>
                        <ul>
                            @php $num = 1 ;@endphp
                            @foreach(explode("\n",$terms->$content) as $key => $item)
                                <li>{{$num++ .' . '. $item}}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.created_at')</td>
                    <td>{{ $terms->created_at }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.data_updated')</td>
                    <td>{{ $terms->updated_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
