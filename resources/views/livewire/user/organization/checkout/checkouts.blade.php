<div>
    <div class="breadcrumb-container">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><img src="{{ asset('assets/images/home.svg') }}"
                                class="icon" alt="" />
                            Home</a></li>
                    <li class="breadcrumb-item"><a href="#">
                            Shopping Cart</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Checkout</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="checkout-container">
        <div class="container">
            <h3 class="billing-title">Billing Information</h3>
            <div class="checkout-section">
                <div class="left-section">
                    <div class="top-choices">
                        <div class="top-choices-left">

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                                    value="option1" checked>
                                <label class="form-check-label" for="inlineRadio1">Home address</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                                    value="option2">
                                <label class="form-check-label" for="inlineRadio2">University headquarters</label>
                            </div>

                        </div>

                        <div class="top-choices-right">
                            <a href="javascript:void(0);">Or Add a new address</a>
                        </div>

                    </div>
                    <div class="top-form">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="mb-1">
                                    <label for="exampleFormControlInput1" class="form-label">Username</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput1"
                                        placeholder="First name">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-1">
                                    <label for="exampleFormControlInput2" class="form-label invisable-it">last
                                        name</label>
                                    <input type="email" class="form-control" id="exampleFormControlInput2"
                                        placeholder="Last name">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="exampleFormControlInput3" class="form-label">Company Name <span
                                            class="text-optional">(Optional)</span></label>
                                    <input type="text" class="form-control" id="exampleFormControlInput3"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="mb-1">
                                    <label for="exampleFormControlInput3" class="form-label">Address</label>
                                    <input type="text" class="form-control width-100 m-width-100"
                                        id="exampleFormControlInput3">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-1">
                                    <label for="exampleFormControlInput3" class="form-label">Country</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-1">
                                    <label for="exampleFormControlInput3" class="form-label">Region/State</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-1">
                                    <label for="exampleFormControlInput3" class="form-label">City</label>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected>Select</option>
                                        <option value="1">One</option>
                                        <option value="2">Two</option>
                                        <option value="3">Three</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="mb-1">
                                    <label for="exampleFormControlInput3" class="form-label">Zip Code</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput3"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="exampleFormControlInput3" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput3"
                                        placeholder="">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="exampleFormControlInput3" class="form-label">Phone Number</label>
                                    <input type="text" class="form-control" id="exampleFormControlInput3"
                                        placeholder="">
                                </div>
                            </div>
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
                        <h1>Payment Option</h1>
                        <div class="checkout-options">
                            <div class="checkout-option">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/currency-dollar.svg') }}"
                                        alt="@lang('app.alt')" />
                                </div>
                                <div class="title">
                                    <label class="form-check-label" for="inlineRadio4">VISA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio4" value="option4" checked>
                                </div>
                            </div>
                            <div class="checkout-option">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/currency-dollar.svg') }}"
                                        alt="@lang('app.alt')" />
                                </div>
                                <div class="title">
                                    <label class="form-check-label" for="inlineRadio5">MasterCard</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio5" value="option5">
                                </div>
                            </div>
                            <div class="checkout-option">
                                <div class="icon">
                                    <img src="{{ asset('assets/images/currency-dollar.svg') }}"
                                        alt="@lang('app.alt')" />
                                </div>
                                <div class="title">
                                    <label class="form-check-label" for="inlineRadio6">MADA</label>
                                </div>
                                <div class="form-check">
                                    <input class="form-check-input" type="radio" name="inlineRadioOptions"
                                        id="inlineRadio6" value="option6">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="right-section">
                    <div class="title-section">
                        <h1>Order Summery</h1>
                    </div>
                    <div class="product-section">
                        <div class="product-item">
                            <div class="image">
                                <img src="{{ asset('assets/images/leadership-hero-banner.png') }}" alt="" />
                            </div>
                            <div class="text-section">
                                <p>Canon EOS 1500D DSLR Camera Body+ 18-...</p>
                                <div class="price-section">
                                    3 x <span>250 SAR</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-item">
                            <div class="image">
                                <img src="{{ asset('assets/images/leadership-hero-banner.png') }}" alt="" />
                            </div>
                            <div class="text-section">
                                <p>Canon EOS 1500D DSLR Camera Body+ 18-...</p>
                                <div class="price-section">
                                    3 x <span>250 SAR</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-item">
                            <div class="image">
                                <img src="{{ asset('assets/images/leadership-hero-banner.png') }}" alt="" />
                            </div>
                            <div class="text-section">
                                <p>Canon EOS 1500D DSLR Camera Body+ 18-...</p>
                                <div class="price-section">
                                    3 x <span>250 SAR</span>
                                </div>
                            </div>
                        </div>
                        <div class="product-item">
                            <div class="image">
                                <img src="{{ asset('assets/images/leadership-hero-banner.png') }}" alt="" />
                            </div>
                            <div class="text-section">
                                <p>Canon EOS 1500D DSLR Camera Body+ 18-...</p>
                                <div class="price-section">
                                    3 x <span>250 SAR</span>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="tax-section">
                        <div>
                            Subtotal: <span>1403.97 SAR</span>
                        </div>
                        <div>
                            Discount: <span>-60.00 SAR</span>
                        </div>
                        <div>
                            Tax: <span>+14.00 SAR</span>
                        </div>
                    </div>
                    <div class="total-section">
                        <div>
                            Total: <span>1357.97 SAR</span>
                        </div>
                    </div>
                    <div class="checkout-section">
                        <a href="javascript:void(0);">Confirm <img src="{{ asset('assets/images/arrow-right.svg') }}" alt="" /></a>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
