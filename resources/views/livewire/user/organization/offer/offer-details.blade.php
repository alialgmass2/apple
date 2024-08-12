<div>

    <style>
        .banner-organization {
            /*height:800px;*/
            position: relative;

        }

        .container_position {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
            left: 12%;
                width: 60%;
    z-index: 99;
        }
        .carousel-indicators [data-bs-target] {
            background-color:#f2c343;
            height:5px;
        }
        .carousel-indicators {
   
    bottom: 5px;}
    </style>
    @if($offer->getFile('banner') != null)
        <div class="banner-organization">
                <!--<div class="overlay"></div>-->
                <div id="carouselExampleInterval" data-bs-ride="carousel" class="carousel slide h-100">
                    <div class="carousel-indicators ">
                        @foreach($offer->getFilesUrl('multi_banner') as $key => $banner)
                            <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="{{$key}}" class="{{$key == 0 ? 'active' : ''}}"
                                    aria-current="true" aria-label="Slide {{++$key}}">
                            </button>
                        @endforeach
                    </div>
                    <div class="carousel-inner h-100">
                        if
                        @foreach($offer->getFilesUrl('multi_banner') as $key => $banner)
                            <div class="carousel-item {{$key == 0 ? 'active' : ''}} h-100" data-bs-interval="5000">
                                <img src="{{$banner}}"
                                     class="d-block w-100 h-100" alt="...">
                            </div>
                        @endforeach
                    </div>

                </div>

            {{--    <div class="container-custom container_position">

                    <div class=" d-flex align-items-center justify-content-between ">
                      
                        <div id="body" class="text-dark">

                            <div class="offer p-0">
                                <p class="offer_title">{{$offer->translate('title')}}</p>

                                <span class="discount">Up to {{$offer->percent}} % Off </span>
                            </div>
                            <p class="offer_brief">
                                {{$offer->translate('brief')}}
                            </p>
                            <div class="count_time" id="count_time"
                                 data-set="{{\Carbon\Carbon::parse($offer->end_date)->format('Y-m-d')}}"> 
                                <div class="timer"><span id="days">  </span> Days</div>
                                <div class="timer"><span id="hours">  </span> Hours</div>
                                <div class="timer"><span id="minutes"> </span> Minutes</div>
                                <div class="timer"><span id="seconds"></span> Seconds</div>
                            </div>
                        </div>


                        <!--<div class="product_img col-6 ">-->
                        <!--    <img src="{{$offer->getFile('banner')}}" class="icon" alt="banner image">-->
                        <!--</div>-->
                    </div>

                </div>  --}}

            </div>
    @else
        <div class="product_banner">
                <div class="container-custom">
                    <div class=" d-flex align-items-center justify-content-between ">
                        <div class="product_content">
                            <div class="offer">
                                <p class="offer_title">{{$offer->translate('title')}}</p>

                                 <span class="discount">Up to {{$offer->percent}} % Off </span>
                                <p class="offer_brief ">{{$offer->translate('brief')}}</p>
                            </div>
                        </div>
                        <div class="product_img col-6 ">-->
                            <img src="{{$offer->getFile('banner')}}" class="icon" alt="banner image">
                        </div>
                    </div>

                </div>
            </div>
    @endif
    <div class="offer_details">
        <div class="container-custom">
            <p class="offer_desc">{{$offer->translate('discription')}}</p>
        </div>
    </div>

    <div class=" products   d-flex align-items-center flex-column">
        <div class="container mt-3 px-0">
            <div class="position-relative" style="padding:0px 40px">
                <div class="filter">
                    <ul class="nav nav-tabs" id="myTabs">
                        @if($categories != null)
                            <li class="nav-item">
                                <a class="nav-link @if($currentCategory == null) active @endif"
                                   wire:click.prevent="filterCategories()">
                                    <div class="image_category d-flex justify-content-center align-items-center">
                                        <img
                                            src="https://edu.jawraa.com/storage/cat/1712224378.png"
                                            alt="category image" loading="lazy"/>
                                    </div>
                                    <p class="title">All Category</p>
                                </a>
                            </li>
                            @foreach($categories as $category)
                                <li class="nav-item">

                                    <a class="nav-link @if($currentCategory == $category->id) active @endif"
                                       wire:click.prevent="filterCategories({{ $category->id }})">
                                        <div class="image_category d-flex justify-content-center align-items-center">
                                            <img
                                                src="{{$category->image_url ?? "https://as2.ftcdn.net/v2/jpg/00/81/38/59/1000_F_81385977_wNaDMtgrIj5uU5QEQLcC9UNzkJc57xbu.jpg"}}"
                                                alt="category image" loading="lazy"/>
                                        </div>
                                        <p class="title">{{$category->translate('name')}}</p>
                                    </a>
                                </li>
                            @endforeach
                        @endif
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
                            @if($products != null)
                                @foreach($products as $product)
                                    <a href="{{route('user.organization.product',$product->product->id)}}"
                                       class="product-item-link position-relative">
                                        {{--   <div class="offer_mark">{{checkOffer($product->product->id)}} % </div> --}}
                                        <div class="product-item">
                                            <div class="image d-flex justify-content-center align-items-center">
                                                <img class="product_img"
                                                     src="{{ $product->product->getFile('default_img') }}"
                                                     alt="@lang('app.alt_image')" loading="lazy"/>
                                            </div>
                                            <div class="details">
                                                <h1 class="mb-1 cursor-pointer">{{$product->product->translate('title')}}</h1>

                                                @if (authCheck() && authUser()->organization->discount != 0)
                                                    <p class="fz-14px text-black">
                                                        <del>{{ $product->product->price }} @lang('app.sar')</del>
                                                        {{ calculateDiscountForOrder($product->product->price,getPrice($product->product->id)) }}
                                                        @lang('app.sar')
                                                    </p>
                                                @else
                                                    <p class="fz-14px text-black">{{ $product->product->price }} @lang('app.sar')</p>
                                                @endif

                                                {{--                                            <p class="fz-14px text-black"> price after offer   @lang('app.sar')</p>--}}
                                                <div class="w-100">

                                                    <button class="add_to_cart btn btn-warning">More Description
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </a>
                                @endforeach
                            @else
                                <div class="no_data container">
                                    <div class="no_data_content">
                                        <img class="not_found" src="{{asset('assets/images/notfound.png')}}"
                                             alt="not-found"/>
                                        Please note that there are currently no products added to this offer
                                        <p>
                                            Thank you for your patience.
                                        </p>
                                    </div>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="button m-auto mt-4" style="width:max-content">
                @if($more)
                    <a class="btn btn-warning m-auto p-3 d-block mb-4"
                       wire:click="productLimit()">
                        Show More Product
                    </a>
                @endif
            </div>


        </div>
    </div>

    <script src="{{asset('assets/js/filter.js')}}"></script>
    <script src="{{ asset('js/timer.js') }}"></script>
</div>
