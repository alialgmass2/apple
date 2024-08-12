@props(['title', 'color','data'])
<div class="text-white">
    <div
        class="section-padding d-flex align-items-center product-details-description course-details {{ $color == 'yellow' ? 'bg-yellow-section' : 'bg-dark-section' }} ">
        <div class="container">
            <h1 class="text-left fz-54px">@lang("app.{$title}")</h1>
            <ul class="section-palettes">
                @php
                $lists = explode(PHP_EOL, $data);
                @endphp
                @for ($i = 0; $i < count($lists); $i++)
                <li >{{ $lists[$i] }}</li>
                    @endfor
            </ul>
        </div>
    </div>
</div>
