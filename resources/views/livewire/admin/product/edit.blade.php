<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">@lang('app.products')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.edit')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-xl-6 col-lg-6">
            <x-admin.select title="Category" error="category_id" wire:model.live="state.category_id">
                <option value="">Category</option>
                @forelse ($categories as $category)
                    <option {{$state['category_id'] == $category->id ? 'selected' : ''}} value="{{ $category->id }}">
                        {{ $category->translate('name') }}
                    </option>
                @empty @endforelse
            </x-admin.select>
        </div>
        <div class="col-xl-6 col-lg-6">
            <x-admin.select title="Sub Category" error="sub_category_id"
                            wire:model="state.sub_category_id">
                <option value="">Sub Category</option>
                @forelse ($subCategories as $subCategory)
                    <option {{$state['sub_category_id'] == $subCategory->id ? 'selected' : ''}} value="{{ $subCategory->id }}">
                        {{ $subCategory->translate('name') }}
                    </option>
                @empty @endforelse
            </x-admin.select>
        </div>
        <div class="col-xl-6 col-lg-6">
            <x-admin.input title="title_en" error="title_en" wire:model="state.title_en"/>
        </div>
        <div class="col-xl-6 col-lg-6">
            <x-admin.input title="title_ar" error="title_ar" wire:model="state.title_ar"/>
        </div>

        <div class="col-xl-6 col-lg-6">
            <x-admin.input title="sub_title_en" error="sub_title_en" wire:model="state.sub_title_en"/>
        </div>
        <div class="col-xl-6 col-lg-6">
            <x-admin.input title="sub_title_ar" error="sub_title_ar" wire:model="state.sub_title_ar"/>
        </div>

        <div class="col-xl-6 col-lg-6">
            <x-admin.textarea title="legal_en" error="legal_en" wire:model="state.legal_en"/>
        </div>
        <div class="col-xl-6 col-lg-6">
            <x-admin.textarea title="legal_ar" error="legal_ar" wire:model="state.legal_ar"/>
        </div>

        <div class="col-xl-6 col-lg-6">
            <x-admin.textarea title="technical_specifications_en" error="technical_specifications_en"
                              wire:model="state.technical_specifications_en"/>
        </div>
        <div class="col-xl-6 col-lg-6">
            <x-admin.textarea title="technical_specifications_ar" error="technical_specifications_ar"
                              wire:model="state.technical_specifications_ar"/>
        </div>

        <div class="col-xl-6 col-lg-6">
            <x-admin.textarea title="specifications_en" error="specifications_en"
                              wire:model="state.specifications_en"/>
        </div>
        <div class="col-xl-6 col-lg-6">
            <x-admin.textarea title="specifications_ar" error="specifications_ar"
                              wire:model="state.specifications_ar"/>
        </div>

        <div class="col-xl-6 col-lg-6">
            <x-admin.textarea title="description_en" error="description_en"
                              wire:model="state.description_en"/>
        </div>

        <div class="col-xl-6 col-lg-6">
            <x-admin.textarea title="description_ar" error="description_ar"
                              wire:model="state.description_ar"/>
        </div>

        <div class="col-xl-6 col-lg-6">
            <x-admin.textarea title="features_en" error="features_en" wire:model="state.features_en"/>
        </div>

        <div class="col-xl-6 col-lg-6">
            <x-admin.textarea title="features_ar" error="features_ar" wire:model="state.features_ar"/>
        </div>

        <div class="col-xl-6 col-lg-6">
            <x-admin.input title="price" error="price" wire:model="state.price"/>
        </div>

        <div class="col-12 col-xl-12 col-lg-12">
            <div class="row">
                <div class="col-xl-9 col-lg-9">
                    <label for="">Image</label>
                    <x-admin.input type="file" title="image" error="image"
                                   wire:model.live="state.image"/>
                </div>
                <div class="col-xl-3 col-lg-3 preview-container pt-1-7rem">
                    <div wire:loading wire:target="state.image">
                        <progress max="100" value="90"></progress>
                    </div>
                    @if (toExists('image',$state))
                        {!!
                                                       handleStateFile($state['image']) !!}
                    @else
                        {!!
                                                       handlePreviewFile($oldImage) !!}
                    @endif
                </div>
            </div>
        </div>

        <div class="col-12 col-xl-12 col-lg-12">
            <div class="row">
                <div class="col-xl-12 col-lg-9">
                    <label for="">Images</label>
                    <x-admin.input type="file" title="images" error="images"
                                   wire:model.live="state.images" multiple/>
                </div>
                <div class="col-xl-12 col-lg-12 preview-container mb-3">
                    <div wire:loading wire:target="state.image">
                        <progress max="100" value="90"></progress>
                    </div>
                    @if (toExists('images',$state))
                        @foreach($state['images'] as $img)
                            {!! handleStateFile($img) !!}
                        @endforeach
                    @else
                        @foreach ($oldImages as $img)
                            {!! handlePreviewFile(route('admin.uploads',[$img->url])) !!}
                        @endforeach
                    @endif
                </div>
            </div>
        </div>

        <label style="color: #0c0c0c;font-weight: bold ; font-size: large">Optional</label>

        <div class="col-xl-6 col-lg-6">
            <x-admin.input title="video_en" error="video_en" wire:model="state.video_en"/>
        </div>
        <div class="col-xl-6 col-lg-6">
            <x-admin.input title="video_ar" error="video_ar" wire:model="state.video_ar"/>
        </div>

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
                        {!!
                                                       handleStateFile($state['banner']) !!}
                    @else
                        {!!
                                                       handlePreviewFile($oldBanner) !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-12 col-lg-12">
            <div class="row">
                <div class="col-xl-9 col-lg-9">
                    <label for="">Pdf</label>
                    <x-admin.input type="file" title="pdf" error="pdf" wire:model.live="state.pdf"/>
                </div>
                <div class="col-xl-3 col-lg-3 preview-container pt-1-7rem">
                    <div wire:loading wire:target="state.pdf">
                        <progress max="100" value="90"></progress>
                    </div>
                    @if (toExists('pdf',$state))
                        {!!
                                                       handleStateFile($state['pdf']) !!}
                    @else
                        {!!
                                                       handlePreviewFile($oldPdf) !!}
                    @endif
                </div>
            </div>
        </div>
        <div class="col-12 col-xl-12 col-lg-12">
            <div class="m-auto col-12 col-md-4">
                <x-admin.button class="btn-sm btn-outline-dark btn-block"
                    wire:click.prevent="update({{ $editId }})">Update
                </x-admin.button>
            </div>
        </div>
    </div>
</div>

