<div>
<section class="customized mark-background"
        style="background-image: url('{{ $customisedSolutionBanner->getFile() }}')">
        <div class="container customized-container">
            <h2 class="customized_head">@lang('app.customised_solutions')</h2>
            <p class="customized_paragraph">{{ $customisedSolution->translate('text') }}</p>
        </div>
    </section>
    {{-- OLD --}}
    {{-- <section class="customized mark-background"
        style="background-image: url('{{ $customisedSolutionBanner->getFile() }}')">
        <div class="container customized-container">
            <h2 class="customized_head">Customised Solutions</h2>
            <p class="customized_paragraph">{{ $customisedSolution->translate('text') }}</p>
        </div>
    </section> --}}
</div>
