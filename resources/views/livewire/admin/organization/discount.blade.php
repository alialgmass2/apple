<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.organization.index') }}">@lang('app.organizations')</a></li>
        <li class="breadcrumb-item active">{{$organization->name_en}}</li>
    </x-slot>
    <div class="table-responsive">
        <b style="color: #0c0c0c ; font-size: 20px">Global Assigned Discount on organization : {{$organization->discount}}%</b>
        <table class="table table-responsive-md table-bordered">
            <thead>
            <tr>
                <th><strong>ID</strong></th>
                <th><strong>Image</strong></th>
                <th><strong>Title</strong></th>
                <th><strong>Category</strong></th>
                <th><strong>Sub Category</strong></th>
                <th><strong>Price</strong></th>
                <th><strong>Discount</strong></th>
            </tr>
            </thead>
            <tbody>
            @forelse ($products as $key => $product)
                <tr>
                    <td>
                        <strong>{{ ++$key }}</strong>
                    </td>
                    <td>
                        <img class="file-preview" src="{{ $product->getFile('default_img') }}" alt=""/>
                    </td>
                    <td>{{ $product->translate('title') }}</td>
                    <td>
                        {{ $product->category->translate('name') }}
                    </td>
                    <td>
                        {{ $product->subCategory->translate('name') }}
                    </td>
                    <td>
                        {{ $product->price }}
                    </td>
                    <td>
                        <div class="col-8 m-auto">
                            <x-admin.input title="discount" error="discount" wire:model="state.{{$product->id}}"/>
                        </div>
                    </td>
                </tr>

            @empty
            @endforelse
            </tbody>
        </table>
        {{ $products->links() }}
        <div class="m-auto col-6 col-md-4">
            <x-admin.button class="btn-sm btn-outline-dark btn-block" wire:click.prevent="discountStore()">
                Save Discount
            </x-admin.button>
        </div>
    </div>
</div>
