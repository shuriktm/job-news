<form class="hstack gap-3" id="filter-form" action="{{ url()->full() }}" method="GET">
    <div class="input-group flex-nowrap">
        <input id="filter-search" name="search" type="text" value="{{ request()->input('search') }}"
               class="form-control py-1 border-end-0 @if(request()->input('search')) bg-warning bg-opacity-10 @endif" placeholder="{{ __('Filter...') }}"
               onchange="event.preventDefault(); document.getElementById('filter-form').submit();">
        <button class="btn btn-outline-secondary px-2 py-1 bg-light" type="button"
                onclick="event.preventDefault(); document.getElementById('filter-search').value = ''; document.getElementById('filter-form').submit();">
            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-x" viewBox="0 0 16 16">
                <path d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"/>
            </svg>
        </button>
    </div>
</form>
