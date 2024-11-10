@extends('layouts.client')

@section('title')
    {{ __('client.movies') }}
@endsection

@section('content')
    <div class="container mx-auto px-4 py-8">
        <div class="header flex justify-between items-center mb-8">
            <h1 class="text-4xl font-bold text-gray-800">{{ __('client.movies') }}</h1>
        </div>

        <div class="movies-list grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 xl:grid-cols-5 gap-8">
            @foreach($movies as $movie)
                <div
                    class="movie-card bg-white rounded-lg shadow-lg overflow-hidden transition transform hover:scale-105 hover:shadow-xl">
                    <a href="{{ route('client.movies.show', $movie) }}" class="block relative">
                        <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}"
                             class="w-full h-72 object-cover">
                        <div
                            class="absolute inset-0 bg-gradient-to-t from-black to-transparent opacity-80 hover:opacity-100 transition-opacity duration-300 flex items-end justify-center p-4">
                            <span class="text-white font-bold text-lg">{{ __('client.more') }}</span>
                        </div>
                    </a>
                    <div class="p-4">
                        <h5 class="text-xl font-semibold text-gray-900 truncate">{{ $movie->title }}</h5>
                        <p class="text-gray-600 text-sm mt-1">{{ $movie->release_year }}, <span
                                class="italic">{{ $movie->director }}</span></p>
                        <p class="text-gray-500 text-xs mt-2 flex flex-wrap gap-1">
                            @foreach($movie->tags as $tag)
                                <span class="bg-blue-100 text-blue-800 rounded-full px-3 py-1">{{ $tag->name }}</span>
                            @endforeach
                        </p>
                    </div>
                    <div class="p-4 pt-0 text-center">
                        <a href="{{ route('client.movies.show', $movie) }}"
                           class="text-indigo-600 hover:text-indigo-800 hover:underline text-sm font-medium">{{ __('client.watch_movies') }}</a>
                    </div>
                </div>
            @endforeach
        </div>

        <div class="mt-4">
            {{ $movies->links() }}
        </div>
    </div>
@endsection


@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('css/template/pagination.css') }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/template/pagination.js') }}"></script>
    @endpush
@endonce
