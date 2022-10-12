@extends('layouts.manager')

@section('breadcrumbs')
    <li class="breadcrumb-item"><a href="{{ route('categories.index') }}">{{ __('Categories') }}</a></li>
    <li class="breadcrumb-item active" aria-current="page">{{ __('Create') }}</li>
@endsection

@section('header')
    {{ __('Create Category') }}
@endsection

@section('actions')
    <a class="btn btn-secondary py-1 px-3" href="{{ back()->getTargetUrl() }}">{{ __('Back') }}</a>
@endsection

@section('body')
    <x-form method="POST" action="{{ route('categories.store') }}" button="{{ __('Create') }}">
        <x-form.input name="title" label="{{ __('Title') }}" required/>
        <x-form.input name="slug" label="{{ __('Slug') }}" placeholder="{{ __('Automatically generated') }}"/>
    </x-form>
@endsection
