<div>
    <div class="product_details">
        <div class="container">
            <div class="breadcrumb-container m-0 product-details-breadcumb" style="margin-top:70px !important">
                <div class="container ms-0 ar-ms-0" style="z-index:99">
                    <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                         aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item "><a class="breadcrumb_item_white"
                                                            href="{{ route('user.organization.organizations') }}"><img
                                            src="{{ asset('assets/images/homeblack.svg') }}" class="icon"
                                            alt="@lang('app.alt_image')"/>
                                    {{authUser() != null ? authUser()->organization->translate('name') : ''}}</a></li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $product->translate('title')
                                    }}</li>
                        </ol>
                    </nav>

                </div>
            </div>
            <div class=" d-flex flex-wrap  justify-content-between ">
                <div class="product_img col-12 col-md-6 " style="    border: 2px solid #0000002b; border-radius: 20px;">
                    <div id="carouselExampleDark" class="carousel carousel-dark slide">
                        <div class="position-relative" style="    padding: 10px ">
                            @if(checkOffer($product->id) != null)
                                <div class="offer_mark">{{checkOffer($product->id)}} % </div>
                            @endif
                            <div class="carousel-inner">
                                @forelse($images as $key => $image)
                                    <div class="carousel-item {{$key === array_key_first($images->toArray()) ? 'active' : ''}}"
                                         data-bs-interval="10000">
                                        <img src="{{ route('website.uploads', $image->url) }}"
                                             class="icon d-block m-auto" alt="product image"/>.
                                    </div>
                                @empty
                                @endforelse
                            </div>
                        </div>
                        <div class="carousel-indicators position-relative">
                            @forelse($images as $key => $image)
                                <img data-bs-target="#carouselExampleDark" data-bs-slide-to="{{$key}}"
                                     aria-label="Slide {{$key+1}}" aria-current="true"
                                     src="{{ route('website.uploads', $image->url) }}"
                                     class="{{$key === array_key_first($images->toArray()) ? 'active' : ''}} image_carousel"
                                     alt="product image"/>
                            @empty
                            @endforelse
                            @if(($images->count()) > 3)
                                <div class="carousel_control">
                                    <button class="carousel-control-prev" type="button"
                                            data-bs-target="#carouselExampleDark" data-bs-slide="prev">
                                        <span class="fa-solid fa-chevron-left btn_slider" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button"
                                            data-bs-target="#carouselExampleDark" data-bs-slide="next">
                                        <span class="fa-solid fa-chevron-right btn_slider" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>

                <div class="product_content col-12 col-md-6 ps-5">
                    <h1 class="product-title m-0" style="font-size:40px">Product Overview</h1>
                    <h1 class="product-title m-0" style="margin-top:10px">{{ $product->translate('title') }}</h1>
                    <p class="product_subtitle m-0">{{ $product->translate('sub_title') }}</p>
                    <p class="text-left m-0">{{ $product->translate('description') }}</p>
                    <div id="tabby" class="m-0" wire:ignore></div>

                    @if($colors != null)
                        <div class="colours">
                            <p>colour</p>
                            <div class="colours_containers">
                                @foreach($colors as $key => $colorList)
                                    <div class="colour_container {{$color == $colorList->id ? 'colour_active' : ''}}"
                                         wire:click="colorImage({{ $colorList->id }})"
                                         style="background:{{$colorList->color_code}}"></div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                    <div class="d-flex flex-wrap" style="gap:30px">
                        @if (authUser() != null && authUser()->organization->discount != 0)
                            <p class="product_price">
                                <del>{{ $product->price }} @lang('app.sar')</del>
                                    &nbsp;&nbsp; {{
                                    calculateDiscountForOrder($product->price,
                                    getPrice($product->id)) }} @lang('app.sar')
                            </p>
                        @else
                            <p class="product_price">{{ $product->price }} @lang('app.sar')</p>
                        @endif
                        <a href="javascript:void(0);" class="btn-yellow text-black border-radius-5px"
                           wire:loading.class="disabled" wire:loading.attr="disabled"
                           wire:click.prevent="addToCart({{ $product->id }})">@lang('app.add_to_cart')
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class=" product-details section-padding d-flex align-items-center technical-specifications">
        <div class="container">
            <!-- <h1 class="text-left mb-5 section-title">@lang('app.technical_specifications')</h1> -->
            <h1 class="text-left mb-5 section-title">Product Information</h1>
            <div class="scroll" id="nav-tab" role="tablist">
                <button class="item_link active btn_icon" id="tab1-tab" data-bs-toggle="tab" data-bs-target="#tab1" type="button"
                        role="tab" aria-controls="tab1" aria-selected="false">
                    <!--<i class="fa-solid fa-cannabis"></i>-->
                        Specifications
                </button>
                <button class="item_link btn_icon" id="tab2-tab" data-bs-toggle="tab" data-bs-target="#tab2" type="button"
                        role="tab" aria-controls="tab2" aria-selected="false"> Key features
                </button>
                <button class="item_link btn_icon" id="tab3-tab" data-bs-toggle="tab" data-bs-target="#tab3" type="button"
                        role="tab" aria-controls="tab3" aria-selected="false">Legal
                </button>
                <button class="item_link btn_icon" id="tab4-tab" data-bs-toggle="tab" data-bs-target="#tab4" type="button"
                        role="tab" aria-controls="tab4" aria-selected="false">Technical Specifications
                </button>
            </div>
            <div class="row align-items-start h-100" style="flex-direction: row-reverse;">
                <div class="col-12 col-lg-6 col-md-12">
                    <div class="left-section h-100">
                        <img src="{{ $product->getFile('default_img') }}" alt=""/>
                    </div>
                </div>
                <div class="col-12 col-lg-6 col-md-12 justify-content-start  align-items-center d-flex h-100">
                    <div class="w-100 ">

                        <div class="tab-content " id="nav-tabContent">
                            @php
                                $productKey = [
                                        'specifications',
                                        'features',
                                        'legal',
                                        'technical_specifications',
                                ];
                            @endphp
                            @foreach($productKey as $key => $item)
                                <div class="tab-pane fade {{$item == 'specifications' ? 'show active' : ''}} " id="tab{{$key+1}}" role="tabpanel" aria-labelledby="tab{{$key+1}}-tab"
                                     tabindex="0">
                                    <ul>
                                        {!! productInfo($product->translate($item) ,$product->links[$item]??null) !!}
                                    </ul>
                                </div>
                            @endforeach
                        </div>
                        {{-- <div class="right-section h-100 d-flex align-items-start justify-content-start flex-column features-text">
                            @php
                            $features = explode(PHP_EOL, $product->translate('features'));
                            @endphp
                            @for ($i = 0; $i < count($features); $i++) <li class="mb-1 fz-1rem">{{ $features[$i] }}</li>
                                @endfor
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>


        {{-- MODAL START --}}
        <x-website.modal size="modal-lg" :isModalShow="$isModalShowOrder">
            <div class="col-xl-12 col-lg-12">
                <h5 class="text-center mb-4">Order Now</h5>
                <h6 class="text-center">Deliver To</h6>
                <div class="d-flex justify-content-center  mx-5 mt-4">
                    <a href="javascript:void(0);"
                       class="btn-order-type mb-4 {{ toExists('type',$state) &&  $state['type'] == 'DELIVER_TO_HOME' ? 'active': '' }}"
                       wire:loading.class="disabled" wire:click.prevent="$set('state.type', 'DELIVER_TO_HOME')">Home</a>
                    <span class="mx-3 mt-1">Or</span>
                    <a href="javascript:void(0);"
                       class="btn-order-type mb-4 {{ toExists('type',$state) &&  $state['type'] == 'DELIVER_TO_ORGANIZATION' ? 'active': '' }}"
                       wire:loading.class="disabled"
                       wire:click.prevent="$set('state.type', 'DELIVER_TO_ORGANIZATION')">Organization</a>
                    <br>
                </div>
                @error('type')
                <p class="text-danger fz-14px ml-0">{{ $message }}</p>
                @enderror
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="input-group mb-3 flex-column">
                            <div class="w-100">
                                <label for="">City</label>
                                <select class="form-control" wire:model="state.city_id">
                                    <option value="">@lang('app.choose')</option>
                                    @forelse ($cities as $city)
                                        <option value="{{ $city->id }}">{{ $city->translate('name') }}</option>
                                    @empty
                                    @endforelse
                                </select>
                            </div>
                            @error('city_id')
                            <p class="text-danger fz-14px ml-0">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="input-group mb-3 flex-column">
                            <div class="w-100">
                                <label for="">District</label>
                                <input type="text" class="form-control" placeholder="" aria-label=""
                                       aria-describedby="basic-addon2" wire:model="state.district">
                            </div>
                            @error('district')
                            <p class="text-danger fz-14px ml-0">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="input-group mb-3 flex-column">
                            <div class="w-100">
                                <label for="">Phone</label>
                                <input type="text" class="form-control" placeholder="" aria-label=""
                                       aria-describedby="basic-addon2" wire:model="state.phone">
                            </div>
                            @error('phone')
                            <p class="text-danger fz-14px ml-0">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="input-group mb-3 flex-column">
                            <div class="w-100">
                                <label for="">Address</label>
                                <input type="text" class="form-control" placeholder="" aria-label=""
                                       aria-describedby="basic-addon2" wire:model="state.address">
                            </div>
                            @error('district')
                            <p class="text-danger fz-14px ml-0">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="input-group mb-3 flex-column">
                            <div class="w-100">
                                <label for="">Short National ID</label>
                                <input type="text" class="form-control" placeholder="" aria-label=""
                                       aria-describedby="basic-addon2" wire:model="state.short_national_id">
                            </div>
                            @error('short_national_id')
                            <p class="text-danger fz-14px ml-0">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="col-12 col-md-6">
                        <div class="input-group mb-3 flex-column">
                            <div class="w-100">
                                <label for="">Zip Code</label>
                                <input type="text" class="form-control" placeholder="" aria-label=""
                                       aria-describedby="basic-addon2" wire:model="state.zip_code">
                            </div>
                            @error('zip_code')
                            <p class="text-danger fz-14px ml-0">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                    <div class="input-group mb-3 flex-column">
                        <a href="javascript:void(0);" class="btn-order-type mt-3 py-2" wire:loading.class="disabled"
                           wire:click.prevent="orderNow">Order
                            Now <i class="fas fa-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </x-website.modal>
        {{-- MODAL END --}}
    </div>
</div>


<script src="https://checkout.tabby.ai/tabby-promo.js"></script>
                    <script>
                        new TabbyPromo({
                            selector: '#tabby', // required, content of tabby Promo Snippet will be placed in element with that selector.
                            currency: 'SAR', // required, currency of your product. AED|SAR|KWD|BHD|QAR only supported, with no spaces or lowercase.
                            price: '{{round($product->price,2)}}', // required, price or the product. 2 decimals max for AED|SAR|QAR and 3 decimals max for KWD|BHD.

                            lang: '{{app()->getLocale()}}',// Optional, language of snippet and popups, if the property is not set, then it is based on the attribute 'lang' of your html tag.
                            source: 'product', // Optional, snippet placement; `product` for product page and `cart` for cart page.
                            publicKey: '{{env('tappyToken')}}' ,// required, store Public Key which identifies your account when communicating with tabby.
                            merchantCode: 'jawraa'  // required
                        });
                    </script>
