@extends('layouts.client')

@section('title', $movie->title)

@section('content')
    <div class="container mx-auto px-4 py-8">

        <div class="mb-6">
            <a href="{{ route('client.movies.index') }}" class="text-indigo-600 hover:underline">&larr; {{ __('client.back_to_catalog') }}</a>
        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">

            <div class="md:col-span-1">
                <img src="{{ asset('storage/' . $movie->poster) }}" alt="{{ $movie->title }}" class="w-full h-auto rounded-lg shadow-lg">
            </div>


            <div class="md:col-span-2">
                <h1 class="text-4xl font-bold text-gray-900">{{ $movie->title }} ({{ $movie->release_year }})</h1>
                <p class="text-gray-700 mt-2">{{ $movie->description }}</p>

                <div class="mt-4 flex flex-wrap gap-2">
                    @foreach($movie->tags as $tag)
                        <span class="bg-blue-100 text-blue-800 text-xs font-semibold px-3 py-1 rounded">{{ $tag->name }}</span>
                    @endforeach
                </div>

                <div class="mt-4">
                    @php
                        $directors = $movie->cast->where('type', 'Director');
                    @endphp
                    @if($directors->isNotEmpty())
                        <div class="mt-4">
                            <p class="font-semibold">{{ __('client.director') }}:</p>
                            <div class="flex flex-wrap mt-2 gap-4">
                                @foreach($directors as $director)
                                    <div class="flex items-center space-x-2">
                                        @if($director->photo)
                                            <img src="{{ asset('storage/' . $director->photo) }}" alt="{{ $director->name }}" class="w-10 h-10 rounded-full object-cover">
                                        @endif
                                        <span>{{ $director->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @php
                        $writers = $movie->cast->where('type', 'Writer');
                    @endphp
                    @if($writers->isNotEmpty())
                        <div class="mt-4">
                            <p class="font-semibold">{{ __('client.writers') }}:</p>
                            <div class="flex flex-wrap mt-2 gap-4">
                                @foreach($writers as $writer)
                                    <div class="flex items-center space-x-2">
                                        @if($writer->photo)
                                            <img src="{{ asset('storage/' . $writer->photo) }}" alt="{{ $writer->name }}" class="w-10 h-10 rounded-full object-cover">
                                        @endif
                                        <span>{{ $writer->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @php
                        $stars = $movie->cast->where('type', 'Star');
                    @endphp
                    @if($stars->isNotEmpty())
                        <div class="mt-4">
                            <p class="font-semibold">{{ __('client.stars') }}:</p>
                            <div class="flex flex-wrap mt-2 gap-4">
                                @foreach($stars as $star)
                                    <div class="flex items-center space-x-2">
                                        @if($star->photo)
                                            <img src="{{ asset('storage/' . $star->photo) }}" alt="{{ $star->name }}" class="w-10 h-10 rounded-full object-cover">
                                        @endif
                                        <span>{{ $star->name }}</span>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>


            </div>
        </div>


        @if($movie->trailer_id && $movie->isTrailerAvailable())
            <div class="mb-8">
                <h2 class="text-2xl font-semibold mb-4">{{ __('client.trailer') }}</h2>
                <div class="relative" style="padding-top: 56.25%;">
                    <iframe class="absolute top-0 left-0 w-full h-full rounded-lg shadow-lg" src="https://www.youtube.com/embed/{{ $movie->trailer_id }}" frameborder="0" allowfullscreen></iframe>
                </div>
            </div>
        @endif


        @if(!empty(json_decode($movie->screenshots)))
            <div class="mb-8">
                <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-4">
                    @foreach(json_decode($movie->screenshots) as $screenshot)
                        <img src="{{ asset('storage/' . $screenshot) }}" alt="Screenshot" class="rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                    @endforeach
                </div>
            </div>
        @endif
    </div>
@endsection
