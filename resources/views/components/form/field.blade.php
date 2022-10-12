<div class="row mb-3">
    <label for="{{ $name }}" class="col-md-3 col-form-label text-md-end">{{ $label }}</label>
    <div class="col-md-7">
        {{ $slot }}

        @error($name)
        <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
        @enderror
    </div>
</div>
