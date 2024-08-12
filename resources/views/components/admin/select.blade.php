@props(['title','error'])
<div class="mb-3">
    {{-- <label class="form-label">@lang("app.{$title}")</label> --}}
   <div class="select_dropdown">
        <select {{ $attributes->class(['x-default-select','form-control','wide']) }} {{ $attributes }}>
        {{ $slot }}
    </select>
   </div>
    @error($error)
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
