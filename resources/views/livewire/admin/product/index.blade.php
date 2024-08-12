<div>
{{--    @if(request()->session()->get('0') == 'success')--}}
{{--        <div class="swal2-container swal2-center swal2-backdrop-show" style="overflow-y: auto;"><div aria-labelledby="swal2-title" aria-describedby="swal2-html-container" class="swal2-popup swal2-modal swal2-show" tabindex="-1" role="dialog" aria-live="assertive" aria-modal="true" style="display: grid;"><button type="button" onclick="Swal().close()" class="swal2-close" aria-label="Close this dialog" style="display: flex;">×</button><ul class="swal2-progress-steps" style="display: none;"></ul><div class="swal2-icon" style="display: none;"></div><img class="swal2-image" src="https://wjaar.tharawatdev.com/images/tick.png" alt=""><h2 class="swal2-title" id="swal2-title" style="display: none;"></h2><div class="swal2-html-container" id="swal2-html-container" style="display: block;">Data Saved</div><input id="swal2-input" class="swal2-input" style="display: none;"><input type="file" class="swal2-file" style="display: none;"><div class="swal2-range" style="display: none;"><input type="range"><output></output></div><select id="swal2-select" class="swal2-select" style="display: none;"></select><div class="swal2-radio" style="display: none;"></div><label class="swal2-checkbox" style="display: none;"><input type="checkbox" id="swal2-checkbox"><span class="swal2-label"></span></label><textarea id="swal2-textarea" class="swal2-textarea" style="display: none;"></textarea><div class="swal2-validation-message" id="swal2-validation-message" style="display: none;"></div><div class="swal2-actions" style="display: flex;"><div class="swal2-loader"></div><button type="button" class="swal2-confirm swal2-styled" aria-label="" style="display: inline-block;">Ok</button><button type="button" class="swal2-deny swal2-styled" aria-label="" style="display: none;">No</button><button type="button" class="swal2-cancel swal2-styled" aria-label="" style="display: none;">Cancel</button></div><div class="swal2-footer" style="display: none;"></div><div class="swal2-timer-progress-bar-container"><div class="swal2-timer-progress-bar" style="display: none;"></div></div></div></div>--}}
{{--    @endif--}}
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.products')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-flex justify-content-center">
                        {{-- <a href="#" class="btn btn-sm btn-outline-light">
                            <i class="fa-solid fa-arrow-left-long"></i> &nbsp;
                            Back
                        </a> --}}
                        <x-admin.select class="w-100" title="Category" error="category_id"
                                        wire:model.live="category_id">
                            <option value="">Category</option>
                            @forelse ($categories as $category)
                                <option value="{{ $category->id }}">
                                    {{ $category->translate('name') }}
                                </option>
                            @empty @endforelse
                        </x-admin.select>
                    </h4>
                    <h4 class="card-title">
                        <a class="btn btn-sm btn-outline-dark" href="{{ route('admin.product.create') }}">
                            Add product &nbsp;
                            <i class="fa-solid fa-plus"></i>
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                            <tr>
                                <th><strong>ID</strong></th>
                                <th><strong>Image</strong></th>
                                <th><strong>Title</strong></th>
                                <th><strong>Category</strong></th>
                                <th><strong>Sub Category</strong></th>
                                <th><strong>Action</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($products as $product)

                                <tr>
                                    <td>
                                        <strong>{{ $product->id }}</strong>
                                    </td>
                                    <td>
                                        <img loading="lazy" class="file-preview" src="{{ $product->getFile('default_img') }}" alt=""/>
                                    </td>
                                    <td>{{ $product->translate('title') }}</td>
                                    <td>
                                        {{ $product->category->translate('name') }}
                                    </td>
                                    <td>
                                        {{ $product->subCategory->translate('name')??'N/A' }}
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('admin.product.show',[$product->id]) }}"
                                               class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                                                                wire:loading.class="disabled"></i>
                                            </a>
                                            <a href="{{ route('admin.product.edit',[$product->id]) }}" class="btn btn-xs sharp mx-1 text-primary fz-16px">
                                            <i class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs sharp mx-1 text-primary fz-16px"
                                               wire:loading.class="disabled"
                                               wire:click.prevent="showModalEdit({{ $product->id }})"><i
                                                    class="fa-solid fa-brush"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs sharp mx-1 text-primary fz-16px"
                                               wire:loading.class="disabled"
                                               wire:click.prevent="showModalLinkEdit({{ $product->id }})">
                                                <i class="fas fa-link"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs sharp text-danger fz-16px"><i
                                                    class="fa fa-trash-can" wire:loading.class="disabled"
                                                    wire:confirm="Are you sure you need to delete ?"
                                                    wire:click.prevent="delete({{ $product->id }})"></i>
                                            </a>
                                        </div>
                                    </td>
                                </tr>

                            @empty @endforelse
                            </tbody>
                        </table>
                        {{ $products->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal modal-xl fade show {{ $isModalShow ? 'modal-bg d-block' : '' }}" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-start position-relative">
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                            wire:click.prevent="closeModal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            <h5 class="text-center mb-4">{{$isEditMode ? 'Edit Color' : 'Edit Link'}}</h5>
                        </div>
                        @if($isEditMode)
                            @foreach($state as $key => $oldImage)
                                @if(is_array($oldImage))
                                    <div class="col-12 col-xl-12 col-lg-12">
                                        <div class="row">
                                            <div class="col-xl-3 col-lg-3">
                                                <img width="100" height="90" src="{{route('website.uploads', $oldImage['url'])}}" />
                                            </div>
                                            {{--                                        <div class="col-xl-9 col-lg-9">--}}
                                            {{--                                            <x-admin.input type="text" title="color" error="color" wire:model="state.{{$oldImage['id']}}"/>--}}
                                            <div class="col-xl-9 col-lg-9">
                                                <x-admin.select title="Colors" error="color"
                                                                wire:model="state.{{$oldImage['id']}}">
                                                    <option value="">choose color</option>
                                                    @forelse ($colors as $color)
                                                        <option value="{{ $color->id }}">
                                                            {{ $color->color_name }}
                                                        </option>
                                                    @empty @endforelse
                                                </x-admin.select>
                                            </div>
                                            {{--                                        </div>--}}
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @else
                            <div class="row">
                                <div class="col-12 col-xl-12 col-lg-12">
                                    <label>{{__('app.specifications')}}</label>
                                    <x-admin.input title="specifications" error="specifications" wire:model="state.specifications"/>
                                </div>
                                <div class="col-12 col-xl-12 col-lg-12">
                                    <label>{{__('app.features')}}</label>
                                    <x-admin.input title="features" error="features" wire:model="state.features"/>
                                </div>
                                <div class="col-12 col-xl-12 col-lg-12">
                                    <label>{{__('app.legal')}}</label>
                                    <x-admin.input title="legal" error="legal" wire:model="state.legal"/>
                                </div>
                                <div class="col-12 col-xl-12 col-lg-12">
                                    <label>{{__('app.technical_specifications')}}</label>
                                    <x-admin.input title="technical_specifications" error="technical_specifications" wire:model="state.technical_specifications"/>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer justify-content-between border-0">
                    @if ($isEditMode)
                        <x-admin.button class="btn-sm btn-outline-dark btn-block"
                                        wire:click.prevent="saveImagesColor({{ $editId }})">Update
                        </x-admin.button>
                    @else
                        <x-admin.button class="btn-sm btn-outline-dark btn-block" wire:click.prevent="saveLinks({{ $editId }})">Update
                        </x-admin.button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@push('js')
    <script>

    </script>
@endpush
