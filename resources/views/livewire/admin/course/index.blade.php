<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.courses')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.courses')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header  justify-content-end"> 
                    <h4 class="card-title">
                        <x-admin.button-create title="course" wire:click="showModal" />
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th><strong>@lang('app.id')</strong></th>
                                    <th><strong>@lang('app.image')</strong></th>
                                    <th><strong>@lang('app.title')</strong></th>
                                    <th><strong>@lang('app.estimated_time')</strong></th>
                                    <th><strong>@lang('app.education_level')</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($courses as $course)

                                <tr>
                                    <td><strong>{{ $course->id }}</strong></td>
                                    <td><img class="file-preview" src="{{ $course->getFile() }}" alt="" /></td>
                                    <td>{{ $course->translate('title') }}</td>
                                    <td>{{ $course->estimated_time }}</td>
                                    <td>{{ $course->educationLevel->translate('name') != NULL ? $course->educationLevel->translate('name') : 'ALL ' }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('admin.course.show',[$course->id]) }}"
                                                class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                    wire:loading.class="disabled"></i></a>
                                            <a href="#" class="btn btn-xs sharp mx-1 text-primary fz-16px"
                                                wire:loading.class="disabled"
                                                wire:click.prevent="showModalEdit({{ $course->id }})"><i
                                                    class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="#" class="btn btn-xs sharp text-danger fz-16px"><i
                                                    class="fa fa-trash-can" wire:loading.class="disabled"
                                                    wire:confirm="Are you sure you need to delete ?"
                                                    wire:click.prevent="delete({{ $course->id }})"></i></a>

                                        </div>
                                    </td>
                                </tr>

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL START --}}
    <div class="modal modal-xl fade show {{ $isModalShow ? 'modal-bg d-block' : '' }}" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-start position-relative">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click.prevent="closeModal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            @if ($isEditMode)
                            <h5 class="text-center mb-4">Edit Course</h5>
                            @else
                            <h5 class="text-center mb-4">Add New Course</h5>
                            @endif
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.select title="Education Level" error="education_level_id"
                                wire:model="state.education_level_id">
                                <option value="">Education Level</option>
                                <option value="ALL">All</option>
                                @forelse ($educationLevels as $educationLevel)
                                <option value="{{ $educationLevel->id }}">{{ $educationLevel->translate('name') }}
                                </option>
                                @empty
                                @endforelse
                            </x-admin.select>
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <x-admin.input title="title_en" error="title_en" wire:model="state.title_en" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.input title="title_ar" error="title_ar" wire:model="state.title_ar" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.input type="number" title="estimated_time" error="estimated_time" wire:model="state.estimated_time" />
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="brief_en" error="brief_en" wire:model="state.brief_en" />
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="brief_ar" error="brief_ar" wire:model="state.brief_ar" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="what_will_learn_en" error="what_will_learn_en" wire:model="state.what_will_learn_en" />
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="what_will_learn_ar" error="what_will_learn_ar" wire:model="state.what_will_learn_ar" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="content_en" error="content_en" wire:model="state.content_en" />
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="content_ar" error="content_ar" wire:model="state.content_ar" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="requirements_en" error="requirements_en" wire:model="state.requirements_en" />
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="requirements_ar" error="requirements_ar" wire:model="state.requirements_ar" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="description_en" error="description_en" wire:model="state.description_en" />
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="description_ar" error="description_ar" wire:model="state.description_ar" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="about_en" error="about_en" wire:model="state.about_en" />
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="about_ar" error="about_ar" wire:model="state.about_ar" />
                        </div>

                        <div class="col-xl-12 col-lg-12">
                            <x-admin.input title="url" error="url" wire:model="state.url" />
                        </div>

                        <div class="col-12 col-xl-12 col-lg-12">
                            <div class="row">
                                <div class="col-xl-9 col-lg-9">
                                    <label for="">Image</label>
                                    <x-admin.input type="file" title="image" error="image" wire:model.live="state.image" />
                                </div>
                                <div class="col-xl-3 col-lg-3 preview-container pt-1-7rem">
                                    <div wire:loading wire:target="state.image">
                                        <progress max="100" value="90"></progress>
                                    </div>
                                    @if (toExists('image',$state))
                                    {!! handleStateFile($state['image']) !!}
                                    @else
                                    {!! handlePreviewFile($oldImage) !!}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-12 col-lg-12">
                            <div class="row">
                                <div class="col-xl-9 col-lg-9">
                                    <label for="">Banner</label>
                                    <x-admin.input type="file" title="banner" error="banner"
                                        wire:model.live="state.banner" />
                                </div>
                                <div class="col-xl-3 col-lg-3 preview-container pt-1-7rem">
                                    <div wire:loading wire:target="state.banner">
                                        <progress max="100" value="90"></progress>
                                    </div>
                                    @if (toExists('banner',$state))
                                    {!! handleStateFile($state['banner']) !!}
                                    @else
                                    {!! handlePreviewFile($oldBanner) !!}
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <div class="modal-footer justify-content-between border-0">
                    @if ($isEditMode)
                    <x-admin.button class="btn-sm btn-outline-dark btn-block"
                        wire:click.prevent="update({{ $editId }})">Update
                    </x-admin.button>
                    @else
                    <x-admin.button class="btn-sm btn-outline-dark btn-block" wire:click.prevent="store">Submit
                    </x-admin.button>
                    @endif

                </div>
            </div>
        </div>
    </div>
    {{-- MODAL END --}}
    @push('js')

    <script>
        document.addEventListener('livewire:initialized', () => {
                        @this.on('success', (event) => {
                            Swal.fire(
                            'Success',
                            "{!! __('app.data_deleted') !!}",
                            'success');
                        });
                    });
    </script>
    @endpush
</div>
