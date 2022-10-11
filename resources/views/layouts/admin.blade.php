@extends('layouts.app')

@section('menu')
    @if (Route::has('posts.index'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('posts.index') }}">{{ __('Posts') }}</a>
        </li>
    @endif
    @if (Route::has('categories.index'))
        <li class="nav-item">
            <a class="nav-link" href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
        </li>
    @endif
@endsection
