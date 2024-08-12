<div>
    <section class="Technical-Consultation mark-background"
        style="background-image: url('{{ $technical->getFile() }}')">
        <div class="container">
            <h2 class="customized_technical_text">{!! __('app.technical_consultation_and_planning') !!}</h2>
            <p class="customized_paragraph">{!! nl2br($technical->translate('text')) !!}</p>
        </div>
    </section>
    {{-- <section class="Technical-Consultation mark-background"
        style="background-image: url('{{ $technical->getFile() }}')">
        <div class="container">
            <h2 class="customized_technical_text">Technical <br> Consultation and Planning</h2>
            <p class="customized_paragraph">{{ nl2br($technical->translate('text')) }}</p>
        </div>
    </section> --}}
</div>
