@props(['type' => 'button','title'])
<div class="w-100">
    <button {{ $attributes->class(['btn-sm','btn-outline-dark','btn-block']) }} type="{{ $type }}"
        wire:loading.attr="disabled"
        {{ $attributes }}>
        @lang("app.{$title}")
    </button>
</div>
