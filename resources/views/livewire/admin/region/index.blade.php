<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.regions')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.regions')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header  justify-content-end">
                    <h4 class="card-title">
                        <x-admin.button-create title="region" wire:click="showModal" />
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                                <tr>
                                    <th><strong>@lang('app.id')</strong></th>
                                    <th><strong>@lang('app.name')</strong></th>
                                    <th><strong>@lang('app.actions')</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($regions as $region)
                                <tr>
                                    <td><strong>{{ $region->id }}</strong></td>
                                    <td>{{ $region->translate('name') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <x-admin.action type="edit"
                                                wire:click.prevent="showModalEdit({{ $region->id }})" />

                                            <x-admin.action type="delete"
                                                wire:confirm="{{ __('app.delete_confirmation') }}"
                                                wire:click.prevent="delete({{ $region->id }})" />
                                        </div>
                                    </td>
                                </tr>

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $regions->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL START --}}
    <x-admin.modal title="region" :isModalShow="$isModalShow" :isEditMode="$isEditMode">
        <div class="col-xl-12 col-lg-12">
            <x-admin.input title="name_en" error="name_en" wire:model="state.name_en" />
        </div>
        <div class="col-xl-12 col-lg-12">
            <x-admin.input title="name_ar" error="name_ar" wire:model="state.name_ar" />
        </div>
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
    </x-admin.modal>
    {{-- MODAL END --}}
    {{-- MODAL START --}}
    {{-- <div class="modal fade show {{ $isModalShow ? 'modal-bg d-block' : '' }}" id="exampleModalCenter">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header d-flex justify-content-start position-relative">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click.prevent="closeModal">
                    </button>
                </div>
                <div class="modal-body">
                    <div class="col-xl-12 col-lg-12">
                        @if ($isEditMode)
                        <h5 class="text-center mb-4">Edit Region</h5>
                        @else
                        <h5 class="text-center mb-4">Add New Region</h5>
                        @endif
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <x-admin.input title="name_en" error="name_en" wire:model="state.name_en" />
                    </div>
                    <div class="col-xl-12 col-lg-12">
                        <x-admin.input title="name_ar" error="name_ar" wire:model="state.name_ar" />
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
    </div> --}}
    {{-- MODAL END --}}
    @push('js')

    
    @endpush
</div>
