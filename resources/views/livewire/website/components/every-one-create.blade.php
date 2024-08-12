<div>
    <section class="Customized-Everyone mark-background"
        style="background-image: url('{{ $everyOneCreate->getFile() }}')">
        <div class="container">
            <p class="customized_paragraph">{!! nl2br($everyOneCreate->translate('text')) !!}</p>
            <p class="customized_paragraph font-weight-bold"><a class="text-yellow" target="_blank"
                    href="https://www.apple.com/uk/education/k12/everyone-can-create">@lang('app.find_out')</a> @lang('app.more_about_can_create')
            </p>
            <p class="customized_paragraph font-weight-bold"><a class="text-yellow" target="_blank"
                    href="https://books.apple.com/us/book-series/everyone-can-create/id1364129830">@lang('app.download')</a> @lang('app.more_about_can_create_guide')</p>
        </div>
    </section>
    {{-- OLD --}}
    {{-- <section class="Customized-Everyone mark-background"
        style="background-image: url('{{ $everyOneCreate->getFile() }}')">
        <div class="container">
            <p class="customized_paragraph">{{ nl2br($everyOneCreate->translate('text')) }}</p>
        </div>
    </section>
    <section class="appleProfessional">
        <div class="container">
            <p class="appleProfessional_paragraph">{{ nl2br($everyOneCreate->translate('text_2')) }}</p>
        </div>
    </section> --}}
</div>
