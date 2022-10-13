@extends('layouts.manager')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">{{ __('Categories') }}</a></li>
    <li class="breadcrumb-item">{{ $category->title }}</li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Edit') }}</li>
@endsection

@section('title')
    {{ __('Edit Category: :title', ['title' => $category->title]) }}
@endsection

@section('header')
    {{ __('Edit Category') }}
@endsection

@section('actions')
    <a class="btn btn-secondary py-1 px-3" href="{{ back()->getTargetUrl() }}">{{ __('Back') }}</a>
@endsection

@section('body')
    <x-form method="PUT" action="{{ route('categories.update', $category) }}" button="{{ __('Update') }}">
        <x-form.input name="title" label="{{ __('Title') }}" default="{{ $category->title }}" required/>
        <x-form.input name="slug" label="{{ __('Slug') }}" default="{{ $category->slug }}" placeholder="{{ __('Automatically generated') }}"/>
    </x-form>
@endsection
