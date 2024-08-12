@extends('checouts.app-organization')
@section('content')
    <style>
        #payment_methods {
            display: none;
        }

        #payment_data {
            display: none;
        }

        input::placeholder {
            color: gray !important;
            font-size: 14px;
        }


    </style>
    <div class="new-container ">
        {{-- BREADCRUMB START --}}
        <div class="breadcrumb-container d-flex flex-column justify-content-start align-items-start">
            <nav
                style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.organization.organizations') }}">
                            <img  src="{{ asset('assets/images/homeblack.svg') }}" class="icon" alt="@lang('app.alt_image')" />
                            <!-- <i class="fa-solid fa-house"></i> -->
                            @lang('app.home')</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('carts.index') }}">@lang('app.shopping_cart')</a></li>
                    <li class="breadcrumb-item active" aria-current="page">@lang('app.checkout')</li>
                </ol>
            </nav>
            <div class="title">
                <h3>@lang('app.billing_information')</h3>
            </div>
        </div>
        {{-- BREADCRUMB END --}}
        {{-- CONTENT START --}}
        <form method="post" action="{{route('checouts.store')}}" >
            @csrf
            <div class="checkout-container">
                <div class="container-xx">
                    <h3 class="billing-title">@lang('app.delivery_options')</h3>
                    <div class="checkout-section">
                        <div class="left-section">
                            <div class="top-choices">
                                <div class="top-choices-left gap-4">
                                      <div class=" form-check-inline">
                                        <input class="form-check-input m-0" type="radio" name="type" id="inlineRadio2"
                                               value="organization" onchange="onChoiseType()" checked {{ old('type') !==null &&
                                        old('type')=='organization' ? 'checked' : '' }}>
                                        <label class="form-check-label" for="inlineRadio2">{{
                                        authUser() != null ? authUser()->organization->translate('name') : '' }}
                                            @lang('app.headquarter') <span class="fw-bold">(Deliver within 24-48 hrs)</span> </label>
                                    </div>

{{--                                     <div class=" form-check-inline">--}}
{{--                                    <input class="form-check-input m-0" type="radio" name="type" id="inlineRadio1"--}}
{{--                                        value="home" onchange="onChoiseType()"   {{ old('type') !==null &&--}}
{{--                                        old('type')=='home' ? 'checked' : '' }}>--}}
{{--                                    <label class="form-check-label" for="inlineRadio1">@lang('app.home_address')</label>--}}
{{--                                    </div>--}}



                                </div>

                                {{-- <div class="top-choices-right">
                                    <a href="javascript:void(0);">Or Add a new address</a>
                                </div> --}}

                            </div>
                            <div class="top-form">
                                <div class="row">
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput1"
                                                   class="form-label">@lang('app.first_name')</label>
                                            <input type="text" placeholder="please enter first name"
                                                   class="form-control" id="exampleFormControlInput1"
                                                   name="fname" value="{{ old('fname') }}">
                                            @error('fname')<span class="text-danger fz-14px mt-1 d-block">@lang('app.please_enter')
                                                @lang('app.first_name')</span> @enderror
                                        </div>

                                    </div>
                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput2"
                                                   class="form-label invisable-it">@lang('app.last_name')</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput2"
                                                   name="lname" placeholder="please enter last name"
                                                   value="{{ old('lname') }}">
                                            @error('lname')<span class="text-danger fz-14px mt-1 d-block">@lang('app.please_enter')
                                                @lang('app.last_name')</span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput3"
                                                   class="form-label">@lang('app.phone_number')</label>


                                            <input type="tel" class="form-control" id="exampleFormControlInput3"
                                                   oninput="validateNumber(event)"  maxlength="10"
                                                   placeholder="05xxxxxxxx" placeholder="05xxxxxxxx"
                                                   name="phone" pattern="05\d{8}" value="{{ old('phone') }}">


                                            @error('phone')<span class="text-danger fz-14px mt-1 d-block">@lang('app.please_enter')
                                                @lang('app.phone')</span>
                                            @enderror
                                        </div>
                                    </div>

                                   <div class="col-lg-4 hide-me-if-type-orgnization">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput4"
                                                   class="form-label">@lang('app.region')</label>
                                            <select class="form-select" aria-label="Default select example" name="state"
                                                    id="region-menu">
                                                <option value="">@lang('app.choose_region')</option>
                                                @foreach($regions as $key=>$value)
                                                    <option value="{{$key}}"
                                                            @if($key==old('state')) selected @endif>{{$value}}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('state')<span class="text-danger fz-14px mt-1 d-block">@lang('app.please_enter')
                                                @lang('app.region')</span>
                                            @enderror
                                        </div>
                                    </div>


                                    <div class="col-lg-4 hide-me-if-type-orgnization">
                                        <div class="mb-3">
                                            <label for="exampleFormControlInput5"
                                                   class="form-label">@lang('app.city')</label>
                                            <select class="form-select" aria-label="Default select example" name="city"
                                                    id="cities-menu" disabled>
                                                <option value="">@lang('app.choose_city')</option>
                                            </select>
                                            {{-- <select class="form-select" aria-label="Default select example" name="city"
                                                value="{{ old('city') }}" id="cities-menu">
                                                @foreach($cities as $key=>$value)

                                                <option value="{{$key}}" @if ($key==old('city')) selected @endif>{{$value}}
                                                </option>
                                                @endforeach
                                            </select> --}}


                                            @error('city')<span class="text-danger fz-14px mt-1 d-block">@lang('app.please_enter')
                                                @lang('app.city')</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-4 hide-me-if-type-orgnization">
                                        <div class="mb-3">

                                            <label for="exampleFormControlInput6"
                                                   class="form-label">@lang('app.distract')</label>
                                            <input type="text" class="form-control width-100 m-width-100"
                                                   id="exampleFormControlInput6" name="distracts"
                                                   placeholder="please enter distruct"
                                                   value="{{ old('distracts') }}">


                                            @error('distracts')<span class="text-danger fz-14px mt-1 d-block">@lang('app.please_enter')
                                                @lang('app.distract')</span> @enderror
                                        </div>
                                    </div>

                                    <div class="col-lg-8"  >
                                        <div class="mb-1">
                                            <label for="exampleFormControlInput7"
                                                   class="form-label">Short National address</label>
                                            <input type="text" class="form-control width-100 m-width-100"
                                                   id="exampleFormControlInput7" name="address"
                                                   value="{{ old('address') }} " placeholder="please enter address">
                                        </div>
                                        @error('address')<span class="text-danger fz-14px mt-1 d-block">@lang('app.please_enter')
                                            @lang('app.address_text')</span>@enderror
                                    </div>
                                    <div class="col-lg-4 hide-me-if-type-orgnization">
                                        <div class="mb-1">
                                            <label for="exampleFormControlInput8"
                                                   class="form-label">@lang('app.short_national_id')</label>
                                            <input type="text" class="form-control width-100 m-width-100"
                                                   id="exampleFormControlInput8" name="short_national_id"
                                                   placeholder="please enter national id "
                                                   value="{{ old('short_national_id') }}">
                                        </div>
                                        @error('short_national_id')<span
                                            class="text-danger fz-14px mt-1 d-block">@lang('app.please_enter')
                                            @lang('app.short_national_id')</span>@enderror
                                    </div>


                                    <div class="col-lg-4 hide-me-if-type-orgnization"  style="opacity:1">
                                        <div class="mb-1">
                                            <label for="exampleFormControlInput9"
                                                   class="form-label">@lang('app.zip_code')</label>
                                            <input type="text" class="form-control" id="exampleFormControlInput9"
                                                   name="zip" value="{{ old('zip') }}"
                                                   placeholder="please enter zip code ">
                                        </div>
                                        @error('zip')<span class="text-danger fz-14px mt-1 d-block">@lang('app.please_enter')
                                            @lang('app.zip_code')</span>@enderror
                                    </div>


                                    {{-- <div class="col-lg-12">
                                        <div class="mb-1">
                                            <label for="exampleFormControlInput3" class="form-label">payment
                                                option </label>
                                            <select class="form-select" aria-label="Default select example"
                                                name="payment_option" id="payment_option" onchange="change_option()">
                                                <option value="cash">cash</option>
                                                <option value="card">card</option>
                                            </select>

                                        </div>
                                    </div> --}}
                                    {{-- <div class="col-lg-12">
                                        <div class="mb-1">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="checkbox" name="inlineRadioOptions"
                                                    id="inlineRadio1" value="option1">
                                                <label class="form-check-label" for="inlineRadio1">Ship into different
                                                    address</label>
                                            </div>
                                        </div>
                                    </div> --}}
                                </div>
                            </div>
                            <div class="checkout-options-container">
                                {{-- <div class="checkout-options-container" id="payment_methods"> --}}
                                <h1 class="">@lang('app.payment_option')</h1>
                                <input type="radio" name="methods" class="radio-method" value="cash" id="ccash"
                                       onchange="change_option(this)" {{ old('methods')=='cash' ? 'checked' : '' }}>
                                <input type="radio" name="methods" class="radio-method" value="tabby" id="ctabby"
                                       onchange="change_option(this)" {{ old('methods')=='tabby' ? 'checked' : '' }}>
                                <input type="radio" name="methods" class="radio-method" value="VISA" id="cvisa"
                                       onchange="change_option(this)" {{ old('methods')=='VISA' ? 'checked' : '' }}>
                                <input type="radio" name="methods" class="radio-method" value="MASTER" id="cmaster"
                                       onchange="change_option(this)" {{ old('methods')=='MASTER' ? 'checked' : '' }}>
                                <input type="radio" name="methods" class="radio-method" value="MADA" id="cmada"
                                       onchange="change_option(this)" {{ old('methods')=='MADA' ? 'checked' : '' }}>

                                <div class="checkout-options">
                                    <!--<label class="checkout-option ccash position-relative" for="ccash"  >-->
                                    <label class="checkout-option ccash position-relative" for=""  style="cursor: not-allowed;opacity:.7">
                                        <div class="icon">
                                            <img style="width:45px" src="{{ asset('assets/images/banknotes.png') }}"
                                                 alt="@lang('app.alt')"/>
                                        </div>
                                        <div class="title">
                                            <label class="form-check-label"
                                                   for="inlineRadio4">@lang('app.cash_on_delivery') <span class="comming_soon"  >Coming Soon</span></label>
                                        </div>
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="radio" name="methods"
                                                id="inlineRadio4" value="cash" onchange="change_option(this);"
                                                @if(old('methods')=='cash' ) checked @endif>
                                        </div> --}}
                                    </label>
                                   <label class="checkout-option ctabby  position-relative" for="ctabby">
                                        <div class="icon">
                                            <img src="{{ asset('assets/images/tabby.png') }}"
                                                 alt="@lang('app.alt')"/>
                                        </div>
                                        <div class="title" >
                                            <label class="form-check-label"   for="inlineRadio4">@lang('app.tabby')
                                            <br>
                                            <span class="noInterest">Pay in 4. No interest, no fees</span>
                                                 <!--<span class="comming_soon"  >Coming Soon</span>-->
                                                 </label>
                                        </div>
                                         <!-- <div class="form-check">
                                            <input class="form-check-input" type="radio" name="methods"
                                                id="inlineRadio4" value="cash" onchange="change_option(this);"
                                                @if(old('methods')=='cash' ) checked @endif>
                                        </div>   -->
                                    </label>
                                    <label class="checkout-option cvisa" for="cvisa">
                                        <div class="icon">
                                            <img src="{{ asset('assets/images/viza.png') }}" alt="@lang('app.alt')"/>
                                        </div>
                                        <div class="title">
                                            <label class="form-check-label" for="inlineRadio4">@lang('app.visa')</label>
                                        </div>
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="radio" name="methods"
                                                id="inlineRadio4" value="VISA" onchange="change_option(this);"
                                                @if(old('methods')=='VISA' ) checked @endif>
                                        </div> --}}
                                    </label>
                                    <label class="checkout-option cmaster" for="cmaster">
                                        <div class="icon">
                                            <img src="{{ asset('assets/images/mastercard.png') }}"
                                                 alt="@lang('app.alt')"/>
                                        </div>
                                        <div class="title">
                                            <label class="form-check-label"
                                                   for="inlineRadio5">@lang('app.master_card')</label>
                                        </div>
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="radio" name="methods"
                                                id="inlineRadio5" value="MASTER" onchange="change_option(this);"
                                                @if(old('methods')=='MASTER' ) checked @endif>
                                        </div> --}}
                                    </label>
                                    <label class="checkout-option cmada" for="cmada">
                                        <div class="icon">
                                            <img src="{{ asset('assets/images/1200px-Mada_Logo.svg.png') }}"
                                                 alt="@lang('app.alt')"/>
                                        </div>
                                        <div class="title">
                                            <label class="form-check-label" for="inlineRadio6">@lang('app.mada')</label>
                                        </div>
                                        {{-- <div class="form-check">
                                            <input class="form-check-input" type="radio" name="methods"
                                                id="inlineRadio6" value="MADA" onchange="change_option(this);"
                                                @if(old('methods')=='MADA' ) checked @endif>
                                        </div> --}}
                                    </label>

                                </div>

                                <!-- backend,please replace  -->
                                @error('methods')<span
                                    class="text-danger fz-14px mt-1 d-block">
                                             Please check payment option
                                             </span>@enderror


                            </div>

                            <div class="top-form" id="payment_data">
                                <div class="row">
                                    <!--<div class="col-lg-3">-->
                                    <!--    <div class="mb-1">-->
                                    <!--        <label for="exampleFormControlInput10"-->
                                    <!--            class="form-label">@lang('app.card_number')</label>-->
                                    <!--        <input type="text" class="form-control" id="exampleFormControlInput10"-->
                                    <!--            placeholder="" name="card_number" value="{{ old('card_number') }}"-->
                                    <!--            size="16" maxlength="16">-->
                                    <!--    </div>-->

                                    <!--    @error('card_number')<span class="text-danger fz-14px">@lang('app.please_enter')-->
                                    <!--        @lang('app.card_number')</span>@enderror-->
                                    <!--</div>-->
                                    <!--<div class="col-lg-2">-->
                                    <!--    <div class="mb-1">-->
                                    <!--        <label for="exampleFormControlInput11"-->
                                    <!--            class="form-label">@lang('app.expiry_month')</label>-->
                                    <!--        <select name="expiryMonth" class='form-control'>-->

                                    <!--            @for($x=1;$x<13;$x=$x+1) <option value="{{$x}}"-->
                                    <!--                @if(old('expiryMonth')==$x)
                                        selected
                                    @endif>{{$x}}</option>-->

                                    <!--                @endfor-->
                                    <!--        </select>-->
                                    <!--    </div>-->
                                    <!--</div>-->
                                    <!--<div class="col-lg-2">-->
                                    <!--    <div class="mb-1">-->
                                    <!--        <label for="exampleFormControlInput12"-->
                                    <!--            class="form-label">@lang('app.expiry_year')</label>-->
                                    <!--        <select name="expiryYear" class='form-control'>-->
                                    <!--            <option value="2024" @if (2024==old('expiryYear'))
                                        selected
                                    @endif>2024-->
                                    <!--            </option>-->
                                    <!--            <option value="2025" @if (2025==old('expiryYear'))
                                        selected
                                    @endif>2025-->
                                    <!--            </option>-->
                                    <!--            <option value="2026" @if (2026==old('expiryYear'))
                                        selected
                                    @endif>2026-->
                                    <!--            </option>-->
                                    <!--            <option value="2027" @if (2027==old('expiryYear'))
                                        selected
                                    @endif>2027-->
                                    <!--            </option>-->
                                    <!--            <option value="2028" @if (2028==old('expiryYear'))
                                        selected
                                    @endif>2028-->
                                    <!--            </option>-->
                                    <!--            <option value="2029" @if (2029==old('expiryYear'))
                                        selected
                                    @endif>2029-->
                                    <!--            </option>-->
                                    <!--            <option value="2030" @if (2030==old('expiryYear'))
                                        selected
                                    @endif>2030-->
                                    <!--            </option>-->
                                    <!--            <option value="2031" @if (2031==old('expiryYear'))
                                        selected
                                    @endif>2031-->
                                    <!--            </option>-->
                                    <!--            <option value="2032" @if (2032==old('expiryYear'))
                                        selected
                                    @endif>2032-->
                                    <!--            </option>-->
                                    <!--            <option value="2033" @if (2033==old('expiryYear'))
                                        selected
                                    @endif>2033-->
                                    <!--            </option>-->
                                    <!--            <option value="2034" @if (2034==old('expiryYear'))
                                        selected
                                    @endif>2034-->
                                    <!--            </option>-->
                                    <!--        </select>-->
                                    <!--    </div>-->
                                    <!--    @error('expiryYear')<span class="text-danger fz-14px">@lang('app.please_enter')-->
                                    <!--        @lang('app.expiry_year')</span>@enderror-->
                                    <!--    {{-- <div class="mb-1">-->
                                    <!--        <label for="exampleFormControlInput3" class="form-label">expiry Year</label>-->
                                    <!--        <input type="text" class="form-control" id="exampleFormControlInput3"-->
                                    <!--            placeholder="" name="expiryYear">-->
                                    <!--        @error('expiryYear')<span class="text-danger fz-14px">please enter-->
                                    <!--            expiryYear</span>@enderror-->
                                    <!--    </div> --}}-->
                                    <!--</div>-->
                                    <!--<div class="col-lg-2">-->
                                    <!--    <div class="mb-1">-->
                                    <!--        <label for="exampleFormControlInput14" class="form-label">Cvv</label>-->
                                    <!--        <input type="text" class="form-control" id="exampleFormControlInput14"-->
                                    <!--            placeholder="" name="cvv" size="4" maxlength="4"-->
                                    <!--            value="{{ old('cvv') }}">-->
                                    <!--    </div>-->
                                    <!--    @error('cvv')<span class="text-danger fz-14px"><span-->
                                    <!--            class="text-danger fz-14px">@lang('app.enter')-->
                                    <!--            @lang('app.cvv')</span></span>@enderror-->
                                    <!--</div>-->
                                    <!--<div class="col-lg-3">-->
                                    <!--    <div class="mb-1">-->
                                    <!--        <label for="exampleFormControlInput15"-->
                                    <!--            class="form-label">@lang('app.holder_name')</label>-->
                                    <!--        <input type="text" class="form-control" id="exampleFormControlInput15"-->
                                    <!--            placeholder="" name="holder_name" value="{{ old('holder_name') }}">-->
                                    <!--    </div>-->
                                    <!--    @error('holder_name')<span class="text-danger fz-14px">@lang('app.please_enter')-->
                                    <!--        @lang('app.placeholder_name')</span>@enderror-->
                                    <!--</div>-->
                                </div>
                            </div>
                        </div>
                        <div class="right-section">
                            <div class="title-section">
                                <h1>@lang('app.order_summery')</h1>
                            </div>
                            {{-- ('sub_total','discount','tax','total','products_arr')--}}
                            <div class="product-section">

                                @foreach($products_arr as $product)
                                    <div class="product-item">

                                        <div class="image">
                                            <img src="{{ $product['image'] }}"
                                                 alt="@lang('app.alt_image')"/>
                                        </div>
                                        <div class="text-section">
                                            <div class="price-section">
                                                {{$product['title']}}
                                            </div>
                                            <div class="price-section">
                                                {{$product['quantity']}} @if (App::isLocale('en'))
                                                    x
                                                @endif <span>
                                                {{$product['amount']/$product['quantity']}} @lang('app.sar')</span>
                                            </div>
                                            @if(isset($product['color_code']))
                                                <p  class="color"> <span class="color_title">colour:</span>  <span class="color_circle" style="background:{{$product['color_code']}}"></span></p>
                                                @endif
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                            <div class="tax-section">
                                <div class="fw-500">
                                    @lang('app.product_price') <span class="fw-normal"> {{number_format((float)($sub_total-$delivery_price), 2, '.', '')}}
                                        @lang('app.sar')</span>
                                </div>
                                <div class="fw-500">
                                    @lang('app.discount') <span
                                        class="fw-normal">{{number_format((float)$discount, 2, '.', '')}}  @lang('app.sar')</span>
                                </div>
                                <!--{{ old('type') }}  // removed by fatma 15/3/2024-->
                                <!--@if (old('type') != 'organization')-->
                                <div class="fw-500" id="hide-delvery-price">
                                    @lang('app.delivery_cost') <span class="fw-normal"
                                                                     data-deivery="{{$delivery_price}}"
                                                                     id="delivery-price-result"> {{$delivery_price}} @lang('app.sar')</span>
                                </div>
                                <!--@endif-->
                                <div class="fw-500">
                                    @lang('app.sub_total') <span id="sub_total"
                                                                 class="fw-normal"> {{number_format((float)($sub_total-$discount), 2, '.', '')}} @lang('app.sar')</span>
                                </div>
                                <div class="fw-500">
                                    @lang('app.vat') <span id="tax" class="fw-normal">{{$tax}} @lang('app.sar')</span>
                                </div>
                            </div>
                            <div class="total-section">
                                <div class="fz-20px">
                                    @lang('app.total') <span id="total"
                                                             data-total="{{ number_format((float)$total, 2, '.', '')}}">{{number_format((float)$total, 2, '.', '')}} @lang('app.sar')</span>
                                </div>
                            </div>

                            <div class="checkout-sectionx">
                                <button type="submit" class="checkout-button">@lang('app.confirm') </button>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
    </form>
    {{-- CONTENT END --}}
    </div>
    {{-- <div> --}}
    {{-- <div class="breadcrumb-container">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ route('user.organization.organizations') }}"><img
                                src="{{ asset('assets/images/home.svg') }}" class="icon" alt="" />
                            Home</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('carts.index') }}">
                            Shopping Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
            <div class="title">
                <h3>Billing Information</h3>
            </div>
        </div>
    </div> --}}
    {{-- @if ($errors->any())--}}
    {{-- <div class="alert alert-danger">--}}
    {{-- <ul>--}}
    {{-- @foreach ($errors->all() as $error)--}}
    {{-- <li>{{ $error }}</li>--}}
    {{-- @endforeach--}}
    {{-- </ul>--}}
    {{-- </div>--}}
    {{-- @endif--}}

    {{-- </div> --}}
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>


    <!--//fatma 15/3/2024-->
    <script>
        //fatma 15/3/2024
        var hideDelveryPrice = document.getElementById('hide-delvery-price');
        var allElementsWillHide = document.querySelectorAll('.hide-me-if-type-orgnization');
        var address = document.getElementById('exampleFormControlInput7');

        function hideElements() {
            allElementsWillHide.forEach(e => e.style.display = "none")
            if (hideDelveryPrice) // it remove when send from organization why???
                hideDelveryPrice.style.display = 'none';
        }

        function showElements() {
            allElementsWillHide.forEach(e => e.style.display = "block");
            if (hideDelveryPrice) // it remove when send from organization why???
                hideDelveryPrice.style.display = 'flex';

        }

        function disableAddress() {
            address.value = "{{auth()->user()->organization->address ?? ' r4tgr' }}";
            address.disabled = true;
        }

        function enableAddress() {
            address.value = '';
            address.disabled = false;
        }

        window.addEventListener("load", (event) => {
            onChoiseType();  //fatma
            // var oldType="{{ old('type') }}";
            // if (oldType == 'organization') {
            //     hideElements();
            //     disableAddress();
            // }else {
            //     showElements();
            //     enableAddress();
            // }

            // DEPEND ON MENU
            let citiesMenu;
            let oldRegion = "{{ old('state') }}"
            let oldCity = "{{ old('city') }}"
            console.log("oldCity =======================", oldCity);
            dependOnMenu(oldRegion);

            // save state on validation
            function dependOnMenu(id) {
                axios.get(`/user/citiesbyregion/${id}`).then(res => {
                    citiesMenu = document.getElementById('cities-menu');
                    citiesMenu.innerHTML = "";
                    let cities = res.data;

                    citiesMenu.disabled = false;
                    citiesMenu.innerHTML += '<option value="">{{ __('app.choose_city') }}</option>';
                    cities.forEach(value => {
                        citiesMenu.innerHTML += `<option value="${value.id}" ${value.id == oldCity ? 'selected' : ''}>${value.text}</option>`;
                    });

                }).catch(
                    err => {
                        citiesMenu.innerHTML = "";
                        dependOnMenu(id);
                        console.log(err)
                    }
                )

            }


            let regionMenu = document.getElementById('region-menu');
            regionMenu.addEventListener('change', (e) => {
                let regionId = e.target.value;
                dependOnMenu(regionId);
            });
        });
        let payment_data = document.getElementById('payment_data');
        let payment_methods = document.getElementById('payment_methods');
        let payment_option = document.getElementById('payment_option');
        let old = "{{ old('methods') }}";
        if (old === 'cash') {
            console.log('will show cash only');
        } else if (old === 'VISA') {
            payment_data.style['display'] = 'block';
        } else if (old === 'MASTER') {
            payment_data.style['display'] = 'block';
        } else if (old === 'MADA') {
            payment_data.style['display'] = 'block';
        }


        function change_option(src) {
            // console.log(src.value);
            let payment_data = document.getElementById('payment_data');
            let payment_methods = document.getElementById('payment_methods');
            let payment_option = document.getElementById('payment_option');

            console.log(src.value);
            if (src.value === 'cash') {
                payment_data.style['display'] = 'none';
            } else {
                payment_data.style['display'] = 'block';

            }
        }


        function validateNumber(event) {
    const input = event.target;
    let sanitizedValue = input.value.replace(/\D/g, ''); // Remove all non-numeric characters

    // Check if the first digit is '0' and the second digit is '5'
    if (sanitizedValue.length === 1 && sanitizedValue !== '0') {
        sanitizedValue = '';
    } else if (sanitizedValue.length === 2 && sanitizedValue !== '05') {
        sanitizedValue = '0';
    }
    input.value = sanitizedValue;
}
        function onChoiseType() {
            var inlineRadio2 = document.getElementById('inlineRadio2').checked;
            let totalResult = document.getElementById('total');
            let subtotal = document.getElementById('sub_total');
            let tax = document.getElementById('tax');
            let deliveryPriceResult = document.getElementById('delivery-price-result');
            if (inlineRadio2) {
                // var resultFinal =Number((totalResult.dataset.total - deliveryPriceResult.dataset.deivery).toFixed(2));  // problem due to deivery not found in organization
                let resultFinal = Number(totalResult.dataset.total);  // solve problem
                //number_format((float)$discount, 2, '.', '')
                subtotal.innerHTML = parseFloat({{ number_format((float)$sub_total - $discount - $delivery_price, 2, '.', '') }}).toFixed(2) + ' SAR';
                tax.innerHTML = parseFloat({{ number_format((float)($sub_total - $discount - $delivery_price) * 15 / 100, 2, '.', '') }}).toFixed(2) + ' SAR';
                totalResult.innerHTML = parseFloat({{ number_format((float)($sub_total - $discount - $delivery_price) + ($sub_total - $discount - $delivery_price) * 15 / 100, 2, '.', '') }}).toFixed(2) + ' SAR';
                console.log({{number_format((float)($sub_total-$discount-$delivery_price)+ ($sub_total-$discount-$delivery_price)*15/100,3,'.','')}});

                hideElements();
                disableAddress();
            } else {
                showElements();
                subtotal.innerHTML = {{number_format($sub_total-$discount,2,'.','')}} + ' SAR';
                tax.innerHTML = {{number_format($tax,2,'.','')}} + ' SAR';
                totalResult.innerHTML = {{number_format($total,2,'.','')}} + ' SAR';
                enableAddress();
            }
        }
    </script>

@stop
