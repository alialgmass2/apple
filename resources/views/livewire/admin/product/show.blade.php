<div class="card-body bg-white">
    <x-slot name="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">@lang('app.dashboard')</a></li>
        <li class="breadcrumb-item"><a href="{{ route('admin.product.index') }}">@lang('app.products')</a></li>
        <li class="breadcrumb-item active"><a href="javascript:void(0)">@lang('app.show')</a></li>
    </x-slot>
    <div class="table-responsive">
        <table class="table table-responsive-md table-bordered">
            <thead>
                <tr>
                    <th class="w-250px"><strong>@lang('app.name')</strong></th>
                    <th><strong>@lang('app.description')</strong></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td class="font-bold">ID</td>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.image')</td>
                    <td>{!! handlePreviewFile($product->getFile('default_img')) !!}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.images')</td>
                    <td class="preview-container-show">
                        @forelse ($product->getFiles() as $img)
                        {!! handlePreviewFile(route('admin.uploads',[$img->url])) !!}
                        @empty
                        @endforelse
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.pdf')</td>
                    <td>{!! handlePreviewFile($product->getFile('pdf')) !!}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.category')</td>
                    <td>{{ $product->category->translate('name') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.sub_categories')</td>
                    <td>{{ $product->subCategory->translate('name') }}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.title')</td>
                    <td>{{ $product->translate('title') }}</td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.legal')</td>
                    <td>
                        @if(str_contains($product->translate('legal'),"\n"))
                            <ul>
                                @foreach(explode("\n",$product->translate('legal')) as $specificationItem)
                                    <li>{{$specificationItem}}</li>
                                @endforeach
                            </ul>
                        @else
                            {{$product->translate('legal')}}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.technical_specifications')</td>
                    <td>
                        @if(str_contains($product->translate('technical_specifications'),"\n"))
                            <ul>
                                @foreach(explode("\n",$product->translate('technical_specifications')) as $specificationItem)
                                    <li>{{$specificationItem}}</li>
                                @endforeach
                            </ul>
                        @else
                            {{$product->translate('technical_specifications')}}
                        @endif
                    </td>
                </tr>

                <tr>
                    <td class="font-bold">@lang('app.specifications')</td>
                    <td>
                    @if(str_contains($product->translate('legal'),"\n"))
                        <ul>
                            @foreach(explode("\n",$product->translate('specifications')) as $specificationItem)
                                <li>{{$specificationItem}}</li>
                            @endforeach
                        </ul>
                    @else
                        {{$product->translate('specifications')}}
                    @endif
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.description')</td>
                    <td>
                    @if(str_contains($product->translate('description'),"\n"))
                        <ul>
                            @foreach(explode("\n",$product->translate('description')) as $specificationItem)
                                <li>{{$specificationItem}}</li>
                            @endforeach
                        </ul>
                    @else
                        {{$product->translate('description')}}
                    @endif
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.features')</td>
                    <td>
                        @if(str_contains($product->translate('features'),"\n"))
                            <ul>
                                @foreach(explode("\n",$product->translate('features')) as $specificationItem)
                                    <li>{{$specificationItem}}</li>
                                @endforeach
                            </ul>
                        @else
                            {{$product->translate('legal')}}
                        @endif
                    </td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.video')</td>
                    <td>{{ $product->translate('video') }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.price')</td>
                    <td>{{ $product->price }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.discount')</td>
                    <td>{{ $product->discountView }}</td>
                </tr>
                <tr>
                    <td class="font-bold">@lang('app.created_at')</td>
                    <td>{{ $product->created_at }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
