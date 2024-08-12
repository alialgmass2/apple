<div>
<main>
<x-website.banner-section title="{{ __('app.educators') }}" :image="$educatorBanner->getFile()" />
    {{-- <div class="position-relative mark-background">
        <img class="banner_img" src="{{ $educatorBanner->getFile() }}" alt="@lang('app.alt_image')" />
        <div class="content">
            <p>Educators</p>
        </div>
    </div> --}}


    <div class="about">
        <div class="container">
            <p class="about-title">{{ $educatorIntro->translate('title') }}</p>
            <p class="about-desc">{!! nl2br($educatorIntro->translate('text')) !!}</p>
        </div>
    </div>
</main>

    {{-- OLD --}}
    {{-- <main>
        <div class="page-header mark-background"
            style="background-image: url('{{ $educatorBanner->getFile() }}');">
            <div class="content">
                <p>Educators</p>
            </div>
        </div>
        <div class="about">
            <div class="container">
                <p class="about-title">{{ $educatorIntro->translate('title') }}</p>
                <p class="about-desc">{{ nl2br($educatorIntro->translate('text')) }}</p>
            </div>
        </div>
    </main> --}}
</div>
