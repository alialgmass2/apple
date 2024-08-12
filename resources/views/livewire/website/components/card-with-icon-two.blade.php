<div>
    <section class="feature-container ">
        <div class="container">
            <h2>@lang('app.more_services')</h2>
            <div class="card-features">
               @forelse ($studentFeatures as $studentFeature)
                   <x-website.card-feature :data="$studentFeature" :key="$studentFeature->id" />
               @empty

               @endforelse
            </div>
        </div>
    </section>
</div>
