<div>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.how_to')</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <!--<div class="card-header">-->
                    <!--<h4 class="card-title">-->

                    <!--    <a href="#" class="btn btn-sm btn-outline-light">-->
                    <!--        <i class="fa-solid fa-arrow-left-long"></i> &nbsp;-->
                    <!--        Back-->
                    <!--    </a>-->
                    <!--</h4>-->
{{--                    <h4 class="card-title">--}}
{{--                        <button class="btn btn-sm btn-outline-dark" wire:click="showModal">--}}
{{--                            Add How To &nbsp;--}}
{{--                            <i class="fa-solid fa-plus"></i>--}}
{{--                        </button>--}}
{{--                    </h4>--}}
                <!--</div>-->
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md table-bordered">
                            <thead>
                                <tr>
                                    <th><strong>ID</strong></th>
                                    <th><strong>user type</strong></th>
                                    <th><strong>user Organization</strong></th>
                                    <th><strong>user Email</strong></th>
                                    <th><strong>Answer</strong></th>
                                </tr>
                            </thead>
                            <tbody> 
                                @forelse ($howToKnow as $howTo) 

                                <tr>
                                 {{--   <td><strong>{{ $howTo->id }}</strong></td> --}}
                                    <td><strong>{{ $loop->index +1}}</strong></td>
                                    <td>{{ $howTo->student->user_type }}</td>
                                    <td>{{ $howTo->student->organization()->first()?->name_en }}</td>
                                    <td>{{ $howTo->student->email }}</td>
                                    <td>{{ $howTo->answer }}</td>
                                </tr>

                                @empty
                                 <tr>
                                    <td colspan=5> no data found </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- MODAL START --}}
{{--    <div class="modal fade show {{ $isModalShow ? 'modal-bg d-block' : '' }}" id="exampleModalCenter">--}}
{{--        <div class="modal-dialog modal-dialog-centered" role="document">--}}
{{--            <div class="modal-content">--}}
{{--                <div class="modal-header d-flex justify-content-start position-relative">--}}
{{--                    <button type="button" class="btn-close" data-bs-dismiss="modal" wire:click.prevent="closeModal">--}}
{{--                    </button>--}}
{{--                </div>--}}
{{--                <div class="modal-body">--}}
{{--                    <div class="col-xl-12 col-lg-12">--}}
{{--                        @if ($isEditMode)--}}
{{--                        <h5 class="text-center mb-4">Edit How To</h5>--}}
{{--                        @else--}}
{{--                        <h5 class="text-center mb-4">Add New How To</h5>--}}
{{--                        @endif--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-12 col-lg-12">--}}
{{--                        <x-admin.select title="Product" error="product_id" wire:model="state.product_id">--}}
{{--                            <option value="">Product</option>--}}
{{--                            @forelse ($products as $product)--}}
{{--                            <option value="{{ $product->id }}">{{ $product->translate('title') }}</option>--}}
{{--                            @empty--}}
{{--                            @endforelse--}}
{{--                        </x-admin.select>--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-12 col-lg-12">--}}
{{--                        <x-admin.input title="title_en" error="title_en" wire:model="state.title_en" />--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-12 col-lg-12">--}}
{{--                        <x-admin.input title="title_ar" error="title_ar" wire:model="state.title_ar" />--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-12 col-lg-12">--}}
{{--                        <x-admin.textarea title="text_en" error="text_en" wire:model="state.text_en" />--}}
{{--                    </div>--}}
{{--                    <div class="col-xl-12 col-lg-12">--}}
{{--                        <x-admin.textarea title="text_ar" error="text_ar" wire:model="state.text_ar" />--}}
{{--                    </div>--}}
{{--                </div>--}}
{{--                <div class="modal-footer justify-content-between border-0">--}}
{{--                    @if ($isEditMode)--}}
{{--                    <x-admin.button class="btn-sm btn-outline-dark btn-block"--}}
{{--                        wire:click.prevent="update({{ $editId }})">Update--}}
{{--                    </x-admin.button>--}}
{{--                    @else--}}
{{--                    <x-admin.button class="btn-sm btn-outline-dark btn-block" wire:click.prevent="store">Submit--}}
{{--                    </x-admin.button>--}}
{{--                    @endif--}}

{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
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
