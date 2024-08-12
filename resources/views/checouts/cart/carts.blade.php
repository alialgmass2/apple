@extends('checouts.app-organization')
@section('content')
    <?php
    $title ="carts";
      $authUser =authUser()->howToKnow()->exists()
    ?>
    <div class="new-container position-relative">
        {{-- BREADCRUMB START --}}
        <div class="breadcrumb-container">
            <nav
                style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.organization.organizations') }}"><img
                                src="{{ asset('assets/images/homeblack.svg') }}" class="icon" alt=""/>
                            @lang('app.home')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('app.shopping_cart')</li>
                </ol>
            </nav>
        </div>
        {{-- BREADCRUMB END --}}
        {{-- CONTENT START --}}
        <div class="cart-items-container">
            <div class="">
                <h3>@lang('app.my_cart') ({{$carts->count()}})</h3>
                <!--<div class="cart-items empty_cart" >-->
                <div class="  {{ $carts->count() > 0 ? 'cart-items' : 'empty_cart' }} ">
                    <div class="left-section">

                        @foreach($carts as $cart)
                            {{-- @dump($cart->user->organization->max_order_number == 0 ? 'ZERO' : 'not zero') --}}
                            {{-- CART ITEM START --}}
                            <div class="cart-item">
                                <div class="cart-left">
                                    {{-- <img
                                        src="{{ $cart->product()->count() > 0 ? $cart->product()->first()->images?->url : ''}}"
                                        alt="" /> --}}
                                    <img src="{{ $cart->product->getFile('default_img')  }}"
                                         alt="@lang('app.alt_image')"/>

                                </div>
                                <div class="middle-section">
                                    <div class="title">
                                        <h6 class="one">{{$cart->product()->first()->title_en}}</h6>
                                        {{-- EDITED BY MAHMOUD 11-1-2023 --}}
                                        <h6 class="two">{{$cart->product->translate('sub_title')}}</h6>
                                        @if($cart->getColor())
                                            <p  class="color"> <span class="color_title">colour:</span>  <span class="color_circle" style="background:{{$cart->getColor()}}"></span></p>
                                        @endif
                                    </div>

                                    <!-- <div class="colour_container" style="background:{{$cart->getColor()}}"></div> -->
                                    {{-- <form action="{{route('carts.destroy',['cart'=>$cart->id])}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <div class="btns">
                                            <button type="submit" class="remove-btn">Remove</button>
                                        </div>
                                    </form> --}}
                                </div>
                                <div class="cart-right">


                                 <p class="product_price fs-6">
                                     <del>{{$cart->product()->first()->price * $cart->quantity}} @lang('app.sar')</del>
                                    &nbsp;&nbsp; {{
                                    calculateDiscountForOrder($cart->product()->first()->price,
                                    getPrice($cart->product()->first()->id))  * $cart->quantity}} @lang('app.sar')

                                 </p>
                                   
                                    <!--  start update to add disabled  30/3/2024 -->
                                    <div class="cart-quantity">
                                        @if ($cart->user->organization->max_order_number != 0 || $cart->quantity > 1)
                                            <form action="{{ route('carts.update', ['cart' => $cart->id]) }}"
                                                  method="post">
                                                @method('put')
                                                @csrf
                                                <input type="hidden" value="-" name="type">
                                                <button type="submit"
                                                        class="minus {{ $cart->quantity <= 1 ? 'disabled' : '' }}"> -
                                                </button>
                                            </form>
                                        @endif
                                        <button type="button" class="counter"> {{ $cart->quantity }} </button>

                                        @if ($cart->user->organization->max_order_number != 0)
                                            <form action="{{ route('carts.update', ['cart' => $cart->id]) }}"
                                                  method="post">
                                                @method('put')
                                                @csrf
                                                <input type="hidden" value="+" name="type">
                                                <!--<button type="submit" class="plus {{ $cart->quantity >= $cart->user->organization->max_order_number ? 'disabled' : '' }}"> + </button>-->
                                                <button type="submit"
                                                        class="plus {{ auth()->user()->organization->max_order_number <= auth()->user()->cart()->sum('quantity') ? 'disabled' : '' }}">
                                                    +
                                                </button>
                                            </form>
                                        @endif
                                    </div>
                                    <!--  end update to add disabled  30/3/2024 -->
                                    <form action="{{route('carts.destroy',['cart'=>$cart->id])}}" method="post">
                                        @method('delete')
                                        @csrf
                                        <div class="btns d-flex justify-content-end">
                                            <button type="submit"
                                                    onclick="return confirm('Are you sure to remove the selected item ?')"
                                                    class="remove-btn cart-remove-btn">@lang('app.remove')</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                            {{-- CART ITEM END --}}
                        @endforeach
                        {{-- CART BOTTOM START --}}
                        <div class="cart-item border-bottom-0">
                            @if ($carts->count() > 0 )
                                <div class="cart-bottom">
                                    <a class="back-to-shop-btn"   href="{{\URL::to('/products/all')}}"> Back To Shopping</a>
                                    <!-- <a class="back-to-shop-btn"   href="{{\URL::to('/products/all')}}"> @lang('app.back')</a> -->
                                    <a href="{{route('carts.destroyAll')}}" class="remove-all-btn"
                                       onclick="return confirm('{{ __('app.are_you_sure_need_remove_all') }}')">@lang('app.remove_all')</a>
                                </div>
                            @else
                                <div class="cart-bottom  empty_cart_content">
                                    <img src="{{asset('assets/images/emptyCart.png')}}" alt="no product in cart"
                                         class="empty_cart_img"/>
                                    <!--<p> @lang('app.cart_empty_message')</p>-->
                                    <p><span>Oops ...</span> <br> No products in your cart. Feel free to explore our
                                        products </p>
                                    <!--<hr>-->
                                    <a class="back-to-shop-btn min-w-100px"
                                       href="{{\URL::to('/products/all')}}">@lang('app.continue_shopping')</a>
                                </div>
                            @endif
                        </div>
                        {{-- CART BOTTOM END --}}
                        {{-- CART FEATURES START --}}
                        {{-- <div class="cart-features">
                            <div class="cart-feature">
                                <div class="image">
                                    <img src="{{ asset('assets/images/cart-feature-1.svg') }}" alt="" />
                                </div>
                                <div class="text">
                                    <h4>Secure payment</h4>
                                    <h5>Have you ever finally just</h5>
                                </div>
                            </div>
                            <div class="cart-feature">
                                <div class="image">
                                    <img src="{{ asset('assets/images/cart-feature-2.svg') }}" alt="" />
                                </div>
                                <div class="text">
                                    <h4>Customer support</h4>
                                    <h5>Have you ever finally just</h5>
                                </div>
                            </div>
                            <div class="cart-feature">
                                <div class="image">
                                    <img src="{{ asset('assets/images/cart-feature-3.svg') }}" alt="" />
                                </div>
                                <div class="text">
                                    <h4>Free delivery</h4>
                                    <h5>Have you ever finally just</h5>
                                </div>
                            </div>
                        </div> --}}
                        {{-- CART FEATURES END --}}


                    </div>
                    @if( auth()->user()->cart()->count()>0)

                        <div class="right-section">

                            <h6 class="text-black fz-20px mb-0 fw-bolder">@lang('app.invoice')</h6>
                            <div id="tabby"  class="fw-500 mt-2"></div>
                            <script src="https://checkout.tabby.ai/tabby-promo.js"></script>
                            <script>
                                new TabbyPromo({
                                    selector: '#tabby', // required, content of tabby Promo Snippet will be placed in element with that selector.
                                    currency: 'SAR', // required, currency of your product. AED|SAR|KWD|BHD|QAR only supported, with no spaces or lowercase.
                                    price: '{{number_format((float)$total,2,'.','')}}', // required, price or the product. 2 decimals max for AED|SAR|QAR and 3 decimals max for KWD|BHD.

                                    lang: '{{app()->getLocale()}}', // Optional, language of snippet and popups, if the property is not set, then it is based on the attribute 'lang' of your html tag.
                                    source: 'cart', // Optional, snippet placement; `product` for product page and `cart` for cart page.
                                    publicKey: '{{env('tappyToken')}}' ,// required, store Public Key which identifies your account when communicating with tabby.
                                    merchantCode: 'jawraa'  // required
                                });
                            </script>
                            <div class="tax-section">
                                <div class="fw-500">
                                    @lang('app.price') <span class="fw-normal"> {{$sub_total}} @lang('app.sar')</span>
                                </div>
                                <div class="fw-500">
                                    @lang('app.discount') <span class="fw-normal">{{$discount}} @lang('app.sar')</span>
                                </div>
                                <!--<div class="fw-500">-->
                                <!--@lang('app.delivery_price') <span class="fw-normal"> {{$delivery_price}} @lang('app.sar')</span>-->
                                <!--</div>-->
                                <div class="fw-500">
                                    @lang('app.sub_total') <span
                                        class="fw-normal"> {{$sub_total-$discount}} @lang('app.sar')</span>
                                </div>
                                <div class="fw-500">
                                    @lang('app.vat') <span
                                        class="fw-normal">{{number_format((float)$tax,2,'.','')}} @lang('app.sar')</span>
                                </div>
                            </div>
                            <div class="total-section">
                                <div class="fw-500 fz-20px">
                                    @lang('app.total') <span
                                        class="fw-500">{{number_format((float)$total,2,'.','')}} @lang('app.sar')</span>
                                </div>
                            </div>

                            


                                  <form id="question_terms"   method="post">
                            @csrf
                            <div class="terms_condition_parent">
                                    <input class="form-check-input" type="checkbox" id="acceptTerms" name="accept">
                                    <div class="d-flex flex-column gap-3">
                                        <div>
                                            <label class="form-check-label " for="acceptTerms"> accept terms and condition</label>
                                            <span class="underline" onclick=appearTerms()>Read more  </span>
                                        </div>
                                        <p id="terms_error" class="text-danger m-0"></p>
                                    </div>
                            </div>
                                
                                
                            
  @if(!authUser()->howToKnow()->exists())    
 
                            <div id="pop_up_question">

  <div class="popup-container" id="popupContainer"> 
      <h4>Where did you hear about us?</h4>
      <div id="popupContainer_form">
        <p>
          <input id="Institution" type="radio" name="answer" value="Institution / School">
          <label for="Institution">Institution / School</label>
        </p>
        <p>
          <input id="program" type="radio" name="answer" value="⁠Student Ambassador Program">
         <label for="program"> ⁠Student Ambassador Program</label>
        </p>
        <p>
          <input id="mail" type="radio" name="answer" value="⁠Email">
            <label for="mail">⁠Email</label>
        </p>
        <p>
          <input id="Social" type="radio" name="answer" value="Social Media">
          <label for="Social">Social Media</label>
        </p>
        <p>
          <input id="word" type="radio" name="answer" value="Word of mouth">
            <label for=" word"> Word of mouth</label>
        </p>
    
        <p>
          <input id="other" type="radio" name="answer" value="other">
         <label for="other"> Other</label>
        </p>
        <div class="other-input" style="display: none;">
          <label for="otherText">Please specify: <span class="text-danger">*</span></label>
          <textarea id="otherText" rows="3" class="answer"></textarea>
        </div>
        <p id="answer_validation" class="text-danger"> </p>
        <div class="buttons">
            <button type="submit" class="btn btn-warning d-block m-auto" id="submitButton">send</button>
              <div class="remove remove_question"  id="closeButton"><i class="fa fa-close " style=""></i></div>
        </div>
      </div>
    </div> 
 
                                
                                
                            </div> 
   @endif                             
                                
                                
                                
                            <button type="submit" class="checkout-section border-0" id="openPopup">
                                    <p class="complete_checkout " id="complete_checkout" data-state="">  @lang('app.checkout') </p>
                            </button>
                        </form>
 


                        </div>
                    @endif
                </div>

            </div>


            {{-- <div class="newsletter-section">
                <div class="container">
                    <div class="newsletter-content">
                        <h1>Subscribe to our newsletter</h1>
                        <p>Praesent fringilla erat a lacinia egestas. Donec vehicula tempor libero et <br> cursus. Donec non
                            quam urna. Quisque
                            vitae
                            porta ipsum.</p>
                        <div class="newsletter-input">
                            <input type="email" name="" placeholder="Email Address">
                            <button type="button" class="subscribe">Subscribe <img
                                    src="{{ asset('assets/images/arrow-right.svg') }}" alt="" /></button>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
        {{-- CONTENT END --}}
        @php
            $title     = 'title_'.config('app.locale');
            $sub_title = 'sub_title_'.config('app.locale');
            $content   = 'content_'.config('app.locale');
        @endphp

            <!--start terms  -->
        <div class=" d-none" id="terms_popup">
            <div class="layout "></div>
            <div class="pop_up">
                <div >   <div class="remove mb-1" onclick=removeTerms()><i class="fa fa-close " style=""></i></div>
                    <div class="terms">
                        <div class="terms_body">
                            <div class="terms_header ">
                                <h1>  Terms & Conditions</h1>
                                    <img  src="{{ asset('assets/images/nav-logo.svg') }}" class="icon" alt=""/>
 

                            </div>

                            <div class="body">
                            <p class="lastupdate"> Last Updated :  <span>[{{\Carbon\Carbon::parse(\App\Models\Term::orderBy('updated_at','desc')->value('updated_at'))->format('d/m/Y')}}]</span></p>

                                {!! getTerms() !!}
                            </div>
                        </div>
                      

                    </div>
                </div>

            </div>
        </div>
        <!--end terms  -->

    </div>
    <!-- / script for terms  / -->
    <script src= "{{ asset('assets/js/hearAboutUs.js') }}"></script>
    <script>
        // let checkbox = document.getElementById('acceptTerms');
        // completeCheckoutBtn = document.getElementById('complete_checkout');
        // checkbox.checked ? completeCheckoutBtn.classList.remove('disabled') : completeCheckoutBtn.classList.add('disabled');
        // checkbox.checked ? console.log('remove') : console.log('add');
        // checkbox.addEventListener('click', () => {
        //     checkbox.checked ? completeCheckoutBtn.classList.remove('disabled') : completeCheckoutBtn.classList.add('disabled');
        // })


        let terms_Popup = document.getElementById('terms_popup');

        function appearTerms() {
            terms_popup.classList.remove('d-none')
        }

        // console.log($authUser)
        function removeTerms() {
            terms_popup.classList.add('d-none')
        } 
        const question_terms=document.getElementById('question_terms');
        question_terms.addEventListener('submit',(e)=>{
            e.preventDefault();
            checkRedirect()
        })
        
  var appearAnswerError=false;
        function checkRedirect() {
            
  let answer = $('input[name="answer"]:checked').val();
  let token = $('meta[name="_token"]').attr('content');
  let accept = $('#acceptTerms:checked').val(); 
  let submitButton =document.getElementById('submitButton'); 
    appearTermsError=true;  
    if (<?php echo json_encode(!$authUser); ?>){
        console.log('auth',appearAnswerError) 
              if(appearAnswerError == true){ 
                     if (!answer) { 
                $('#answer_validation').html('Please select an answer.');
                 if (answer =='') { 
                $('#answer_validation').html('Please specify how did you hear about us.'); 
              }
                return;
              } 
              }
        // })
           
    }
  if (!accept) {
    $('#terms_error').html('Please accept the terms.');
    return;
  }
 

  $.ajax({
    headers: {
      'X-CSRF-TOKEN': token
    },
    type: 'POST',
    url: "{{ route('user.accept.terms') }}",
    data: {
      '_token': token,
      'answer': answer,
      'accept': accept
    },
    success: function(data) { 
      if (data.status === 0) { 
        if (data.errorKey === 'answer' &&data.errorKey !== 'accept') {
            appearAnswerError=true;
            console.log('s',appearAnswerError)
        //   $('#answer_validation').html('Please select an answer.');
        }
        if (data.errorKey === 'accept') {
          $('#terms_error').html(data.error);
        }
      } else {
        window.location.replace(data.url);
      }
    }
  });
} 
    </script>
 
@stop
