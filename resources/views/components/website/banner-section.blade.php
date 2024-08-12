@props(['image', 'title'])

 
        <div class="position-relative page_banner mark-background" style="background-image:url('{{ $image}}')">
    <!--<img class="banner_img" src="{{ $image }}" alt="@lang('app.alt_image')" />-->
    <div class="content">
        <p>{!! $title !!}</p>
    </div>
</div>
