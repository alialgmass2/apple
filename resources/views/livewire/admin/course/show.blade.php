<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.course.index') }}">@lang('app.courses')</a>
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
                    <td>{{ $course->id }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.banner')</td>
                    <td><img class="image-preview" src="{{ $course->getFile('banner') }}"
                            alt="@lang('app.alt_image')" /></td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.image')</td>
                    <td><img class="image-preview" src="{{ $course->getFile() }}" alt="@lang('app.alt_image')" />
                    </td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.education_level')</td>
                    <td>{{ $course->educationLevel->translate('name') != NULL ? $course->educationLevel->translate('name') : 'ALL ' }}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.title')</td>
                    <td>{{ $course->translate('title') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.estimated_time')</td>
                    <td>{{ $course->estimated_time }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.brief')</td>
                    <td>
                      @php
                        $breifs = explode(PHP_EOL, $course->translate('brief'));
                        @endphp
                        @for ($i = 0; $i < count($breifs); $i++) <li class="mb-1 fz-1rem">{{ $breifs[$i] }}</li>
                            @endfor
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.what_will_learn')</td>
                    <td>@php
                    $what_will_learns = explode(PHP_EOL, $course->translate('what_will_learn'));
                    @endphp
                    @for ($i = 0; $i < count($what_will_learns); $i++) <li class="mb-1 fz-1rem">{{ $what_will_learns[$i] }}</li>
                        @endfor</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.content')</td>
                    <td>
                        @php
                        $contents = explode(PHP_EOL, $course->translate('content'));
                        @endphp
                        @for ($i = 0; $i < count($contents); $i++) <li class="mb-1 fz-1rem">{{ $contents[$i] }}</li>
                            @endfor
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.requirements')</td>
                    <td>
                        @php
                        $requirements = explode(PHP_EOL, $course->translate('requirements'));
                        @endphp
                        @for ($i = 0; $i < count($requirements); $i++) <li class="mb-1 fz-1rem">{{ $requirements[$i] }}</li>
                            @endfor
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.description')</td>
                    <td>
                        @php
                        $descriptions = explode(PHP_EOL, $course->translate('description'));
                        @endphp
                        @for ($i = 0; $i < count($descriptions); $i++) <li class="mb-1 fz-1rem">{{ $descriptions[$i] }}</li>
                            @endfor
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.about')</td>
                    <td>
                        @php
                        $abouts = explode(PHP_EOL, $course->translate('about'));
                        @endphp
                        @for ($i = 0; $i < count($abouts); $i++) <li class="mb-1 fz-1rem">{{ $abouts[$i] }}</li>
                            @endfor
                    </td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.url')</td>
                    @php $url = explode('://',$course->url) @endphp
                    <td><a href="{{ $course->url }}">{{$url[1]??$url[0]??'Not Found'}}</a></td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.created_at')</td>
                    <td>{{ $course->created_at }}</td>
                </tr>

            </tbody>
        </table>
    </div>
</div>
