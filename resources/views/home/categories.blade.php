<h3 class="mb-3">
    {{ __('Categories') }}
</h3>
<ul class="nav flex-column">
    @foreach ($categories as $category)
        <li class="nav-item">
            <a class="nav-link p-1 @if (URL::current() == route('home.category', $category)) active @endif" href="{{ route('home.category', $category) }}">
                @if (URL::current() == route('home.category', $category))
                    <strong>{{ $category->title }}</strong>
                @else
                    {{ $category->title }}
                @endif
            </a>
        </li>
    @endforeach
    @if ($more->count())
        <li class="nav-item mt-3">
            <div class="dropdown dropup">
                <button class="btn btn-link p-1 text-decoration-none dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    {{ __('More') }}
                </button>
                <form id="category-form" class="dropdown-menu p-4" action="{{ url()->full() }}" method="GET">
                    <select id="filter" name="filter" class="form-select py-1" onchange="event.preventDefault(); window.location.replace(event.target.value);">
                        <option value="">{{ __('Category...') }}</option>
                        @foreach ($more as $category)
                            <option value="{{ route('home.category', $category) }}" @selected(URL::current() == route('home.category', $category))>{{ $category->title }}</option>
                        @endforeach
                    </select>
                </form>
            </div>
        </li>
    @endif
    <li class="nav-item mt-3">
        <a class="nav-link p-1 @if (Route::is('home')) active @endif" href="{{ route('home') }}">
            @if (Route::is('home'))
                <strong>{{ __('All News') }}</strong>
            @else
                {{ __('All News') }}
            @endif
        </a>
    </li>
</ul>
