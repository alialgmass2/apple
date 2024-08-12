<div>
    <div class="breadcrumb-container">
        <div class="container">
            <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="#"><img src="{{ asset('assets/images/home.svg') }}"
                                class="icon" alt="" />
                            Home</a></li>
                    <li class="breadcrumb-item active" aria-current="page">Shopping Cart</li>
                </ol>
            </nav>
        </div>
    </div>
    <div class="cart-items-container">
        <div class="container">
            <h3 class="fz-24px">My Cart (3)</h3>
            <div class="cart-items">
                <div class="left-section">
                    {{-- CART ITEM START --}}
                    <div class="cart-item">
                        <div class="cart-left">
                            <img src="{{ asset('images/avatar.jpg') }}" alt="" />
                        </div>
                        <div class="middle-section">
                            <div class="title">
                                <h6 class="one">iPhone 15 pro max</h6>
                                <h6 class="two">256 GB 4 Ram 2023 three cammera</h6>
                            </div>
                            <div class="btns">
                                <button type="button" class="remove-btn">Remove</button>
                                <button type="button" class="save-for-leter-btn">Save for later</button>
                            </div>
                        </div>
                        <div class="cart-right">
                            <p class="price">78.99 SAR</p>
                            <div class="cart-quantity">
                                <button type="button" class="minus">
                                    <img src="{{ asset('assets/images/minus.svg') }}" alt="" />
                                </button>
                                <button type="button" class="counter"> 01 </button>
                                <button type="button" class="plus">
                                    <img src="{{ asset('assets/images/plus.svg') }}" alt="" />
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- CART ITEM END --}}
                    {{-- CART ITEM START --}}
                    <div class="cart-item">
                        <div class="cart-left">
                            <img src="{{ asset('images/avatar.jpg') }}" alt="" />
                        </div>
                        <div class="middle-section">
                            <div class="title">
                                <h6 class="one">iPhone 15 pro max</h6>
                                <h6 class="two">256 GB 4 Ram 2023 three cammera</h6>
                            </div>
                            <div class="btns">
                                <button type="button" class="remove-btn">Remove</button>
                                <button type="button" class="save-for-leter-btn">Save for later</button>
                            </div>
                        </div>
                        <div class="cart-right">
                            <p class="price">78.99 SAR</p>
                            <div class="cart-quantity">
                                <button type="button" class="minus">
                                    <img src="{{ asset('assets/images/minus.svg') }}" alt="" />
                                </button>
                                <button type="button" class="counter"> 01 </button>
                                <button type="button" class="plus">
                                    <img src="{{ asset('assets/images/plus.svg') }}" alt="" />
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- CART ITEM END --}}
                    {{-- CART ITEM START --}}
                    <div class="cart-item">
                        <div class="cart-left">
                            <img src="{{ asset('images/avatar.jpg') }}" alt="" />
                        </div>
                        <div class="middle-section">
                            <div class="title">
                                <h6 class="one">iPhone 15 pro max</h6>
                                <h6 class="two">256 GB 4 Ram 2023 three cammera</h6>
                            </div>
                            <div class="btns">
                                <button type="button" class="remove-btn">Remove</button>
                                <button type="button" class="save-for-leter-btn">Save for later</button>
                            </div>
                        </div>
                        <div class="cart-right">
                            <p class="price">78.99 SAR</p>
                            <div class="cart-quantity">
                                <button type="button" class="minus">
                                    <img src="{{ asset('assets/images/minus.svg') }}" alt="" />
                                </button>
                                <button type="button" class="counter"> 01 </button>
                                <button type="button" class="plus">
                                    <img src="{{ asset('assets/images/plus.svg') }}" alt="" />
                                </button>
                            </div>
                        </div>
                    </div>
                    {{-- CART ITEM END --}}
                    {{-- CART BOTTOM START --}}
                    <div class="cart-item border-bottom-0">
                        <div class="cart-bottom">
                            <button type="button" class="back-to-shop-btn"> <img
                                    src="{{ asset('assets/images/arrow-left.svg') }}" alt="" /> Back to shop</button>
                            <button type="button" class="remove-all-btn">Remove all</button>
                        </div>
                    </div>
                    {{-- CART BOTTOM END --}}
                    {{-- CART FEATURES START --}}
                    <div class="cart-features">
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
                    </div>
                    {{-- CART FEATURES END --}}


                </div>
                <div class="right-section">
                    <div class="coupon-section">
                        <div class="title">
                            <h1>Have a Coupon?</h1>
                        </div>
                        <div class="inputs">
                            <input type="text" class="form-scontrol" name="" placeholder="Add coupon">
                        </div>
                        <div class="btn">
                            <button type="button">Apply Coupon</button>
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
                        <a href="javascript:void(0);">Checkout</a>
                    </div>
                    <div class="brands-section">
                        <img src="{{ asset('assets/images/payment.svg') }}" alt="" />
                        <img src="{{ asset('assets/images/payment-1.svg') }}" alt="" />
                        <img src="{{ asset('assets/images/payment-2.svg') }}" alt="" />
                        <img src="{{ asset('assets/images/payment-3.svg') }}" alt="" />
                        <img src="{{ asset('assets/images/payment-4.svg') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
        <div class="newsletter-section">
            <div class="container">
               <div class="newsletter-content">
                <h1>Subscribe to our newsletter</h1>
                <p>Praesent fringilla erat a lacinia egestas. Donec vehicula tempor libero et <br> cursus. Donec non quam urna. Quisque
                    vitae
                    porta ipsum.</p>
                    <div class="newsletter-input">
                        <input type="email" name="" placeholder="Email Address">
                        <button type="button" class="subscribe">Subscribe <img src="{{ asset('assets/images/arrow-right.svg') }}" alt="" /></button>
                    </div>
               </div>
            </div>
        </div>
    </div>

</div>
