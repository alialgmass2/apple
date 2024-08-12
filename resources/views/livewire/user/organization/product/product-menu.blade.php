<div>
    <div class="product_banner">
        <div class="container">
            <div class=" d-flex align-items-end justify-content-between ">
                <div class="product_content">
                    <div class="product_title"> All Products
                        <!--start breadcrumb-->
                        <div class="breadcrumb-container d-flex flex-column justify-content-start align-items-start"
                             style="margin-top: 20px">
                            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                                 aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a
                                                href="{{ route('user.organization.organizations') }}"><img
                                                    src="{{ asset('assets/images/home.svg') }}" class="icon"
                                                    alt="@lang('app.alt_image')"/>
                                            Home</a></li>
                                    <li class="breadcrumb-item"><a href="{{ route('carts.index') }}">Products list</a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <!--end breadcrumb-->
                    </div>
                </div>
                <div class="product_img col-6 ">
                    <img src="{{ asset('assets/images/banner-product.png') }}" class="icon" alt="banner image">
                </div>
            </div>

        </div>
    </div>
    <div class=" products   d-flex align-items-center flex-column">
        <div class="container mt-3 px-0">
            <div class="position-relative" style="padding:0px 40px">
                <div class="filter">
                    <ul class="nav nav-tabs" id="myTabs">
                        @foreach($categories as $category)
                            <li class="nav-item">

                                <a onclick="clickCategory(this,'{{ $category->name_en == 'All' ? 'all' : $category->id }}')"
                                   class="nav-link {{$currentCategory == $category->id ? 'active' : ''}} {{$category->name_en == 'All' && $currentCategory == null ? 'active' : ''}}"
                                   @if($category->name_en == 'All') wire:click.prevent="filterCategories()"
                                   @else wire:click.prevent="filterCategories({{ $category->id }})" @endif >
                                    <div class="image_category d-flex justify-content-center align-items-center">
                                        <img
                                                src="{{$category->image_url ?? "https://as2.ftcdn.net/v2/jpg/00/81/38/59/1000_F_81385977_wNaDMtgrIj5uU5QEQLcC9UNzkJc57xbu.jpg"}}"
                                                alt="category image" loading="lazy"/>
                                    </div>
                                    <p class="title">  {{$category->name_en}}</p>
                                </a>
                            </li>
                        @endforeach
                    </ul>


                    <div class="scroll-btn left-btn"><i class="fa-solid fa-chevron-left"></i></div>
                    <div class="scroll-btn right-btn"><i class="fa-solid fa-chevron-right"></i></div>
                </div>
            </div>
            <div class="tab-content">

                <div class="tab-pane active" id="tab1">

                    <div class="container-products">

                        <div class="spinner_container" wire:loading wire:target="filterCategories">
                            <div class="spinner m-auto"></div>
                        </div>

                        <div class="right-section p-0" wire:loading.remove wire:target="filterCategories">
                            @forelse ($products as $product)
                                <a href="{{route('user.organization.product',$product->id)}}" class="product-item-link position-relative">
                                @if(checkOffer($product->id) != null)
                                    <div class="offer_mark">{{checkOffer($product->id)}} % </div>
                                @endif
                                    <div class="product-item">
                                        <div class="image d-flex justify-content-center align-items-center">
                                            <img class="product_img" src="{{ $product->getFile('default_img') }}"
                                                 alt="@lang('app.alt_image')" loading="lazy"/>
                                        </div>
                                        <div class="details">
                                            <h1 class="mb-1 cursor-pointer" {{--wire:click.prevent="toDetails({{ $product->id }})"--}}>{{ $product->translate('title') }}</h1>
                                            @if (authCheck() && authUser()->organization->discount != 0)
                                                <p class="fz-14px text-black">
                                                    <del>{{ $product->price }} @lang('app.sar')</del>
                                                    {{ calculateDiscountForOrder($product->price,getPrice($product->id)) }}
                                                    @lang('app.sar')
                                                </p>
                                            @else
                                                <p class="fz-14px text-black">{{ $product->price }} @lang('app.sar')</p>
                                            @endif

                                            <div class="w-100">

                                                <button class="add_to_cart btn btn-warning"

                                                   href="{{route('user.organization.product',$product->id)}}"> More
                                                    Description
                                                </button>
                                                {{--                                                wire:click.prevent="addToCart({{ $product->id }})--}}
                                            </div>
                                        </div>
                                    </div>
                                </a>
                            @empty
                                <div class="no_data container">
                                    <div class="no_data_content">
                                        <img class="not_found" src="{{asset('assets/images/notfound.png')}}"
                                             alt="not-found"/>
                                        Please note that there are currently no products added to this list
                                        <p>
                                            Thank you for your patience.
                                        </p>
                                    </div>

                                </div>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
            <div class="button m-auto mt-4" style="width:max-content">
                @php
                    $productCount = $currentCategory == null ? \App\Models\Product::count() : \App\Models\Product::where('category_id',$currentCategory)->count();
                @endphp
                @if($products->count()>0 && $products->count() < $productCount)
                    <a class="btn btn-warning m-auto p-3 d-block mb-4"
                       wire:click="productLimit()">
                        Show More Product
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
</div>

@push('js')

<script src="{{asset('assets/js/filter.js')}}"></script>



@endpush

