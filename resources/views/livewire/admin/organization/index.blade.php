<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.organizations')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.organizations')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header  justify-content-end">
                    <h4 class="card-title">
                        <x-admin.button-create title="organization" wire:click="showModal" />
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th><strong>@lang('app.id')</strong></th>
                                    <th><strong>@lang('app.logo')</strong></th>
                                    <th><strong>@lang('app.name')</strong></th>
                                    <th><strong>@lang('app.domian')</strong></th>
                                    <th><strong>@lang('app.education_level')</strong></th>
                                    <th><strong>@lang('app.region')</strong></th>
                                    <th><strong>@lang('app.city')</strong></th>
                                    <th><strong>Action</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($organizations as $organization)

                                <tr>
                                    <td><strong>{{ $organization->id }}</strong></td>
                                    <td><img class="file-preview" src="{{ $organization->getFile('logo_login') ?? config('app.url') .'images/catDefult.png' }}" alt="" /></td>
                                    <td>{{ $organization->translate('name') }}</td>
                                    <td>{{ $organization->domain }}</td>
                                    <td>{{ $organization->educationLevel->translate('name') }}</td>
                                    <td>{{ $organization->region->translate('name') }}</td>
                                    <td>{{ $organization->city->translate('name') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{ route('admin.organization.show',[$organization->id]) }}"
                                                class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                    wire:loading.class="disabled"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs sharp mx-1 text-primary fz-16px"
                                                wire:loading.class="disabled"
                                                wire:click.prevent="showModalEdit({{ $organization->id }})"><i
                                                    class="fa-regular fa-pen-to-square"></i>
                                            </a>
                                            <a href="{{route('admin.organization.discount',$organization->id)}}" class="btn btn-xs sharp mx-1 text-primary fz-16px">
                                                <i class="fa-solid fa-tags"></i>
                                            </a>
                                            <a href="#" class="btn btn-xs sharp text-danger fz-16px"><i
                                                    class="fa fa-trash-can" wire:loading.class="disabled"
                                                    wire:confirm="Are you sure you need to delete ?"
                                                    wire:click.prevent="delete({{ $organization->id }})"></i>
                                            </a>

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
                            <h5 class="text-center mb-4">Edit Organization</h5>
                            @else
                            <h5 class="text-center mb-4">Add New Organization</h5>
                            @endif
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.select title="Region" error="region_id" wire:model.live="state.region_id">
                                <option value="">Region</option>
                                @forelse ($regions as $region)
                                <option value="{{ $region->id }}">{{ $region->translate('name') }}</option>
                                @empty
                                @endforelse
                            </x-admin.select>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.select title="City" error="city_id" wire:model="state.city_id">
                                <option value="">City</option>
                                @forelse ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->translate('name') }}</option>
                                @empty
                                @endforelse
                            </x-admin.select>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.select title="Education Level" error="education_level_id"
                                wire:model="state.education_level_id">
                                <option value="">Education Level</option>
                                @forelse ($educationLevels as $educationLevel)
                                <option value="{{ $educationLevel->id }}">{{ $educationLevel->translate('name') }}
                                </option>
                                @empty
                                @endforelse
                            </x-admin.select>
                        </div>
                        {{-- <div class="col-xl-6 col-lg-6">
                            <x-admin.input title="email" error="email" wire:model="state.email" />
                        </div> --}}
                        {{-- @if (!$isEditMode)
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.input type="password" title="password" error="password"
                                wire:model="state.password" />
                        </div>
                        @endif --}}
                        <div class="col-xl-6 col-lg-6">
                            <div>
                                @if(count($shipment_cities) > 0)
                                    <x-admin.select title="shipment_city" error="shipment_city"
                                                    wire:model="state.shipment_city">
                                        <option>choose shipment city</option>
                                        @forelse($shipment_cities as $shipment_city)
                                            <option value="{{ $shipment_city }}">{{ $shipment_city }}
                                            </option>
                                        @empty
                                            <option>No results found</option>
                                        @endforelse
                                    </x-admin.select>
                                @endif
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.input title="name_ar" error="name_ar" wire:model="state.name_ar" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <x-admin.input title="domain" error="domain" wire:model="state.domain" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <label for="">Discount</label>
                            <x-admin.input title="discount" error="discount" wire:model="state.discount" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <label for="">Delivery price</label>
                            <x-admin.input title="delivery_price" error="delivery_price" wire:model="state.delivery_price" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <label for="">Max order number</label>
                            <x-admin.input title="max_order_number" error="max_order_number" wire:model="state.max_order_number" />
                        </div>
                        <div class="col-xl-6 col-lg-6">
                            <label for="">Address</label>
                            <x-admin.input title="address" error="address" wire:model="state.address" />
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

                        <div class="col-12 col-xl-12 col-lg-12">
                            <div class="row">
                                <div class="col-xl-9 col-lg-9">
                                    <label for="">Logo</label>
                                    <x-admin.input type="file" title="image" error="image"
                                        wire:model.live="state.image" />
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
                                    <label for="">Dashboard Banner</label>
                                    <x-admin.input type="file" title="banner_dashboard" error="banner_dashboard"
                                        wire:model.live="state.banner_dashboard" />
                                </div>
                                <div class="col-xl-3 col-lg-3 preview-container pt-1-7rem">
                                    <div wire:loading wire:target="state.banner_dashboard">
                                        <progress max="100" value="90"></progress>
                                    </div>
                                    @if (toExists('banner_dashboard',$state))
                                    {!! handleStateFile($state['banner_dashboard']) !!}
                                    @else
                                    {!! handlePreviewFile($oldBannerDashboard) !!}
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="col-12 col-xl-12 col-lg-12">
                            <div class="row">
                                <div class="col-xl-9 col-lg-9">
                                    <label for="">Logo Login</label>
                                    <x-admin.input type="file" title="logo_login" error="logo_login"
                                        wire:model.live="state.logo_login" />
                                </div>
                                <div class="col-xl-3 col-lg-3 preview-container pt-1-7rem">
                                    <div wire:loading wire:target="state.logo_login">
                                        <progress max="100" value="90"></progress>
                                    </div>
                                    @if (toExists('logo_login',$state))
                                    {!! handleStateFile($state['logo_login']) !!}
                                    @else
                                    {!! handlePreviewFile($oldLogoLogin) !!}
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
