<div>
    <section class="feature-container" >
        <div class="container">
            <h2>@lang('app.more_services')</h2>
            <div class="card-features">
                @forelse ($educationFeatures as $educationFeature)
                <x-website.card-feature :data="$educationFeature" :key="$educationFeature->id" :key="$educationFeature->id" />
                @empty

                @endforelse
            </div>
        </div>
    </section>
</div>
