@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-9">
                <h3 class="mb-3">
                    {{ $post->title }}
                </h3>
                <h6>
                    {{ Date::parse($post->publish_at)->format('D, M j, Y, H:i') }}
                </h6>
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item">
                            <a href="{{ route('home.category', $category) }}">{{ $category->title }}</a></li>
                    </ol>
                </nav>
                <div class="mt-3">
                    {{ $post->content }}
                </div>
            </div>
            <div class="col-3">
                @include('home.categories')
            </div>
        </div>
    </div>
@endsection
