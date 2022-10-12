<form id="filter-form" action="{{ url()->full() }}" method="GET">
    <select id="filter" name="filter" class="form-select py-1" onchange="event.preventDefault(); document.getElementById('filter-form').submit();">
        <option value="">{{ __('Category...') }}</option>
        @foreach ($categories as $key => $value)
            <option value="{{ $key }}" @selected($key == $filter)>{{ $value }}</option>
        @endforeach
    </select>
</form>
