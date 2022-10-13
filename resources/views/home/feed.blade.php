@extends('layouts.app')

@section('title')
    {{ __(':title News', ['title' => $title]) }}
@endsection

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-sm-8 col-md-9 col-lg-10">
                <h3 class="mb-3">
                    {{ __(':title News', ['title' => $title]) }}
                </h3>
                <div class="list-group mb-3">
                    @foreach ($posts as $post)
                        <a href="{{ route('home.post', [$post->category, $post]) }}" class="list-group-item list-group-item-action" aria-current="true">
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
            <div class="col-sm-4 col-md-3 col-lg-2">
                @include('home.categories')
            </div>
        </div>
    </div>
@endsection
