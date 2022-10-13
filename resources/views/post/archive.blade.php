@extends('layouts.manager')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">{{ __('Posts') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Archive') }}</li>
@endsection

@section('title')
    {{ __('Post Archive') }}
@endsection

@section('header')
    {{ __('Archive') }}
@endsection

@section('actions')
    <a class="btn btn-secondary py-1 px-3" href="{{ route('posts.index')  }}">{{ __('Back') }}</a>
@endsection

@section('filter')
    @include('post.filter')
@endsection

@section('body')
    <x-table :rows="$posts">
        <x-slot:head>
            <th scope="col">{{ __('#') }}</th>
            <th scope="col">{{ __('Title') }}</th>
            <th scope="col">{{ __('Slug') }}</th>
            <th scope="col">{{ __('Category') }}</th>
            <th scope="col">
                {{ __('Publish At') }}
                &nbsp;
                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-sort-down" viewBox="0 0 16 16">
                    <path d="M3.5 2.5a.5.5 0 0 0-1 0v8.793l-1.146-1.147a.5.5 0 0 0-.708.708l2 1.999.007.007a.497.497 0 0 0 .7-.006l2-2a.5.5 0 0 0-.707-.708L3.5 11.293V2.5zm3.5 1a.5.5 0 0 1 .5-.5h7a.5.5 0 0 1 0 1h-7a.5.5 0 0 1-.5-.5zM7.5 6a.5.5 0 0 0 0 1h5a.5.5 0 0 0 0-1h-5zm0 3a.5.5 0 0 0 0 1h3a.5.5 0 0 0 0-1h-3zm0 3a.5.5 0 0 0 0 1h1a.5.5 0 0 0 0-1h-1z"/>
                </svg>
            </th>
            <th scope="col"></th>
        </x-slot>
        <x-slot:body>
            @foreach ($posts as $index => $post)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $post->title }}</td>
                    <td>{{ $post->slug }}</td>
                    <td>
                        <span class="hstack gap-1">
                            {{ $post->category->title }}
                            @if ($post->category->trashed())
                                <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" fill="currentColor" class="bi bi-trash3-fill" viewBox="0 0 16 16">
                                    <path d="M11 1.5v1h3.5a.5.5 0 0 1 0 1h-.538l-.853 10.66A2 2 0 0 1 11.115 16h-6.23a2 2 0 0 1-1.994-1.84L2.038 3.5H1.5a.5.5 0 0 1 0-1H5v-1A1.5 1.5 0 0 1 6.5 0h3A1.5 1.5 0 0 1 11 1.5Zm-5 0v1h4v-1a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5ZM4.5 5.029l.5 8.5a.5.5 0 1 0 .998-.06l-.5-8.5a.5.5 0 1 0-.998.06Zm6.53-.528a.5.5 0 0 0-.528.47l-.5 8.5a.5.5 0 0 0 .998.058l.5-8.5a.5.5 0 0 0-.47-.528ZM8 4.5a.5.5 0 0 0-.5.5v8.5a.5.5 0 0 0 1 0V5a.5.5 0 0 0-.5-.5Z"/>
                                </svg>
                            @endif
                        </span>
                    </td>
                    <td>{{ Date::parse($post->publish_at)->toDateTimeString() }}</td>
                    <td>
                        <form id="restore-{{ $post->id }}-form" method="POST" action="{{ route('posts.restore', $post) }}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-link text-success p-0" title="{{ __('Restore') }}"
                                    onclick="event.preventDefault(); if (window.confirm('{{ __('Are you sure? Restore the item?') }}')) document.getElementById('restore-{{ $post->id }}-form').submit();">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-recycle" viewBox="0 0 16 16">
                                    <path d="M9.302 1.256a1.5 1.5 0 0 0-2.604 0l-1.704 2.98a.5.5 0 0 0 .869.497l1.703-2.981a.5.5 0 0 1 .868 0l2.54 4.444-1.256-.337a.5.5 0 1 0-.26.966l2.415.647a.5.5 0 0 0 .613-.353l.647-2.415a.5.5 0 1 0-.966-.259l-.333 1.242-2.532-4.431zM2.973 7.773l-1.255.337a.5.5 0 1 1-.26-.966l2.416-.647a.5.5 0 0 1 .612.353l.647 2.415a.5.5 0 0 1-.966.259l-.333-1.242-2.545 4.454a.5.5 0 0 0 .434.748H5a.5.5 0 0 1 0 1H1.723A1.5 1.5 0 0 1 .421 12.24l2.552-4.467zm10.89 1.463a.5.5 0 1 0-.868.496l1.716 3.004a.5.5 0 0 1-.434.748h-5.57l.647-.646a.5.5 0 1 0-.708-.707l-1.5 1.5a.498.498 0 0 0 0 .707l1.5 1.5a.5.5 0 1 0 .708-.707l-.647-.647h5.57a1.5 1.5 0 0 0 1.302-2.244l-1.716-3.004z"/>
                                </svg>
                            </button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </x-slot>
    </x-table>
@endsection
