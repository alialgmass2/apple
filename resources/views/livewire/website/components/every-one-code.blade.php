<div>
    <div class="cards_code">
        <div class="container">
            <div class="cards_code-header">
                <h3>@lang('app.everyone_can_code')</h3>
            </div>
            <div class="cards_code-cards">
                @forelse ($everyOneCodes as $everyOneCode)
                <div class="cards_code-card">
                    <div class="cards_code-card_img-2">
                        <img src="{{ $everyOneCode->getFile() }}" alt="@lang('app.alt_image')" srcset="">
                    </div>
                    <div class="cards_code-card_text">
                        <p> {{ $everyOneCode->translate('text') }} <a target="_blank" class="text-yellow"
                                href="{{ $everyOneCode->url }}">@lang('app.find_out_more')</a></p>
                    </div>
                </div>
                @empty

                @endforelse


            </div>
            <div class="cards_code-header">
                <h3>@lang('app.everyone_can_create')</h3>
            </div>
        </div>
    </div>
    {{-- OLD --}}
    {{-- <div class="cards_code">
        <div class="container">
            <div class="cards_code-header">
                <h3>Every One Can Code</h3>
            </div>
            <div class="cards_code-cards">
                @forelse ($everyOneCodes as $everyOneCode)
                <div class="cards_code-card">
                    <div class="cards_code-card_img-1">
                        <img src="{{ $everyOneCode->getFile() }}" alt="" srcset="">
                    </div>
                    <div class="cards_code-card_text">
                        <p>{{ $everyOneCode->translate('text') }}</p>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
            <div class="cards_code-header">
                <h3>Every One Can Create</h3>
            </div>
        </div>
    </div> --}}
</div>
