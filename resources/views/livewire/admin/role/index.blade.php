<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.role')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.role')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header  justify-content-end">
                   
                    <h4 class="card-title">
                        <x-admin.button-create title="role" wire:click="showModal" />
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th><strong>@lang('app.id')</strong></th>
                                    <th><strong>@lang('app.name')</strong></th>
                                    <th><strong>@lang('app.actions')</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($roles as $role)

                                <tr>
                                    <td><strong>{{ $role->id }}</strong></td>
                                    <td>{{ $role->translate('name') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="#" class="btn btn-xs sharp me-1 text-primary fz-16px"
                                                wire:loading.class="disabled"
                                                wire:click.prevent="showModalEdit({{ $role->id }})"><i
                                                    class="fa-regular fa-pen-to-square"></i></a>
                                            <a href="#" class="btn btn-xs sharp text-danger fz-16px"><i
                                                    class="fa fa-trash-can" wire:loading.class="disabled"
                                                    wire:confirm="Are you sure you need to delete ?"
                                                    wire:click.prevent="delete({{ $role->id }})"></i></a>
                                        </div>
                                    </td>
                                </tr>

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $roles->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL START --}}
    <x-admin.modal title="role" :isModalShow="$isModalShow" :isEditMode="$isEditMode">

        <div class="col-xl-12 col-lg-12">
            <x-admin.input title="name_en" error="name_en" wire:model="state.name_en" />
        </div>
        <div class="col-xl-12 col-lg-12">
            <x-admin.input title="name_ar" error="name_ar" wire:model="state.name_ar" />
        </div>
        <x-slot name="buttons">
            @if ($isEditMode)
            <x-admin.button-submit title="submit" wire:click.prevent="update({{ $editId }})" />
            @else
            <x-admin.button-submit title="submit" wire:click.prevent="store" />
            @endif
        </x-slot>
    </x-admin.modal>
    {{-- MODAL END --}}


</div>
