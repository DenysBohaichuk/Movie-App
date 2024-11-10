@extends('layouts.admin')

@section('title', __('admin.add_movie'))

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('admin.add_movie') }}</h1>
    <x-forms.movie-form :action="route('admin.movies.store')" method="POST" :tags="$tags" />
@endsection
