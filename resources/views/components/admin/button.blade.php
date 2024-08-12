@props(['type' => 'button'])
<div class="w-100">
    <button {{ $attributes->class(['btn','btn-primary','sw-btn-prev','mt-0']) }} type="{{ $type }}"
        wire:loading.attr="disabled"
        {{ $attributes }}>
        {{ $slot }}
    </button>
</div>
