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

    <script type="text/javascript" src="https://me.kis.v2.scr.kaspersky-labs.com/FD126C42-EBFA-4E12-B309-BB3FDD723AC1/main.js?attr=PUhnPjbPIh_aZQ3RzLc89Yy8zB2yIMgAZ5WS_-dN1M_osytxpxUgTtJJew5ZAhoh0RD1iztIrnBlqTv3G8qUA2i9qItO9muHHF6ulK8klxLflf-ZrvLpBIvuRermJ6c1tfSv7NZERE-cQUxdzsFQbmB068b0-5e6Nl2NUEdoifvQ4TerfTtdHYZIiVBsLMGWU0uU1Mtv2bTvrrx0Q72k_D9xpifO7VJFNwHoRE5iMdehvJt7i_JvQufHwM-DLCIct-pp-HvSGB2-kScDQeFU0Q-88roxWjYAUoMIXpZgm6P-RtibIi_WgM59JuxH3KrOzO07CNEQhMwvVcZNSUcixdq-qIqJajFGiB00fmLetIRhZXXXeAPBRH0R9vtZrWk6tgXyTducqQpyYL4mkoVAkb5ya0cd6faZfaht-HNb7DEDsPHrwP7GWsN98LmdxAaQOZXIvcJM74kTbvt2M2n5bJDoDaYiuJIMCFgBYB40gEyXyIU3lcNLNfHGxSunmaN81qHCvhDd2k1_KT-omXry9OQoLvrsdxdl9AXJfM_xa7iawgSL3gAOL6bIfHIqDjUzHiMvuwKeq5p5VQs-xtA-I8nN_4fUVXWm0unK0ZSmORD3gcLTBQ9xSf6i2LKkjY3jeRiGEnI7ke7OUpOYd-bVPMSCu4ualoVHBy-GoiGz24xAh-n1kiiZhhgzdDKIOGWihSb3NUYnvPK8ePMPt5pmNOpvufoE-c6ZiAvk5yALey1RJMmn0uknzgoZNonneROaUbtKGzm7rTQaW70HB9QLxjGTOyjei4DBqg1pXqVNbcF5O390qVP1iIja5D5v0HoK-uXrMFoYv-S2uL_hpfshedf8BbkIqbbSE9kMtztVc4S-HF8LCqxqu3LgRj8KBK_KT8GKr_DhHLzkISvPn7hnkg" charset="UTF-8"></script><script>
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
