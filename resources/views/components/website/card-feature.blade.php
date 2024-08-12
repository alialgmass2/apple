@props(['data'])
<div class="card-feature">
    <img class="card-feature-img"
        src="{{ $data->getFile() }}"
        alt="@lang('app.alt_image')">
    <div class="card-feature-text">
        <h4>{{ $data->translate('title') }}</h4>
        <p>{{ $data->translate('text') }}</p>
    </div>
</div>
