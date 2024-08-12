@props(['type' => 'text','title','error','name'])
<div class="mb-3">
    {{-- <label class="text-label form-label">@lang("app.{$title}")</label> --}}
    <input type="{{ $type }}" name="{{$name??''}}" class="form-control" placeholder='{{ __("app.$title") }}' {{ $attributes }}>
    @error($error)
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
