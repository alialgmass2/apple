<div class="dlabnav">
    <div class="dlabnav-scroll">
        <ul class="metismenu" id="menu">
            {{-- <li class="dropdown header-profile">
                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                    <img src="{{ asset('images/profile/pic1.jpg') }}" width="20" alt="">
                    <div class="header-info ms-3">
                        <span class="font-w600 ">Hi,<b>William</b></span>
                        <small class="text-end font-w400">william@gmail.com</small>
                    </div>
                </a>
                <div class="dropdown-menu dropdown-menu-end">
                    <a href="app-profile.html" class="dropdown-item ai-icon">
                        <svg id="icon-user1" xmlns="http://www.w3.org/2000/svg" class="text-primary" width="18"
                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                            <circle cx="12" cy="7" r="4"></circle>
                        </svg>
                        <span class="ms-2">Profile </span>
                    </a>
                    <a href="email-inbox.html" class="dropdown-item ai-icon">
                        <svg id="icon-inbox" xmlns="http://www.w3.org/2000/svg" class="text-success" width="18"
                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z">
                            </path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <span class="ms-2">Inbox </span>
                    </a>
                    <a href="page-login.html" class="dropdown-item ai-icon">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18"
                            height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                            stroke-linecap="round" stroke-linejoin="round">
                            <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
                            <polyline points="16 17 21 12 16 7"></polyline>
                            <line x1="21" y1="12" x2="9" y2="12"></line>
                        </svg>
                        <span class="ms-2">Logout </span>
                    </a>
                </div>
            </li> --}}
            @role('superAdmin','admin')
            <x-admin.link title="dashboard_menu" href="{{ route('admin.dashboard') }}"
                          :active="Route::is('admin.dashboard')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>


            <x-admin.sidebar-title title="Admin Controls"/>

            <x-admin.link title="regions" href="{{ route('admin.region.index') }}"
                          :active="Route::is('admin.region.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.link title="cities" href="{{ route('admin.city.index') }}" :active="Route::is('admin.city.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.link title="education_level" href="{{ route('admin.educationlevel.index') }}"
                          :active="Route::is('admin.educationlevel.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.link title="users" href="{{ route('admin.user.index') }}" :active="Route::is('admin.user.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.link title="role" href="{{ route('admin.role.index') }}" :active="Route::is('admin.role.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.link title="how-to-know" href="{{ route('admin.how-to-know.index') }}"
                          :active="Route::is('admin.how-to-know.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.sidebar-title title="Organization Management"/>

            <x-admin.link title="organizations" href="{{ route('admin.organization.index') }}"
                          :active="Route::is('admin.organization.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.sidebar-title title="Products Management"/>

            <x-admin.link title="categories" href="{{ route('admin.category.index') }}"
                          :active="Route::is('admin.category.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.link title="sub_categories" href="{{ route('admin.subcategory.index') }}"
                          :active="Route::is('admin.subcategory.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.link title="products" href="{{ route('admin.product.index') }}"
                          :active="Route::is('admin.product.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.link title="colors" href="{{ route('admin.color.index') }}"
                          :active="Route::is('admin.color.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.link title="offer" href="{{ route('admin.offer.index') }}"
                          :active="Route::is('admin.offer.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.link title="organization-offer" href="{{ route('admin.organization-offer.index') }}"
                          :active="Route::is('admin.organization-offer.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.sidebar-title title="Courses Management"/>

            <x-admin.link title="courses" href="{{ route('admin.course.index') }}"
                          :active="Route::is('admin.course.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.sidebar-title title="Contact Forms"/>

            <x-admin.link title="contact" href="{{ route('admin.contact.index') }}"
                          :active="Route::is('admin.contact.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>
            {{--    <x-admin.link title="terms" href="{{ route('admin.terms.index') }}"
                    :active="Route::is('admin.terms.index')">
                    <i class="flaticon-025-dashboard"></i>
                </x-admin.link>   --}}
            <x-admin.link title="book_a_consulation" href="{{ route('admin.bookaconsulation.index') }}"
                          :active="Route::is('admin.bookaconsulation.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>
            <x-admin.link title="itcontactus" href="{{ route('admin.itcontactus.index') }}"
                          :active="Route::is('admin.itcontactus.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>
            {{-- #here --}}
            <x-admin.sidebar-title title="Profile Management"/>
            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Home</span>
                </a>
                <ul aria-expanded="false">

                    <li><a class="{{ Route::is('admin.banner.index') ? 'active' :'' }}"
                           href="{{ route('admin.banner.index') }}">Banner</a></li>
                    <li><a class="{{ Route::is('admin.homeintro.index') ? 'active' :'' }}"
                           href="{{ route('admin.homeintro.index') }}">Section 1</a></li>
                    <li><a class="{{ Route::is('admin.vision.index') ? 'active' :'' }}"
                           href="{{ route('admin.vision.index') }}">Section 2</a></li>
                    <li><a class="{{ Route::is('admin.missionbanner.index') ? 'active' :'' }}"
                           href="{{ route('admin.missionbanner.index') }}">Section 3 Banner</a></li>
                    <li><a class="{{ Route::is('admin.mission.index') ? 'active' :'' }}"
                           href="{{ route('admin.mission.index') }}">Section 3</a></li>
                </ul>

            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Leadership</span>
                </a>
                <ul aria-expanded="false">

                    <li><a class="{{ Route::is('admin.leadershipbanner.index') ? 'active' :'' }}"
                           href="{{ route('admin.leadershipbanner.index') }}">Banner</a></li>
                    <li><a class="{{ Route::is('admin.leadershipintro.index') ? 'active' :'' }}"
                           href="{{ route('admin.leadershipintro.index') }}">Section 1</a></li>
                    <li><a class="{{ Route::is('admin.leadershipourvalue.index') ? 'active' :'' }}"
                           href="{{ route('admin.leadershipourvalue.index') }}">Section 2</a></li>
                    <li><a class="{{ Route::is('admin.customisedsolutionbanner.index') ? 'active' :'' }}"
                           href="{{ route('admin.customisedsolutionbanner.index') }}">Section 3 Banner</a>
                    </li>
                    <li><a class="{{ Route::is('admin.customisedsolution.index') ? 'active' :'' }}"
                           href="{{ route('admin.customisedsolution.index') }}">Section 3</a></li>
                    <li><a class="{{ Route::is('admin.bookconsulation.index') ? 'active' :'' }}"
                           href="{{ route('admin.bookconsultation.index') }}">Section 4</a></li>
                </ul>

            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Educators</span>
                </a>
                <ul aria-expanded="false">

                    <li><a class="{{ Route::is('admin.educatorbanner.index') ? 'active' :'' }}"
                           href="{{ route('admin.educatorbanner.index') }}">Banner</a></li>
                    <li><a class="{{ Route::is('admin.educatorintro.index') ? 'active' :'' }}"
                           href="{{ route('admin.educatorintro.index') }}">Section 1</a></li>
                    <li><a class="{{ Route::is('admin.everyonecode.index') ? 'active' :'' }}"
                           href="{{ route('admin.everyonecode.index') }}">Section 2</a></li>
                    <li><a class="{{ Route::is('admin.everyonecreate.index') ? 'active' :'' }}"
                           href="{{ route('admin.everyonecreate.index') }}">Section 3</a></li>
                    <li><a class="{{ Route::is('admin.educationcommunity.index') ? 'active' :'' }}"
                           href="{{ route('admin.educationcommunity.index') }}">New Section</a></li>
                </ul>

            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Students & Parents</span>
                </a>
                <ul aria-expanded="false">

                    <li><a class="{{ Route::is('admin.studentbanner.index') ? 'active' :'' }}"
                           href="{{ route('admin.studentbanner.index') }}">Banner</a></li>
                    <li><a class="{{ Route::is('admin.studentintro.index') ? 'active' :'' }}"
                           href="{{ route('admin.studentintro.index') }}">Section 1</a></li>
                    <li><a class="{{ Route::is('admin.parental.index') ? 'active' :'' }}"
                           href="{{ route('admin.parental.index') }}">Section 2</a></li>
                    <li><a class="{{ Route::is('admin.parentaltitle.index') ? 'active' :'' }}"
                           href="{{ route('admin.parentaltitle.index') }}">Section 2 Pallts</a></li>
                    <li><a class="{{ Route::is('admin.studentfeature.index') ? 'active' :'' }}"
                           href="{{ route('admin.studentfeature.index') }}">More services</a></li>
                </ul>

            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Education Deployment</span>
                </a>
                <ul aria-expanded="false">

                    <li><a class="{{ Route::is('admin.educationbanner.index') ? 'active' :'' }}"
                           href="{{ route('admin.educationbanner.index') }}">Banner</a></li>
                    <li><a class="{{ Route::is('admin.educationintro.index') ? 'active' :'' }}"
                           href="{{ route('admin.educationintro.index') }}">Section 1</a></li>
                    <li><a class="{{ Route::is('admin.solution.index') ? 'active' :'' }}"
                           href="{{ route('admin.solution.index') }}">Section 2</a></li>
                    <li><a class="{{ Route::is('admin.technical.index') ? 'active' :'' }}"
                           href="{{ route('admin.technical.index') }}">Section 3</a></li>
                    <li><a class="{{ Route::is('admin.service.index') ? 'active' :'' }}"
                           href="{{ route('admin.service.index') }}">Section 4</a></li>
                    <li><a class="{{ Route::is('admin.educationfeature.index') ? 'active' :'' }}"
                           href="{{ route('admin.educationfeature.index') }}">More services</a></li>
                </ul>

            </li>

            <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                    <i class="flaticon-025-dashboard"></i>
                    <span class="nav-text">Learn & Buy</span>
                </a>
                <ul aria-expanded="false">

                    <li><a class="{{ Route::is('admin.learnbanner.index') ? 'active' :'' }}"
                           href="{{ route('admin.learnbanner.index') }}">Banner</a></li>
                    <li><a class="{{ Route::is('admin.training.index') ? 'active' :'' }}"
                           href="{{ route('admin.training.index') }}">Section 1</a></li>
                    <li><a class="{{ Route::is('admin.onlinecourse.index') ? 'active' :'' }}"
                           href="{{ route('admin.onlinecourse.index') }}">Section 2</a></li>
                    <li><a class="{{ Route::is('admin.learnshopnow.index') ? 'active' :'' }}"
                           href="{{ route('admin.learnshopnow.index') }}">Section 3</a></li>
                    {{-- <li><a class="{{ Route::is('admin.learnintro.index') ? 'active' :'' }}"
                            href="{{ route('admin.learnintro.index') }}">Section 3</a></li> --}}
                </ul>

            </li>
            @endrole
            @hasanyrole('superAdmin|orderAdmin','admin')
            <x-admin.sidebar-title title="Orders Management"/>

            <x-admin.link title="orders" href="{{ route('admin.orders.index') }}"
                          :active="Route::is('admin.orders.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>
            {{--            <x-admin.link title="payments" href="{{ route('admin.payments.index') }}"--}}
            {{--                          :active="Route::is('admin.payments.index')">--}}
            {{--                <i class="flaticon-025-dashboard"></i>--}}
            {{--            </x-admin.link>--}}
            @endhasanyrole
            @role('superAdmin','admin')
            <x-admin.sidebar-title title="Terms & Condition"/>
            <x-admin.link title="Terms&ConditionManagement" href="{{ route('admin.terms.index') }}"
                          :active="Route::is('admin.terms.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>
            @endrole
            {{--
            <x-admin.sidebar-title title="Others" /> --}}

            {{--
            <x-admin.link title="discounts" href="{{ route('admin.discount.index') }}"
                :active="Route::is('admin.discount.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link>

            <x-admin.link title="how_to" href="{{ route('admin.howto.index') }}"
                :active="Route::is('admin.howto.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link> --}}


            {{-- <x-admin.link title="order" href="{{ route('admin.order.index') }}"
                :active="Route::is('admin.order.index')">
                <i class="flaticon-025-dashboard"></i>
            </x-admin.link> --}}


        </ul>
        <br>
        <br>
        <br>
        <br>
        <br>
    </div>
</div>
