<div>
    <main>
        <x-website.banner-section title="{!! __('app.learn_and_buy') !!}" :image="$learnBanner->getFile()" />
        {{-- <div class="position-relative mark-background">
            <img class="banner_img" src="{{ $learnBanner->getFile() }}" alt="@lang('app.alt_image')" />
            <div class="content">
                <p>Learn & Buy</p>

            </div>
        </div> --}}

        <x-website.components.yellow-section :data="$training" />

    </main>
    {{-- <main>
        <div class="page-header mark-background" style="background-image: url('{{ $learnBanner->getFile() }}');">
            <div class="content">
                <p>Learn & Buy</p>
            </div>
        </div>
        <div class="about">
            <div class="container">
                <p class="about-title">{{ $learnIntro->translate('title') }}</p>
                <p class="about-desc">{{ $learnIntro->translate('text') }}</p>
            </div>
        </div>
    </main> --}}
</div>
