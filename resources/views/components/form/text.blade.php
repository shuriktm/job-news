<x-form.field :name="$name" :label="$label">
    <textarea id="{{ $name }}" class="form-control @error('content') is-invalid @enderror" name="{{ $name }}" {{ $attributes }}>{{ old($name, $default) }}</textarea>
</x-form.field>
