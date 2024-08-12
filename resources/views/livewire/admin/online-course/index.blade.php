<div>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.onlinecourses')</a></li>
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

                    </h4>
                    <h4 class="card-title">
                        <button class="btn btn-sm btn-outline-dark" wire:click="showModal">
                            Add Every One Code &nbsp;
                            <i class="fa-solid fa-plus"></i>
                        </button>
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
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($onlineCourses as $onlineCourse)

                                <tr>
                                    <td>
                                        <strong>{{ $onlineCourse->id }}</strong>
                                    </td>
                                    <td>
                                        <img class="file-preview" src="{{ $onlineCourse->getFile() }}" alt="" />
                                    </td>
                                    <td>{{ $onlineCourse->translate('title') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('admin.onlinecourse.show',[$onlineCourse->id]) }}"
                                                class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                    wire:loading.class="disabled"></i></a>
                                            <a href="#" class="btn btn-xs sharp mx-1 text-primary fz-16px"
                                                wire:loading.class="disabled"
                                                wire:click.prevent="showModalEdit({{ $onlineCourse->id }})"><i
                                                    class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="#" class="btn btn-xs sharp text-danger fz-16px"><i
                                                    class="fa fa-trash-can" wire:loading.class="disabled"
                                                    wire:confirm="Are you sure you need to delete ?"
                                                    wire:click.prevent="delete({{ $onlineCourse->id }})"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                @empty @endforelse
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
                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                        wire:click.prevent="closeModal"></button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-xl-12 col-lg-12">
                            @if ($isEditMode)
                            <h5 class="text-center mb-4">Edit Every One Code</h5>
                            @else
                            <h5 class="text-center mb-4">Add New Every One Code</h5>
                            @endif
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="title_en" error="title_en" wire:model="state.title_en" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.textarea title="title_ar" error="title_ar" wire:model="state.title_ar" />
                        </div>

                        <div class="col-xl-6 col-lg-6">
                            <x-admin.input title="title_2_en" error="title_2_en" wire:model="state.title_2_en" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.input title="title_2_ar" error="title_2_ar" wire:model="state.title_2_ar" />
                        </div>

                        <div class="col-12 col-xl-12 col-lg-12">
                            <div class="row">
                                <div class="col-xl-9 col-lg-9">
                                    <label for="">Image</label>
                                    <x-admin.input type="file" title="image" error="image"
                                        wire:model.live="state.image" />
                                </div>
                                <div class="col-xl-3 col-lg-3 preview-container pt-1-7rem">
                                    <div wire:loading wire:target="state.image">
                                        <progress max="100" value="90"></progress>
                                    </div>
                                    @if (toExists('image',$state)) {!!
                                    handleStateFile($state['image']) !!} @else {!!
                                    handlePreviewFile($oldImage) !!} @endif
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
