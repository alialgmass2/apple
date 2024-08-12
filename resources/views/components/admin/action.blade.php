@props(['type','href','color' => 'text-info'])
@if ($type == 'edit')
@php
$color = 'text-primary';
@endphp
@elseif ($type == 'show')
@php
$color = 'text-warning';
@endphp
@elseif ($type == 'delete')
@php
$color = 'text-danger';
@endphp
@else
@endif
<a href="{{ $href ?? 'javascript::void(0)' }}" {{ $attributes->class(['btn','btn-xs','sharp','me-1','fz-16px',"{$color}"]) }}
    wire:loading.class="disabled" {{ $attributes }}>
    @if ($type == 'edit')
    <i class="fa-regular fa-pen-to-square"></i>
    @elseif ($type == 'show')
    <i class="fa fa-eye" wire:loading.class="disabled"></i>
    @elseif ($type == 'delete')
    <i class="fa fa-trash-can"></i>
    @else
    {{ $slot }}
    @endif
</a>
