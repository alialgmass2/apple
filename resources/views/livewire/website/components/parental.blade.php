<div>
    <section class="parentalAwareness mark-background" style="background-image: url('{{ $parental->getFile() }}')">
        <div class="container">
            <h2 class="parentalAwareness_head">@lang('app.parental_awareness_workshop')</h2>
            <p class="parentalAwareness_paragraph">{!! nl2br($parental->translate('text')) !!}</p>
            <ul class="parentalAwareness_list">
                @forelse ($parentalTitles as $parentalTitle)
                <li>{{ $parentalTitle->translate('title') }}</li>
                @empty

                @endforelse
            </ul>
        </div>
    </section>
    {{-- OLD --}}
    {{-- <section class="parentalAwareness mark-background" style="background-image: url('{{ $parental->getFile() }}')">
        <div class="container">
            <h2 class="parentalAwareness_head">Parental Awareness Worshop</h2>
            <p class="parentalAwareness_paragraph">{{ nl2br($parental->translate('text')) }}</p>
            <ul class="parentalAwareness_list">
                @forelse ($parentalTitles as $parentalTitle)
                <li>{{ $parentalTitle->translate('title') }}</li>
                @empty

                @endforelse
            </ul>
        </div>
    </section> --}}
</div>
