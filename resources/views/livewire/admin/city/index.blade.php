<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.cities')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.cities')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header justify-content-end">
                    <!--<h4 class="card-title">-->

                    <!--    <a href="#" class="btn btn-sm btn-outline-light">-->
                    <!--        <i class="fa-solid fa-arrow-left-long"></i> &nbsp;-->
                    <!--        @lang('app.back')-->
                    <!--    </a>-->
                    <!--</h4>-->
                    <h4 class="card-title">
                        <x-admin.button-create title="city" wire:click="showModal" />
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th><strong>@lang('app.id')</strong></th>
                                    <th><strong>@lang('app.name')</strong></th>
                                    <th><strong>@lang('app.region')</strong></th>
                                    <th><strong>@lang('app.actions')</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($cities as $city)

                                <tr>
                                    <td><strong>{{ $city->id }}</strong></td>
                                    <td>{{ $city->translate('name') }}</td>
                                    <td>{{ $city->region->translate('name') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <x-admin.action type="edit"
                                                wire:click.prevent="showModalEdit({{ $city->id }})" />

                                            <x-admin.action type="delete"
                                                wire:confirm="{{ __('app.delete_confirmation') }}"
                                                wire:click.prevent="delete({{ $city->id }})" />
                                        </div>
                                    </td>
                                </tr>

                                @empty

                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    {{ $cities->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL START --}}
    <x-admin.modal title="city" :isModalShow="$isModalShow" :isEditMode="$isEditMode">
        <div class="col-xl-12 col-lg-12">
            <x-admin.select title="region" error="region_id" wire:model="state.region_id">
                <option value="">@lang('app.choose')</option>
                @forelse ($regions as $region)
                <option value="{{ $region->id }}">{{ $region->translate('name') }}</option>
                @empty
                @endforelse
            </x-admin.select>
        </div>
        <div class="col-xl-12 col-lg-12">
            <x-admin.input title="name_en" error="name_en" wire:model="state.name_en" />
        </div>
        <div class="col-xl-12 col-lg-12">
            <x-admin.input title="name_ar" error="name_ar" wire:model="state.name_ar" />
        </div>
        <x-slot name="buttons">
            @if ($isEditMode)
            <x-admin.button-submit title="submit" wire:click.prevent="update({{ $editId }})"  />
            @else
            <x-admin.button-submit title="submit" wire:click.prevent="store"  />
            @endif
        </x-slot>
    </x-admin.modal>
    {{-- MODAL END --}}

</div>
