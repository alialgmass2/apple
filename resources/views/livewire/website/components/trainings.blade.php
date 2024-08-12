<div>

<section class="Customized-learnandbuy mark-background"
        style="background-image: url('{{ $training->getFile() }}')">
        <div class="container">
            <p class="customized_support_text">@lang('app.jawraa_online_training_content')</p>
            <p class="customized_paragraph">{!! nl2br($training->translate('text')) !!}</p>
        </div>
    </section>
    {{-- <section class="Customized-learnandbuy mark-background" style="background-image: url('{{ $training->getFile() }}')">
        <div class="container">
            <p class="customized_support_text">Jawraa's online training content</p>
            <p class="customized_paragraph">{!! nl2br($training->translate('text')) !!}</p>
        </div>
    </section> --}}
</div>
