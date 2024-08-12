<div>
    <x-slot name="title">@lang('app.organization') | @lang('app.course')</x-slot>
    <div class="banner-orignization d-flex  align-items-center"
        style="background-image: url({{ $course->getFile('banner') }});">
        <div class="overlay-product-details"></div>
        <div class="container">
            <div class="banner-text only-details-pages">
                <div class="breadcrumb-container product-details-breadcumb">
                    <div class="container ms-0 ar-ms-0">
                        <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);"
                            aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a
                                        href="{{ route('user.organization.organizations') }}"><img
                                            src="{{ asset('assets/images/home.svg') }}" class="icon" alt="@lang('app.alt_image')" />
                                        {{ authUser() != null ? authUser()->organization->translate('name') : ''  }}</a></li>
                                <li class="breadcrumb-item active" aria-current="page">{{ $course->translate('title') }}
                                </li>
                            </ol>
                        </nav>

                    </div>
                </div>
                <h1 class="details-banner-title">{{ $course->translate('title') }}</h1>
                <div class="d-flex flex-column align-items-start justify-content-center gap-3">
                    <div class="estimated-time-container">
                        <div class="estimated-time">
                            <div class="estimated-time-icon">
                                <img src="{{ asset('images/estimated-time.png') }}" alt="@lang('app.alt_image')" />
                            </div>
                            <div class="estimated-time-text">
                                <div>
                                    <span>{{ $course->estimated_time }}</span> @lang('app.hrs') <br>
                                    @lang('app.estimated_time')
                                </div>
                            </div>
                        </div>
                    </div>
                    <a href="javascript:void(0);" class="btn-yellow text-black border-radius-5px">@lang('app.enroll_now')</a>
                </div>

            </div>
        </div>
    </div>

    <x-website.section title="about" color="dark" :data="$course->translate('about')" />
    <x-website.section-with-pallets title="what_will_learn" color="yellow" :data="$course->translate('what_will_learn')" />
    <x-website.section-with-pallets title="content" color="dark" :data="$course->translate('content')" />
    <x-website.section-with-pallets title="requirements" color="yellow" :data="$course->translate('requirements')" />
    <x-website.section title="description" color="dark" :data="$course->translate('description')" />

</div>
