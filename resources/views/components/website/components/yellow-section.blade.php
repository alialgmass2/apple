@props(['data'])
<div class="about">
    <div class="container">
        <p class="about-title">{!! nl2br($data->translate('title')) !!}</p>
        <p class="about-desc">{!! nl2br($data->translate('text')) !!}</p>
    </div>
</div>
