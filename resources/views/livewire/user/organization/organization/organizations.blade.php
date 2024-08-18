<div>
    @php
        use Carbon\Carbon;
        $offers = auth()->user()->organization->offers()
            ->with('offer')
            ->whereHas('offer', function ($query) {
                $now = Carbon::now();
                $query->where([
                    ['start_date', '<=', $now],
                    ['end_date', '>=', $now],
                    ['status', 1]
                ]);
            })
            ->get();
        $slideIndex = 0;
    @endphp

    <x-slot name="title">Organizations</x-slot>

    <div class="banner-orignization" style="height: 800px; min-height: 105vh;">
        <div id="carouselExampleInterval" data-bs-ride="carousel" class="carousel slide h-100">
            <div class="carousel-indicators">
                @if($offers->count() > 1)
                    @foreach($offers as $key => $offer)
                        <button type="button" data-bs-target="#carouselExampleInterval" data-bs-slide-to="{{ $slideIndex }}"
                                class="{{ $slideIndex == 0 ? 'active' : '' }} custom_indicators"
                                aria-current="{{ $slideIndex == 0 ? 'true' : 'false' }}"
                                aria-label="Slide {{ ++$slideIndex }}">
                        </button>
                    @endforeach
                @endif
            </div>

            <div class="carousel-inner h-100">
                @forelse($offers as $key => $offer)
                    @php
                        $isActive = $key == 0 ? 'active' : '';
                        $imageUrl = $offer->offer->getFile('banner') ?? authUser()->organization->getFile() ?? asset('assets/images/default/defaultbanner.svg');
                    @endphp
                    <div class="carousel-item {{ $isActive }} h-100" data-bs-interval="10000">
                        <div class="item position-relative" style="background-image: url('{{ $imageUrl }}')">
                            <div class="carousel_caption col-10 col-md-4">
                                <img src="{{ authUser() ? authUser()->organization->getFile() : '' }}" alt=""
                                     class="mb-4" style="max-width: 200px; position: absolute; top: 140px; left: 12%;"/>

                                <a href="{{ route('user.organization.offer-details', $offer->id) }}"
                                   class="btn btn-warning"
                                   style="padding: 5px 10px; font-size: 17px !important; font-weight: 600; position: absolute; bottom: 5%; left: 50%; transform: translateX(-50%)">
                                    Find more offers
                                </a>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="banner-orignization d-flex align-items-center"
                         style="background-image: url('{{ authUser() ? authUser()->organization->getFile('banner') : '' }}');">
                        <div class="container-custom">
                            <div class="banner-text">
                                <img src="{{ authUser() ? authUser()->organization->getFile() : '' }}" alt=""
                                     class="mb-4" style="max-width: 200px;"/>
                                <h1 class="fz-44px mb-3">@lang('app.welcome_to')</h1>
                                <h1 class="banner-title">{{ authUser() ? authUser()->organization->translate('name') : '' }}</h1>
                            </div>
                        </div>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    @livewire('website.components.organization-courses')

    @if($offers->count() >= 2)
        @livewire('website.components.offers')
    @endif

    @livewire('website.components.organization-products')

    <script src="{{ asset('js/timer.js') }}"></script>
</div>
