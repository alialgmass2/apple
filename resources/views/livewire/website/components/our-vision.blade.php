<div>
    <section class="vision">
        <div class="container">
            <h2 class="vision_head">@lang('app.our_vision')</h2>
            <p class="vision_paragraph--1">{{ $vision->translate('title') }}</p>

            <p class="vision_paragraph--2">{!! nl2br($vision->translate('text')) !!}gac</p>
        </div>
    </section>
</div>
