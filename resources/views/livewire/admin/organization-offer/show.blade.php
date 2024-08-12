<div>
    <x-slot name="title"> @lang('app.dashboard') | @lang('app.product-offer')</x-slot>
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$org}}</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">{{$offerData}}  ({{$percent}}%)</a></li>
    </x-slot>
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title d-flex justify-content-center">
                        <a href="{{route('admin.organization-offer.index')}}" class="btn btn-sm btn-outline-light">
                            <i class="fa-solid fa-arrow-left-long"></i> &nbsp;
                            Back
                        </a>
                    </h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-responsive-md">
                            <thead>
                            <tr>
                                <th><strong>@lang('app.id')</strong></th>
                                <th><strong>@lang('app.product')</strong></th>
                                <th><strong>@lang('app.category')</strong></th>
                                <th><strong>@lang('app.actions')</strong></th>
                            </tr>
                            </thead>
                            <tbody>
                            @forelse ($products as $key => $product)

                                <tr>
                                    <td><strong>{{ ++$key }}</strong></td>
                                    <td>{{ $product->product->translate('title') }}</td>
                                    <td>{{ $product->product->category?->translate('name') }}</td>
                                    <td>
                                        <div class="d-flex justify-content-start">
                                            <a href="#" class="btn btn-xs sharp text-danger fz-16px"><i
                                                    class="fa fa-trash-can" wire:loading.class="disabled"
                                                    wire:confirm="Are you sure you need to delete ?"
                                                    wire:click.prevent="delete({{ $product->id }})"></i>
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

</div>
