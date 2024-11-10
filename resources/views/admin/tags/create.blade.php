@extends('layouts.admin')

@section('title', __('admin.add_tag'))

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('admin.add_tag') }}</h1>
    <x-forms.tag-form :action="route('admin.tags.store')" method="POST" />
@endsection
