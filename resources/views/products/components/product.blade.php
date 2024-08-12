<a href="{{route('user.organization.product',$product->id)}}" class="product-item-link">
    <div class="product-item">
        <div class="image d-flex justify-content-center align-items-center">
            <img class="product_img" src="{{ $product->getFile('default_img') }}"
                 alt="@lang('app.alt_image')" loading="lazy"/>
            <!--<div class="image-overlay">-->
            <!--    <div class="overlay-icon" wire:click.prevent="toDetails({{ $product->id }})" title="@lang('app.details')" >-->
            <!--        <img src="{{ asset('assets/images/eye.svg') }}" alt="@lang('app.alt_image')"    loading="lazy" />-->
            <!--    </div>-->
            <!--    <div class="overlay-icon" wire:loading.attr="disabled" wire:click.prevent="addToCart({{ $product->id }})" title="@lang('app.add_to_cart')">-->
            <!--        <img src="{{ asset('assets/images/cart.svg') }}" alt="@lang('app.alt_image')"   loading="lazy" />-->
            <!--    </div>-->
            <!--</div>-->
        </div>
        <div class="details">
            <h1 class="mb-1 cursor-pointer"
                wire:click.prevent="toDetails({{ $product->id }})">{{ $product->translate('title') }}</h1>
            @if (authUser() != null && authUser()->organization->discount != 0)
                <p class="fz-14px text-black">
                    <del>{{ $product->price }} @lang('app.sar')</del> {{ calculateDiscountForOrder($product->price,
                                authUser()->organization->discount) }} @lang('app.sar')</p>
            @else
                <p class="fz-14px text-black">{{ $product->price }} @lang('app.sar')</p>
            @endif
            {{-- <button type=""  wire:loading.attr="disabled" wire:click.prevent="addToCart({{ $product->id }})" >Add to cart</button> --}}
            <!--21/3/2024-->
            <div id="tabby"></div>
            <form method="post" data-product="{{$product->id}}" action="{{route('carts.store')}}" class="add_cart_form w-100">
                @csrf
                <input type="hidden" name="product" value="{{$product->id}}">
                <button type="submit" onsubmit="" class="add_to_cart btn btn-warning">
                    Add to cart
                </button>
            </form>

        </div>

    </div>
</a>
<script src="https://checkout.tabby.ai/tabby-promo.js"></script>
<script>
    new TabbyPromo({
        selector: '#tabby', // required, content of tabby Promo Snippet will be placed in element with that selector.
        currency: 'SAR', // required, currency of your product. AED|SAR|KWD|BHD|QAR only supported, with no spaces or lowercase.
        price: '{{number_format($product->price,2)}}', // required, price or the product. 2 decimals max for AED|SAR|QAR and 3 decimals max for KWD|BHD.

        lang: '{{app()->getLocale()}}',// Optional, language of snippet and popups, if the property is not set, then it is based on the attribute 'lang' of your html tag.
        source: 'product', // Optional, snippet placement; `product` for product page and `cart` for cart page.
        publicKey: '{{env('tappyToken')}}' ,// required, store Public Key which identifies your account when communicating with tabby.
        merchantCode: 'jawraa'  // required
    });
</script>