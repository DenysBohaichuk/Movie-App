@extends('layouts.admin')

@section('title', __('admin.edit_tag'))

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('admin.edit_tag') }}</h1>
    <x-forms.tag-form :action="route('admin.tags.update', $tag)" method="PUT" :tag="$tag" />
@endsection
