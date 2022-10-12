@extends('layouts.manager')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">{{ __('Categories') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Archives') }}</li>
@endsection

@section('header')
    {{ __('Archives') }}
@endsection

@section('actions')
    <a class="btn btn-secondary py-1 px-3" href="{{ route('categories.index')  }}">{{ __('Back') }}</a>
@endsection

@section('body')
    <x-table :rows="$categories">
        <x-slot:head>
            <th scope="col">{{ __('#') }}</th>
            <th scope="col">{{ __('Title') }}</th>
            <th scope="col">{{ __('Slug') }}</th>
            <th scope="col"></th>
        </x-slot>
        <x-slot:body>
            @foreach ($categories as $index => $category)
                <tr>
                    <th scope="row">{{ $index + 1 }}</th>
                    <td>{{ $category->title }}</td>
                    <td>{{ $category->slug }}</td>
                    <td>
                        <form method="POST" action="{{ route('categories.restore', $category) }}">
                            @csrf
                            @method('POST')
                            <button type="submit" class="btn btn-link text-success p-0" title="{{ __('Restore') }}">
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
