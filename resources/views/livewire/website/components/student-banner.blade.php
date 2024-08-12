<div>
<main>

        <x-website.banner-section title="{{ __('app.students_and_parents') }}" :image="$studentBanner->getFile()" />

        {{-- <div class="position-relative mark-background">
            <img class="banner_img" src="{{ $studentBanner->getFile() }}" alt="@lang('app.alt_image')" />
            <div class="content">
                <p>Students & Parents</p>
            </div>
        </div> --}}

        <div class="about">
            <div class="container">
                <p class="about-title">{{ $studentIntro->translate('title') }}</p>
                <p class="about-desc">{!! nl2br($studentIntro->translate('text')) !!}</p>
            </div>
        </div>
    </main>

    {{-- OLD --}}
    {{-- <main>
        <div class="page-header mark-background"
            style="background-image: url('{{ $studentBanner->getFile() }}');">
            <div class="content">
                <p>Students</p>
            </div>
        </div>
        <div class="about">
            <div class="container">
                <p class="about-title">{{ $studentIntro->translate('title') }}</p>
                <p class="about-desc">{{ nl2br($studentIntro->translate('text')) }}</p>
            </div>
        </div>
    </main> --}}
</div>
