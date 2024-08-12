@props(['title', 'error'])

<div>
    <link rel="stylesheet" href="{{ asset('assets/css/multiSelect.css') }}">
    <div class="mb-3">
        <div class="modal-box">
            <div class="sd-multiSelect form-group">
                <select multiple id="current-job-role" class="sd-CustomSelect form-control {{ $attributes->class(['x-default-select', 'form-control', 'wide']) }}">
                    {{ $slot }}
                </select>
            </div>
        </div>

        @error($error)
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
</div>