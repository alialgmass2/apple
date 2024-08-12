<div>


    <div class="products   d-flex align-items-center flex-column" style="padding-bottom:100px">
        <div class="container">
            <div class="d-flex justify-content-center align-items-center position-relative">
                <h1 class=" orgnization-title">@lang('app.apple_products')</h1>
                {{-- <a href="#" class="title-link fz-14px mb-5">Browse All Proudcts <img
                        src="{{ asset('images/arrow-right.png') }}" width="20" height="20" alt="" /></a> --}}
            </div>
        </div>
        <div class="container-custom mt-3 px-0">

            <div class="container-products limited_height">
                <div class="right-section">
                @php $categories= \App\Models\Category::where('name_en','!=','All')->get(); @endphp
                @forelse ($categories as $category)
                    <!-- start category card -->
                        <a href="{{\URL::to('/products/'.$category->id??'')}}"  style="width:300px" class="category_item_link">
                            <div class="category_item">
                                <div class="category_title">
                                    <p> {{$category->translate('name')}} </p>
                                </div>
                                <div class="image d-flex justify-content-center align-items-center">
                                    <img   src="{{$category->image_url ?? "https://as2.ftcdn.net/v2/jpg/00/81/38/59/1000_F_81385977_wNaDMtgrIj5uU5QEQLcC9UNzkJc57xbu.jpg"}}" alt="category image" loading="lazy"/>
                                </div>
                            </div>
                        </a>
                    <!-- end category card -->
                    @empty
                    no data
                    @endforelse
                </div>
            </div>
        </div>
         <div class="button">
            <a class="btn btn-warning" href="{{\URL::to('/products/all')}}">Show All Products</a>
        </div>
    </div>

    <style>
        .button{
            margin-top:30px;
            font-size:20px;
        }
        .container-products .right-section .product-item .image img{
            max-width:100% !important;
            max-height:100% !important;
        }
    </style>
</div>

<script src="{{ asset('assets/js/addProduct.js') }}"></script>
