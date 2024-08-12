<div>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.categories')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header  justify-content-end">
                    
                    <h4 class="card-title">
                        <button class="btn btn-sm btn-outline-dark" wire:click="showModal">
                            Add Category &nbsp;
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
                                <th><strong>Name</strong></th>
                                <th><strong>Action</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($categories as $category)

                                <tr>
                                    <td><strong>{{ $category->id }}</strong></td>
                                    <td>{{ $category->translate('name') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="#" class="btn btn-xs sharp me-1 text-primary fz-16px"
                                               wire:loading.class="disabled"
                                               wire:click.prevent="showModalEdit({{ $category->id }})"><i
                                                        class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="#" class="btn btn-xs sharp text-danger fz-16px"><i
                                                        class="fa fa-trash-can" wire:loading.class="disabled"
                                                        wire:confirm="Are you sure you need to delete ?"
                                                        wire:click.prevent="delete({{ $category->id }})"></i></a>
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
    <div class="modal fade show {{ $isModalShow ? 'modal-bg d-block' : '' }}" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-start position-relative">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click.prevent="closeModal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-lg-12">
                        @if ($isEditMode)
                            <h5 class="text-center mb-4">Edit Category</h5>
                        @else
                            <h5 class="text-center mb-4">Add New Category</h5>
                        @endif
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <x-admin.input title="name_en" error="name_en" wire:model="state.name_en" />
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <x-admin.input title="name_ar" error="name_ar" wire:model="state.name_ar" />
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <x-admin.input title="image" type="file" error="image" wire:model="state.image" name='image' value=""/>
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
