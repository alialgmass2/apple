@props(['title', 'color','data'])
<div class="about section-padding d-flex align-items-center product-details-description {{ $color == 'yellow' ? 'bg-yellow-section' : 'bg-dark-section' }}">
    <div class="container">
        <h1 class="text-left fz-54px">@lang("app.{$title}")</h1>
        @php
        $abouts = explode(PHP_EOL, $data);
        @endphp
        @for ($i = 0; $i < count($abouts); $i++)
        <p class="text-left mt-3">{{ $abouts[$i] }}</p>
            @endfor
    </div>
</div>
