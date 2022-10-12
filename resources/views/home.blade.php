@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <h3 class="mb-3">
                    {{ $header ?? __('All News') }}
                </h3>
                <div class="list-group mb-3">
                    @foreach ($posts as $post)
                        <a href="{{ route('home.post', [$post->category, $post]) }}" class="list-group-item list-group-item-action @if (Route::is('home.post', [$post->category, $post])) active @endif" aria-current="true">
                            <div class="d-flex w-100 justify-content-between">
                                <h5 class="mb-1">{{ $post->title }}</h5>
                                <small>{{ Date::parse($post->publish_at)->diffForHumans() }}</small>
                            </div>
                            <p class="mb-1">{{ Str::limit($post->content, 70) }}</p>
                        </a>
                    @endforeach
                </div>

                {{ $posts->onEachSide(1)->links() }}
            </div>
            <div class="col-3">
                <h3 class="mb-3">
                    {{ __('Categories') }}
                </h3>
                <ul class="nav flex-column">
                    @foreach ($categories as $category)
                        <li class="nav-item">
                            <a class="nav-link p-1 @if (Route::is('home.category', $category)) active @endif" href="{{ route('home.category', $category) }}">{{ $category->title }}</a>
                        </li>
                    @endforeach
                    <li class="nav-item mt-3">
                        <a class="nav-link p-1 @if (Route::is('home')) active @endif" href="{{ route('home') }}">{{ __('All News') }}</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
@endsection
