@props(['title','error'])
<div class="mb-4">
    <label class="text-label form-label">@lang("app.{$title}")</label>
    <textarea class="form-control" rows="5" id="comment" {{ $attributes }}></textarea>
    @error($error)
    <p class="text-danger">{{ $message }}</p>
    @enderror
</div>
