<div>
    <main>
        <x-website.banner-section title="{!! __('app.education_deployment_2') !!}" :image="$educationBanner->getFile()" />

        {{-- <div class="position-relative mark-background">
            <img class="banner_img" src="{{ $educationBanner->getFile() }}" alt="landing page" />
            <div class="content">
                <p class="education-banner-name">@lang('app.education_deployment')</p>
            </div>
        </div> --}}

        <div class="about">
            <div class="container">
                <p class="about-title">@lang('app.enabling_the_classroom')</p>
                <p class="about-desc">{{ $educationIntro->translate('text') }}</p>

                <a href="https://www.apple.com/uk/education/it" target="_blank" class="button learn-more-in-eduaction-deployment"><span
                        class="show">@lang('app.learn_more')</span>
                </a>

            </div>

        </div>

        {{-- <div class="about">
            <div class="container">
                <p class="about-title">Enabling the classroom</p>
                <p class="about-desc">{{ $educationIntro->translate('text') }} <a class="text-white" target="_blank"
                        href="{{ $educationIntro->url }}">Learn more</a> </p>
                <p class="about-desc">{{ $educationIntro->translate('text_2') }}</p>
            </div>
        </div> --}}
    </main>
    {{-- OLD --}}
    {{-- <main>

        <div class="page-header mark-background" style="background-image: url('{{ $educationBanner->getFile() }}');">
            <div class="content">
                <p>Education Deployment</p>
            </div>
        </div>
        <div class="about">
            <div class="container">
                <p class="about-desc">{{ $educationIntro->translate('text') }}</p>
            </div>
        </div>
    </main> --}}
</div>
