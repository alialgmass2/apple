<div>
    <section class="Customized-Support mark-background"
        style="background-image: url('{{ $solution->getFile() }}')">
        <div class="container">
            <h2 class="customized_support_text">@lang('app.customized_it_solutions_and_continuous_support')</h2>
            <p class="customized_paragraph">{!! nl2br($solution->translate('text')) !!}</p>
        </div>
    </section>
    {{-- <section class="Customized-Support mark-background"
        style="background-image: url('{{ $solution->getFile() }}')">
        <div class="container">
            <h2 class="customized_support_text">Customized IT Solutions and Continuous Support</h2>
            <p class="customized_paragraph">{{ nl2br($solution->translate('text')) }}</p>
        </div>
    </section> --}}
</div>
