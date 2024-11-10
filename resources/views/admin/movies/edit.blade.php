@extends('layouts.admin')

@section('title', __('admin.edit_movie'))

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('admin.edit_movie') }}</h1>
    <x-forms.movie-form :action="route('admin.movies.update', $movie)" method="PUT" :movie="$movie" :tags="$tags" :movieTags="$movieTags" :casts="$casts"/>
@endsection
