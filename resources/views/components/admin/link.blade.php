@props(['title','href','active' => false])
<li class="mb-2 {{ $active ? 'mm-active' : '' }}">
    <a class="d-flex" {{ $attributes->class(['has-arrow','ai-icon']) }} href="{{ $href ?? 'javascript:void()' }}"
        aria-expanded="false">
        {{ $slot }}
        <span class="nav-text span">@lang("app.{$title}")</span>
    </a>
</li>
