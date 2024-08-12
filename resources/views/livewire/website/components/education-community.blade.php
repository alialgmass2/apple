<div>
    <section class="JoinTheAppleEducation mark-background"
        style="background-image: url('{{ $educationCommunity->getFile() }}')">
        <div class="container">
            <h2 class="JoinTheAppleEducation_head"> {!! nl2br($educationCommunity->translate('title')) !!}</h2>
            <p class="JoinTheAppleEducation_paragraph--1">{!! nl2br($educationCommunity->translate('text')) !!} </p>

            {{-- <p class="JoinTheAppleEducation_paragraph--2" style="font-size:var(--paragraph1-size-24);font-weight: normal;">{{ $educationCommunity->translate('title') }}</p> --}}
            <a href="{{ $educationCommunity->url }}" target="_blank" class="JoinTheAppleEducation_link"
                style="text-decoration: none; font-size:var(--paragraph-size-28, calc(1.075rem + 0.75vw));">@lang('app.apple_education_community')</a>
        </div>
    </section>
    {{-- OLD --}}
    {{-- <section class="JoinTheAppleEducation mark-background"
        style="background-image: url('{{ asset('assets/images/School Leaders.svg') }}')">
        <div class="container">
            <h2 class="JoinTheAppleEducation_head">
                Join the Apple <br />
                Education Community
            </h2>
            <p class="JoinTheAppleEducation_paragraph--1">{{ nl2br($educationCommunity->translate('text')) }}</p>

            <p class="JoinTheAppleEducation_paragraph--2">{{ $educationCommunity->translate('title') }}</p>
            <a href="{{ $educationCommunity->url }}" target="_blank" class="JoinTheAppleEducation_link">Apple Education Community</a>
        </div>
    </section> --}}
</div>
