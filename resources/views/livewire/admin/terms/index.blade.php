<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.terms')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.terms')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">

                        <a href="#" class="btn btn-sm btn-outline-light">
                            <i class="fa-solid fa-arrow-left-long"></i> &nbsp;
                            @lang('app.back')
                        </a>
                    </h4>
                    <h4 class="card-title">
                        <x-admin.button-update title="terms_headers" wire:click="showModalHeader" />
                        <x-admin.button-create title="terms" wire:click="showModal" />
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th><strong>@lang('app.id')</strong></th>
                                    <th><strong>@lang('app.title')</strong></th>
                                    <th><strong>@lang('app.sub_title')</strong></th>
                                    <th><strong>@lang('app.content')</strong></th>
                                    <th><strong>@lang('app.actions')</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                            @php
                                $lang = config('app.locale');
                                $title = 'title_'.$lang;
                                $sub_title = 'sub_title_'.$lang;
                                $content = 'content_'.$lang;
                                $count = $terms->count()+1;
                            @endphp
                            @forelse ($terms as $keyP => $term)
                                @php
                                    $count = --$count;
                                @endphp
                                <tr>
                                    <td><strong>{{ $count }}</strong></td>
                                    <td>{{ $term->$title??'' }}</td>
                                    <td>{{ $term->$sub_title??'-------' }}</td>
                                    <td><ul>
                                        @foreach(explode("\n",$term->$content) as $keyS => $item)
                                            <li>{{$count . '.' .++$keyS .' . '. $item}}</li>
                                        @endforeach
                                    </ul></td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a title="Show" href="{{ route('admin.terms.show',[$term->id]) }}"
                                                class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                    wire:loading.class="disabled"></i></a>
                                             <a title="Edit" href="#" class="btn btn-xs sharp me-1 text-primary fz-16px"
                                                wire:loading.class="disabled"
                                                wire:click.prevent="showModalEdit({{ $term->id }})"><i
                                                    class="fa-regular fa-pen-to-square"></i></a>
                                            <a title="Delete" href="#" class="btn btn-xs sharp text-danger fz-16px"><i
                                                    class="fa fa-trash-can" wire:loading.class="disabled"
                                                    wire:confirm="Are you sure you need to delete ?"
                                                    wire:click.prevent="delete({{ $term->id }})"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $terms->links() }}
                </div>
            </div>
        </div>
    </div>
    <x-admin.modal title="terms" :isModalShow="$isModalShow" :isEditMode="$isEditMode">
        @if($isModalHeader)
            <div class="col-xl-12 col-lg-12">
                <x-admin.textarea title="header_en" error="header_en" wire:model="state.header_en" />
            </div>
            <div class="col-xl-12 col-lg-12">
                <x-admin.textarea title="header_ar" error="header_ar" wire:model="state.header_ar" />
            </div>
            <x-slot name="buttons">
                <x-admin.button class="btn-sm btn-outline-dark btn-block" wire:click.prevent="storeHeader">@lang('app.update')
                </x-admin.button>
            </x-slot>
        @else
            <div class="col-xl-12 col-lg-12">
                <x-admin.input title="title_en" error="title_en" wire:model="state.title_en" />
            </div>
            <div class="col-xl-12 col-lg-12">
                <x-admin.input title="title_ar" error="title_ar" wire:model="state.title_ar" />
            </div>
            <div class="col-xl-12 col-lg-12">
                <x-admin.input title="sub_title_en" error="sub_title_en" wire:model="state.sub_title_en" />
            </div>
            <div class="col-xl-12 col-lg-12">
                <x-admin.input title="sub_title_ar" error="sub_title_ar" wire:model="state.sub_title_ar" />
            </div>
            <div class="col-xl-12 col-lg-12">
                <x-admin.textarea title="term_en" error="content_en" wire:model="state.content_en" />
            </div>
            <div class="col-xl-12 col-lg-12">
                <x-admin.textarea title="term_ar" error="content_ar" wire:model="state.content_ar"  />
            </div>
{{--            <div class="add-terms-dev">--}}
{{--                @if($isEditMode)--}}
{{--                    @foreach($this->state['content_en'] as $key => $data)--}}
{{--                        {{dd($this->state['content_en'])}}--}}
{{--                        <div class="child-{{$key}} add_terms_dev_child">--}}
{{--                            <div class="col-xl-12 col-lg-12">--}}
{{--                                <x-admin.textarea title="term_ar" error="content_en" wire:model="state.content_en.{{$key}}" />--}}
{{--                            </div>--}}
{{--                            <div class="col-xl-12 col-lg-12">--}}
{{--                                <x-admin.textarea title="term_en" error="content_ar" wire:model="state.content_ar.{{$key}}"  />--}}
{{--                            </div>--}}
{{--                            <x-admin.button wire:click.prevent="remove({{ $key }})" wire:confirm="Are you sure you need to delete ?"><i onclick="deleteTerms(this)"  class="fa fa-trash-can"></i></x-admin.button>--}}
{{--                        </div>--}}
{{--                    @endforeach--}}
{{--                @else--}}
{{--                    <div class="child-1">--}}
{{--                        <div class="col-xl-12 col-lg-12">--}}
{{--                            <x-admin.textarea title="term_ar" error="content_en" wire:model="state.content_en.1" />--}}
{{--                        </div>--}}
{{--                        <div class="col-xl-12 col-lg-12">--}}
{{--                            <x-admin.textarea title="term_en" error="content_ar" wire:model="state.content_ar.1"  />--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--            </div>--}}
{{--            <div class="">--}}
{{--                <x-admin.button class="btn-sm btn-outline-dark btn-block add-more" onclick="addTerms(this)">--}}
{{--                    @lang('app.add_terms')--}}
{{--                </x-admin.button>--}}
{{--            </div>--}}
            <x-slot name="buttons">
                @if ($isEditMode)
                    <x-admin.button class="btn-sm btn-outline-dark btn-block" wire:click.prevent="update({{ $editId }})">
                        @lang('app.update')
                    </x-admin.button>
                @else
                    <x-admin.button class="btn-sm btn-outline-dark btn-block" wire:click.prevent="store">@lang('app.submit')
                    </x-admin.button>
                @endif
            </x-slot>
        @endif
    </x-admin.modal>

    @push('js')
        <script>
            $('.add-more').click(function (){

            })

            function deleteTerms(element) {
                var parentDiv = element.parentNode;
                while (!parentDiv.classList.contains('add_terms_dev_child')) {
                    parentDiv = parentDiv.parentNode;
                    if (!parentDiv) return;
                }
                if (confirm('Are you sure?')) {
                    parentDiv.remove();
                }
            }
            function addTerms(element) {
                var num = $('.add-terms-dev').children().length+1;
                $('.add-terms-dev').append(
                    `
                <div class="child-${num} add_terms_dev_child">
                            <div class="col-xl-12 col-lg-12">
                                <x-admin.textarea title="term_ar" error="content_en" wire:model="state.content_en.${num}" />
                            </div>
                            <div class="col-xl-12 col-lg-12">
                                <x-admin.textarea title="term_en" error="content_ar" wire:model="state.content_ar.${num}"  />
                            </div>
                            <span class="delete_terms"  data-class="child-1"><i onclick="deleteTerms(this)" class="fa fa-trash-can"></i></span>
                        </div>
                `);
            }


        </script>
    @endpush

</div>
