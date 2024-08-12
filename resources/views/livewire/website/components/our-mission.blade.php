<div>
    <section class="mission mark-background" style="background-image: url('{{ $missionBanner->getFile() }}')">
        <div class="container">
            <h2 class="mission_head">@lang('app.our_mission')</h2>
            <div class="mission_boxes">
                @forelse ($missions as $mission)
                <div class="mission_box  ">
                    <img class="mission_box-img" src="{{ $mission->getFile() }}" alt="@lang('app.alt_image')" />

                    <div>
                        <h4 class="mission_box-head">{{ $mission->translate('title') }}</h4>
                        <p class="mission_box-description">{!! nl2br($mission->translate('text')) !!}</p>
                    </div>
                </div>
                @empty

                @endforelse
            </div>
        </div>
    </section>

</div>
