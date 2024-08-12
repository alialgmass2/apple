<div>
    <main>
        <div class="position-relative page_banner" style="background-image:url('{{ $banner->getFile() }}')">
            <!--<img class="banner_img" src="{{ $banner->getFile() }}" alt="landing page" />-->
            <div class="content home-banner-content" >
                <p class="home-landing-page">@lang('app.welcome_to')</p>
                <div class="logo">
                    <img src="{{ asset('assets/images/Authorised_Reseller_blk_2ln_UK 4.svg') }}" alt="" srcset="">
                </div>
            </div>
        </div>

        <div class="about">
            <div class="container">
                <p class="about-title">{{ $homeIntro->translate('title') }}</p>
                <p class="about-desc">{{ $homeIntro->translate('text') }}</p>
            </div>
        </div>

    </main>




</div>
