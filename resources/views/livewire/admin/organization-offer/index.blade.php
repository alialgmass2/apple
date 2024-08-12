<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.organization-offer')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.organization-offer')</a></li>
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
                        <x-admin.select class="w-100" title="Organization" error="organization_id"
                                        wire:model.live="organization_id">
                            <option value="">All Organizations</option>
                            @forelse ($organizations as $organization)
                                <option value="{{ $organization->id }}">
                                    {{ $organization->translate('name') }}
                                </option>
                            @empty
                            @endforelse
                        </x-admin.select>
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
                                    <th><strong>@lang('app.organization')</strong></th>
                                    <th><strong>@lang('app.offer')</strong></th>
                                    <th><strong>@lang('app.actions')</strong></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($organizationOffer as $key => $offer)

                                <tr>
                                    <td><strong>{{ ++$key }}</strong></td>
                                    <td>{{ $offer->organization?->translate('name') }}</td>
                                    <td>{{ $offer->offer?->translate('title') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="{{route('admin.organization-offer.show',$offer->id)}}" class="btn btn-xs sharp text-warning fz-16px"><i class="fa fa-eye"
                                                wire:loading.class="disabled"></i></a>
                                             <a href="#" class="btn btn-xs sharp me-1 text-primary fz-16px"
                                                wire:loading.class="disabled"
                                                wire:click.prevent="showModalEdit({{ $offer->id }})"><i
                                                    class="fa-regular fa-pen-to-square"></i>
                                             </a>
                                            <a href="#" class="btn btn-xs sharp me-1 text-primary fz-16px"
                                               wire:loading.class="disabled"
                                               wire:click.prevent="showModalProduct({{ $offer->id }},{{$offer->organization?->id}})"><i class="fa-solid fa-cart-plus"></i>
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
                    {{ $organizationOffer->links() }}
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL START --}}
    <x-admin.modal title="order" :isModalShow="$isModalShow" :isEditMode="$isEditMode" :isModelProduct="$isModelProduct">
        @if ($isModelProduct)

            <div class="col-xl-12 col-lg-12">
                <x-admin.select title="Category" error="category_id" wire:model.live="state.category_id">
                    <option value="">Category</option>
                    @forelse ($categories as $category)
                        <option value="{{ $category->id }}">
                            {{ $category->translate('name') }}
                        </option>
                    @empty
                    @endforelse
                </x-admin.select>
            </div>
            <div class="col-xl-12 col-lg-12">
                <x-admin.multi-select title="Product" name="product_id" error="product_id"
                                wire:model="state.product_id">
                    <option value="">Sub Category</option>
                    @forelse ($products as $product)
                        <option value="{{ $product->id }}">
                            {{ $product->translate('title') }}
                        </option>
                    @empty

                    @endforelse
                </x-admin.multi-select>
            </div>
        @else
            <div class="col-xl-12 col-lg-12">
                <x-admin.select class="w-100" title="Organization" error="organization_id" wire:model="state.organization_id">
                    <option value="">All Organizations</option>
                    @forelse ($organizations as $organization)
                        <option value="{{ $organization->id }}">
                            {{ $organization->translate('name') }}
                        </option>
                    @empty
                    @endforelse
                </x-admin.select>
            </div>
            <div class="col-xl-12 col-lg-12">
                <x-admin.select class="w-100" title="Offer" error="organization_id"  wire:model="state.offer_id">
                    <option value="">All Offer</option>
                    @forelse ($offers as $offer)
                        <option value="{{ $offer->id }}">
                            {{ $offer->translate('title') }}
                        </option>
                    @empty
                    @endforelse
                </x-admin.select>
            </div>
        @endif
        <x-slot name="buttons">
            @if ($isEditMode)
            <x-admin.button-submit title="submit" wire:click.prevent="update({{ $editId }})" />
            @elseif($isModelProduct)
                <x-admin.button-submit title="submit" wire:click.prevent="assignProduct({{ $editId }})" />
            @else
            <x-admin.button-submit title="submit" wire:click.prevent="store" />
            @endif
        </x-slot>
    </x-admin.modal>

</div>
