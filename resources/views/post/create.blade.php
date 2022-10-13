@extends('layouts.manager')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('posts.index') }}">{{ __('Posts') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Create') }}</li>
@endsection

@section('title')
    {{ __('Create Post') }}
@endsection

@section('header')
    {{ __('Create Post') }}
@endsection

@section('actions')
    <a class="btn btn-secondary py-1 px-3" href="{{ back()->getTargetUrl() }}">{{ __('Back') }}</a>
@endsection

@section('body')
    <x-form method="POST" action="{{ route('posts.store') }}" button="{{ __('Create') }}">
        <x-form.input name="title" label="{{ __('Title') }}" required/>

        <x-form.input name="slug" label="{{ __('Slug') }}" placeholder="{{ __('Automatically generated') }}"/>

        <x-form.input type="datetime-local" name="publish_at" label="{{ __('Publish At') }}" default="{{ now() }}" required/>

        <x-form.select name="category_id" label="{{ __('Category') }}" :options="$categories" required/>

        <x-form.text name="content" label="{{ __('Content') }}" required rows="5"/>
    </x-form>
@endsection
