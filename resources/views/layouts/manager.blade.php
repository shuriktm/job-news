@extends('layouts.app')

@section('menu')
    @if (Route::has('categories.index'))
        <li class="nav-item">
            <a class="nav-link @if (Route::is('categories.*')) active @endif" href="{{ route('categories.index') }}">{{ __('Categories') }}</a>
        </li>
    @endif
    @if (Route::has('posts.index'))
        <li class="nav-item">
            <a class="nav-link @if (Route::is('posts.*')) active @endif" href="{{ route('posts.index') }}">{{ __('Posts') }}</a>
        </li>
    @endif
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        @yield('breadcrumbs')
                    </ol>
                </nav>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-12">
                @if (session('status'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        {{ session()->pull('status') }}
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="{{ __('Close') }}"></button>
                    </div>
                @endif
                <div class="card">
                    <div class="card-header hstack gap-3">
                        <h4 class="py-1 mb-0">@yield('header')</h4>
                        @hasSection('filter')
                            <div class="ms-auto">@yield('filter')</div>
                            <div class="vr"></div>
                        @else
                            <div class="ms-auto"></div>
                        @endif
                        <div class="hstack gap-1">@yield('actions')</div>
                    </div>
                    <div class="card-body">
                        @yield('body')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
