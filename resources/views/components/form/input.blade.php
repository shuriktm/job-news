<x-form.field :name="$name" :label="$label">
    <input id="{{ $name }}" type="{{ $type ?: 'text' }}" class="form-control @error($name) is-invalid @enderror" name="{{ $name }}" value="{{ old($name, $default) }}" {{ $attributes }}>
</x-form.field>
