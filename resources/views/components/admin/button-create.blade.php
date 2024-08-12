@props(['title'])
<button {{ $attributes->class(['btn','btn-sm','btn-outline-dark']) }}
    wire:loading.class="disabled" {{ $attributes }}>
    @lang('app.add') @lang("app.{$title}") &nbsp;
    <i class="fa-solid fa-plus"></i>
</button>
