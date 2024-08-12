<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"/>


@extends('checouts.app-organization')
@section('content')
    <!--write in here-->
    <div class="product_banner">
    <div class="container">
  <div class=" d-flex align-item-center justify-content-between ">
                  <div class="product_content">
                  <div class="product_title"> All Products
        <!--start breadcrumb-->
        <div class="breadcrumb-container d-flex flex-column justify-content-start align-items-start" style="margin-top: 20px">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                 aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.organization.organizations') }}"><img
                                    src="{{ asset('assets/images/home.svg') }}" class="icon"
                                    alt="@lang('app.alt_image')"/>
                          Home</a></li>
                    <li class="breadcrumb-item">Products list</li>
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

    <!-- end -->


    <div class=" products   d-flex align-items-center flex-column">
        <div class="container mt-3 px-0">
            <div class="position-relative">
            @include('products/components/filter')
            </div>

            <div class="tab-content">

                <div class="tab-pane active" id="tab1">

                    <div class="container-products">
                        <div class="right-section p-0">
                            @forelse ($products as $product)
                                @include('products/components/product')
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
                    <div class="button m-auto mt-4" style="width:max-content">
                        @php
                            $productCount = request('cat_id') ? \App\Models\Product::where('category_id',request('cat_id'))->count() : \App\Models\Product::all()->count();
                        @endphp
                        @if($products->count()>0 && $products->count() < $productCount)
                            <a class="btn btn-warning m-auto p-3 d-block mb-4"
                               href="{{ url()->current() }}?{{ http_build_query(['limit' => request('limit')? request('limit')+10 : 20 ,'cat_id'=>request('cat_id')])}}">
                                Show More Product
                            </a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

            <!--<script src="https://unpkg.com/swiper/swiper-bundle.min.js"></script> -->
            <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>


            <script>
                //   const tabs = document.querySelectorAll('#myTabs .nav-link_custom');
                const tabContent = document.querySelectorAll('.tab-content .tab-pane');

                //   tabs.forEach(tab => {
                //     tab.addEventListener('click', function(e) {
                //       e.preventDefault();
                //       const tabId = this.getAttribute('data-tab-id');
                //       showTab(tabId);
                //     });
                //   });

                function showTab(tabId) {
                    tabs.forEach(tab => {
                        tab.classList.remove('active');
                    });

                    tabContent.forEach(content => {
                        content.classList.remove('active');
                    });

                    const tab = document.querySelector(`#myTabs .nav-link[data-tab-id="${tabId}"]`);
                    const content = document.querySelector(`.tab-content .tab-pane#${tabId}`);

                    tab.classList.add('active');
                    content.classList.add('active');
                }


                //   swiper
                var swiper = new Swiper(".mySwiper", {
                    slidesPerView: 4,
                    centeredSlides: false,
                    slidesPerGroupSkip: 1,
                    grabCursor: true,
                    keyboard: {
                        enabled: true,
                    },
                    mousewheel: {
                        forceToAxis: true,
                    },
                    //   breakpoints: {
                    //     769: {
                    //       slidesPerView: 2,
                    //       slidesPerGroup: 2,
                    //     },
                    //   },
                    scrollbar: {
                        el: ".swiper-scrollbar",
                    },
                    navigation: {
                        nextEl: ".swiper-button-next",
                        prevEl: ".swiper-button-prev",
                    },
                    //   pagination: {
                    //     el: ".swiper-pagination",
                    //     clickable: true,
                    //   },
                });
            </script>

@stop
