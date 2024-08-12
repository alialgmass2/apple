<div>
    <footer class="footer">
        <div>
            <div class="container-custom">
                <div class="footer-content">
                    <div class="footer-logo">
                        <img src="{{ asset('assets/images/logo.svg') }}" alt="logo" class="footer_logo_img"/>
                        <ul class="footer-socialMedia">
                            
                            <li>
                                <a href="https://www.linkedin.com/" target="_blank">
                                    <img src="{{ asset('assets/images/linkedin.png') }}" alt="linkedin"/>
                                </a>
                            </li> 
                            <li>
                                <a href="https://twitter.com/" target="_blank">
                                    <img  src="{{ asset('assets/images/Twitter.png') }}" alt="twitter"/>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/" target="_blank">
                                    <img src="{{ asset('assets/images/instagram.svg') }}" alt="instagram"/>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.facebook.com/" target="_blank">
                                    <img src="{{ asset('assets/images/facebook.svg') }}" alt="facebook"/>
                                </a>
                            </li>
                           
                        </ul>
                    </div>
                    <div class="footer-ContactUs">
                        <p class="footer-title">@lang('app.contact_us_u')</p>
                        <ul>
                            <li>
                                <span>@lang('app.customer_supports') :</span>
                                @if (App::isLocale('ar'))
                                    <p>@lang('app.tel') 0600 525 11 966+</p>
                                    <p>@lang('app.mob') 093 719 552 966+</p>
                                @else
                                    <p>@lang('app.tel') +966 11 525 0600</p>
                                    <p>@lang('app.mob') +966 552 719 093</p>
                                @endif
                            </li>
                            <li>@lang('app.address')</li>
                            <li>edu@jawraa.com</li>
                        </ul>
                    </div>
                    <div class="footer-category">
                        <p class="footer-title">@lang('app.top_categories')</p>
                        <ul>
                            @forelse(\App\Models\Category::where('name_en','!=','All')->get() as $category)
                            <li>     <a href="{{route('products',$category->id)}}"  class="{{ request()->is('products/'.$category->id) ? 'active' : '' }}">{{$category->name_en}}</a></li>
                            @empty
                            @endforelse
                            
                            <li>
                            <a href="{{route('products','all')}}"  class="{{ request()->is('products/all') ? 'active' : '' }}">
                                @lang('app.browse_all_product')
                                    <img src="{{ asset('assets/images/ArrowRight.svg') }}" alt="right" class="ar-arrow"/>
                        </a>      
                      </li>
                            
                        </ul>
                    </div>
                    <div class="footer-QuickLinks">
                        <p class="footer-title">@lang('app.quick_links')</p>
                        <ul>
                            <li><a href="{{ url('/') }}">@lang('app.home')</a></li>
                            <li><a href="{{ route('website.leadership') }}">@lang('app.leadership')</a></li>
                            <li><a href="{{ route('website.educators') }}">@lang('app.educators')</a></li>
                            <li>
                                <a href="{{ route('website.studentsandparents') }}">@lang('app.students_and_parents')</a>
                            </li>
                            <li>
                                <a href="{{ route('website.educationdeployment') }}">@lang('app.education_deployment')</a>
                            </li>
                            <li><a href="{{ route('website.learnandbuy') }}">@lang('app.learn_and_buy')</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="Copyright"> 
                <span>Copyright © 2024 Jawraa Apple Reseller. All rights reserved.</span>
            </div>
        </div>
    </footer>

    @if (!authCheck())
        <x-website.modal :isModalShow="$isModalShow">
            <div class="col-xl-12 col-lg-12">
                <h5 class="text-center mb-4">@lang('app.welcome')</h5>
                <h6 class="text-center">@lang('app.please_choose_your_type')</h6>
                <div class="d-flex justify-content-center  mx-5 mt-4">
                    <a href="{{ route('website.register.student') }}" class="btn-student mb-4">@lang('app.student')</a>
                    <span
                        class="mx-3 mt-1">@lang('app.or')</span>
                    <a href="{{ route('website.register.educator') }}"
                       class="btn-educator mb-4">@lang('app.educator')</a>
                </div>
            </div>
        </x-website.modal>
        <x-website.modal :isModalShow="$isModalShowMailExists">
            <div class="col-xl-12 col-lg-12">
                <h5 class="text-center mb-4 text-red">@lang('app.email_already_exists')</h5>
                <h6 class="text-center">@lang('app.login_to_continue_your_process')</h6>
                <div class="d-flex justify-content-center  mx-5 mt-4">
                    <a href="{{ route('user.login') }}" class="btn-student mb-4">Login</a>
                </div>
            </div>
        </x-website.modal>
    @endif


</div>
