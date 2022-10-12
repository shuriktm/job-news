<x-form.field :name="$name" :label="$label">
    <select id="{{ $name }}" name="{{ $name }}" class="form-select @error($name) is-invalid @enderror" {{ $attributes }}>
        <option></option>
        @foreach ($options as $key => $value)
            <option value="{{ $key }}" @selected($key == old($name, $default))>{{ $value }}</option>
        @endforeach
    </select>
</x-form.field>
