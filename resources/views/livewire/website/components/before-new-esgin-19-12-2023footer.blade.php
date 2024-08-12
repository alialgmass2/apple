<div>
    <div class="footer section-padding">
        <div class="container">
            <div class="row">
                <div class="col-12 col-lg-3">
                    <div>
                        <a class="footer-logo" href="#">
                            <img src="{{ asset('images/logo-white.png') }}" alt="Logo" width="30" height="24"
                                class="d-inline-block align-text-top">
                        </a>
                    </div>
                    <div class="social-links">
                        <img src="{{ asset('images/instagram.png') }}" alt="" />
                        <img src="{{ asset('images/facebook.png') }}" alt="" />
                        <img src="{{ asset('images/twitter.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-12 col-lg-3">
                    <h6 class="fz-16px text-uppercase mb-3 text-white">Contact US</h6>
                    <h6 class="fz-14px footer-grey mb-3">Customer Supports :</h6>
                    <h6 class="fz-14px fz-18px mb-3 text-white">(629) 555-0129</h6>
                    <h6 class="fz-14px fz-18px mb-3 footer-grey-2">4517 Washington Ave. Manchester, Kentucky 39495</h6>
                    <h6 class="fz-14px fz-18px mb-0">info@jawraa.com</h6>
                </div>
                <div class="col-12 col-lg-3">
                    <h6 class="fz-16px text-uppercase mb-3 text-white">Top Categories</h6>
                    <h6 class="fz-14px footer-grey mb-3">iPhone</h6>
                    <h6 class="fz-14px footer-grey mb-3">iPhone</h6>
                    <h6 class="fz-14px footer-grey mb-3">iPhone</h6>
                    <h6 class="fz-14px  mb-3 text-white"><span class="text-primary">---</span> Accessories</h6>
                    <h6 class="fz-14px footer-grey mb-3">Camera & Photo</h6>
                    <h6 class="fz-14px footer-grey mb-3">Tablet</h6>
                    <h6 class="fz-14px text-primary mb-0">Browse All Product -></h6>

                </div>
                <div class="col-12 col-lg-3">

                    <h6 class="fz-16px text-uppercase mb-3 text-white">Quick Links</h6>
                    <h6 class="fz-14px footer-grey mb-3">Home</h6>
                    <h6 class="fz-14px footer-grey mb-3">Leadership</h6>
                    <h6 class="fz-14px footer-grey mb-3">Educator</h6>
                    <h6 class="fz-14px footer-grey mb-3">Student & Parents</h6>
                    <h6 class="fz-14px footer-grey mb-3">Education Deployment</h6>
                    <h6 class="fz-14px footer-grey mb-3">Learn & Buy</h6>
                    @if (authCheck() && authUser()->otp_verified == 1 && authUser()->forgot_password_otp == '')
                    <a href="{{ route('user.dashboard') }}" class="fz-14px footer-grey mb-3 text-decoration-none">Dashboard</a>
                    @endif
                </div>
            </div>
        </div>

    </div>
    <div class="copyrights">
        <div class="container">
            <p class="text-center footer-grey-2">Copyright © 2023 Apple Inc. All rights reserved.</p>
        </div>
    </div>

    @if (!authCheck())
    {{-- MODAL START --}}
    <x-website.modal :isModalShow="$isModalShow">
        <div class="col-xl-12 col-lg-12">
            <h5 class="text-center mb-4">Welcome</h5>
            <h6 class="text-center">Please Choose User Type</h6>
            <div class="d-flex justify-content-center  mx-5 mt-4">
                <a href="{{ route('website.register.student') }}" class="btn-student mb-4">Student</a> <span
                    class="mx-3 mt-1">Or</span>
                <a href="{{ route('website.register.educator') }}" class="btn-educator mb-4">Educator</a>
            </div>
        </div>
    </x-website.modal>
    {{-- MODAL END --}}

    @endif


</div>
