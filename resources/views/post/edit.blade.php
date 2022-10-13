@extends('layouts.manager')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">{{ __('Posts') }}</a></li>
    <li class="breadcrumb-item">{{ $post->title }}</li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
@endsection

@section('title')
    {{ __('Edit Post: :title', ['title' => $post->title]) }}
@endsection

@section('header')
    {{ __('Edit Post') }}
@endsection

@section('actions')
    <a class="btn btn-secondary py-1 px-3" href="{{ back()->getTargetUrl() }}">{{ __('Back') }}</a>
@endsection

@section('body')
    <x-form method="PUT" action="{{ route('posts.update', $post) }}" button="{{ __('Update') }}">
        <x-form.input name="title" label="{{ __('Title') }}" default="{{ $post->title }}" required/>

        <x-form.input name="slug" label="{{ __('Slug') }}" default="{{ $post->slug }}" placeholder="{{ __('Automatically generated') }}"/>

        <x-form.input type="datetime-local" name="publish_at" label="{{ __('Publish At') }}" default="{{ $post->publish_at ?: now() }}" required/>

        <x-form.select name="category_id" label="{{ __('Category') }}" default="{{ $post->category_id }}" :options="$categories" required/>

        <x-form.text name="content" label="{{ __('Content') }}" default="{{ $post->content }}" required rows="5"/>
    </x-form>
@endsection
