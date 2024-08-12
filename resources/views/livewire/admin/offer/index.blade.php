<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.offer')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.offer')</a></li>
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
                         <x-admin.button-create title="offer" wire:click="showModal" />
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>@lang('app.id')</strong></th>
                                    <th><strong>@lang('app.title')</strong></th>
                                    <th><strong>@lang('app.brief')</strong></th>
                                    <th><strong>@lang('app.discription')</strong></th>
                                    <th><strong>@lang('app.start_date')</strong></th>
                                    <th><strong>@lang('app.end_date')</strong></th>
                                    <th><strong>@lang('app.percent')</strong></th>
                                    <th><strong>@lang('app.actions')</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($offers as $key => $offer)

                                <tr>
                                    <td><strong>{{ ++$key }}</strong></td>
                                    <td>{{ $offer->translate('title') }}</td>
                                    <td>{{ $offer->translate('brief') }}</td>
                                    <td>{{ $offer->translate('discription') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($offer->start_date)->format('Y-m-d') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($offer->end_date)->format('Y-m-d') }}</td>
                                    <td>{{ $offer->percent }} %</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                           {{-- <a href="{{ route('admin.organization-offer.show',[$offer->id]) }}" class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                    wire:loading.class="disabled"></i>
                                            </a>--}}
                                             <a href="#" class="btn btn-xs sharp me-1 text-primary fz-16px"
                                                wire:loading.class="disabled"
                                                wire:click.prevent="showModalEdit({{ $offer->id }})"><i
                                                    class="fa-regular fa-pen-to-square"></i>
                                             </a>
                                             <a href="#" class="btn btn-xs sharp text-danger fz-16px"><i
                                                    class="fa fa-trash-can" wire:loading.class="disabled"
                                                    wire:confirm="Are you sure you need to delete ?"
                                                    wire:click.prevent="delete({{ $offer->id }})"></i>
                                             </a>
                                        </div>
                                    </td>
                                </tr>

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $offers->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL START --}}
    <x-admin.modal title="order" :isModalShow="$isModalShow" :isEditMode="$isEditMode">

        <div class="col-xl-12 col-lg-12">
            <x-admin.input title="title_en" error="title_en" wire:model="state.title_en" />
        </div>
        <div class="col-xl-12 col-lg-12">
            <x-admin.input title="title_ar" error="title_ar" wire:model="state.title_ar" />
        </div>
        <div class="col-xl-12 col-lg-12">
            <x-admin.textarea title="brief_en" error="brief_en" wire:model="state.brief_en" />
        </div>
        <div class="col-xl-12 col-lg-12">
            <x-admin.textarea title="brief_ar" error="brief_ar" wire:model="state.brief_ar" />
        </div>
        <div class="col-xl-12 col-lg-12">
            <x-admin.textarea title="discription_en" error="discription_en" wire:model="state.discription_en" />
        </div>
        <div class="col-xl-12 col-lg-12">
            <x-admin.textarea title="discription_ar" error="discription_ar" wire:model="state.discription_ar" />
        </div>

        <div class="col-xl-12 col-lg-12">
            <x-admin.input type="number" title="percent" error="percent" wire:model="state.percent" />
        </div>
{{--        <div class="col-xl-12 col-lg-12">--}}
{{--            <label class="text-label form-label">Are Time Unlimited</label>--}}
{{--            <x-admin.input type="checkbox" title="Limited Time" error="limit_time" wire:model="state.limit_time" />--}}
{{--        </div>--}}
        <div class="dates">
            <div class="col-xl-12 col-lg-12">
                <x-admin.input type="date" title="start_date" error="start_date" wire:model="state.start_date" />
            </div>
            <div class="col-xl-12 col-lg-12">
                <x-admin.input type="date" title="end_date" error="end_date" wire:model="state.end_date" />
            </div>
        </div>
        <div class="col-xl-12 col-lg-12">
            <x-admin.select title="Status" error="status" wire:model="state.status">
                <option value="1">Active</option>
                <option value="0">InActive</option>
            </x-admin.select>
        </div>
{{--        <div class="col-12 col-xl-12 col-lg-12">--}}
{{--            <div class="row">--}}
{{--                <div class="col-xl-9 col-lg-9">--}}
{{--                    <label for="">Banner</label>--}}
{{--                    <x-admin.input type="file" title="banner" error="banner"--}}
{{--                                   wire:model.live="state.banner" multiple />--}}
{{--                </div>--}}
{{--                <div class="col-xl-3 col-lg-3 preview-container pt-1-7rem">--}}
{{--                    <div wire:loading wire:target="state.banner">--}}
{{--                        <progress max="100" value="90"></progress>--}}
{{--                    </div>--}}
{{--                    @if (toExists('banner',$state))--}}
{{--                        {!! handleStateFile($state['banner']) !!}--}}
{{--                    @else--}}
{{--                        <img src="{{$oldImage}}" class="image-preview" alt=""  />--}}
{{--                    @endif--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
        <div class="col-12 col-xl-12 col-lg-12">
            <div class="row">
                <div class="col-xl-9 col-lg-9">
                    <label for="">Banner</label>
                    <x-admin.input type="file" title="banner" error="banner"
                                   wire:model.live="state.banner"/>
                </div>
                <div class="col-xl-3 col-lg-3 preview-container pt-1-7rem">
                    <div wire:loading wire:target="state.banner">
                        <progress max="100" value="90"></progress>
                    </div>
                    @if (toExists('banner',$state))
                        {!! handleStateFile($state['banner']) !!}
                    @elseif($oldImage != null)
                        <img src="{{$oldImage}}" class="image-preview" alt="" />
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-12 col-lg-12">
            <div class="row">
                <div class="col-xl-9 col-lg-9">
                    <label for="">Cover</label>
                    <x-admin.input type="file" title="image" error="image"
                                   wire:model.live="state.image"/>
                </div>
                <div class="col-xl-3 col-lg-3 preview-container pt-1-7rem">
                    <div wire:loading wire:target="state.image">
                        <progress max="100" value="90"></progress>
                    </div>
                    @if (toExists('image',$state))
                        {!! handleStateFile($state['image']) !!}
                    @elseif($oldCover != null)
                        <img src="{{$oldCover}}" class="image-preview" alt="" />
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-12 col-lg-12">
            <div class="row">
                <div class="col-xl-12 col-lg-9">
                    <label for="">Multi Banner</label>
                    <x-admin.input type="file" title="multi_banner" error="multi_banner"
                                   wire:model.live="state.multi_banner" multiple/>
                </div>
                <div class="col-xl-12 col-lg-12 preview-container mb-3">
                    <div wire:loading wire:target="state.multi_banner">
                        <progress max="100" value="90"></progress>
                    </div>
                    @if (toExists('multi_banner',$state))
                        @foreach($state['multi_banner'] as $img)
                            {!! handleStateFile($img) !!}
                        @endforeach
                    @elseif($oldMultiImage != null)
{{--                        @dd($oldMultiImage)--}}
                        @foreach($oldMultiImage as $img)
                            <img src="{{$img}}" class="image-preview" alt="" />
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
        <x-slot name="buttons">
            @if ($isEditMode)
            <x-admin.button-submit title="submit" wire:click.prevent="update({{ $editId }})" />
            @else
            <x-admin.button-submit title="submit" wire:click.prevent="store" />
            @endif
        </x-slot>
    </x-admin.modal>

</div>
