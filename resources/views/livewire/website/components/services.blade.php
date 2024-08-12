<div>
    <section class="deployment">
        <div class="container">
            <h2 class="deployment_head">@lang('app.more_deployment_services')</h2>
            <ul class="deployment_list">
                @forelse ($services as $service)
                <li>{{ $service->translate('title') }}</li>
                @empty
                @endforelse

            </ul>
        </div>
    </section>
</div>
