<div>
    <main>
        <x-website.banner-section title="{{ __('app.leadership') }}" :image="$leadershipBanner->getFile()" />
        {{-- <div class="position-relative mark-background">
            <img class="banner_img" src="{{ $leadershipBanner->getFile() }}" alt="@lang('app.alt_image')" />
            <div class="content">
                <p>@lang('app.leadership')</p>
            </div>
        </div> --}}

        <div class="about">
            <div class="container">
                <p class="about-title">{{ $leadershipIntro->translate('title') }}</p>
                <p class="about-desc">{!! nl2br($leadershipIntro->translate('text')) !!}</p>
            </div>
        </div>
    </main>
    {{-- OLD --}}
    {{-- <main>
        <div class="page-header mark-background" style="background-image: url('{{ $leadershipBanner->getFile() }}');">
            <div class="content">
                <p>Leadership</p>
            </div>
        </div>

        <div class="about">
            <div class="container">
                <p class="about-title">{{ $leadershipIntro->translate('title') }}</p>
                <p class="about-desc">{{nl2br($leadershipIntro->translate('text')) }}</p>
            </div>
        </div>
    </main> --}}
</div>
