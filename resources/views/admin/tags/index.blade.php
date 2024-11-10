@extends('layouts.admin')

@section('title', __('admin.tag_list'))

@section('content')
    <h1 class="text-3xl font-bold text-gray-800 mb-6">{{ __('admin.tag_list') }}</h1>
    <a href="{{ route('admin.tags.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 mb-6 inline-block">{{ __('admin.add_tag') }}</a>

    <div class="overflow-x-auto">
        <table class="min-w-full bg-white border border-gray-300 rounded-md shadow-md">
            <thead>
            <tr class="bg-gray-100 border-b border-gray-300">
                <th class="px-4 py-2 text-left text-gray-700">{{ __('admin.name_ua') }}</th>
                <th class="px-4 py-2 text-left text-gray-700">{{ __('admin.name_en') }}</th>
                <th class="px-4 py-2 text-left text-gray-700">{{ __('admin.slug') }}</th>
                <th class="px-4 py-2 text-left text-gray-700">{{ __('admin.actions') }}</th>
            </tr>
            </thead>
            <tbody>
            @foreach($tags as $tag)
                <tr class="border-b hover:bg-gray-50">
                    <td class="px-4 py-3 text-gray-800">{{ $tag->name_ua }}</td>
                    <td class="px-4 py-3 text-gray-800">{{ $tag->name_en }}</td>
                    <td class="px-4 py-3 text-gray-800">{{ $tag->slug }}</td>
                    <td class="px-4 py-3 flex items-center space-x-2">
                        <a href="{{ route('admin.tags.edit', $tag) }}" class="text-sm text-white bg-yellow-500 px-3 py-1 rounded hover:bg-yellow-600">{{ __('admin.edit_tag') }}</a>
                        <form action="{{ route('admin.tags.destroy', $tag) }}" method="POST" class="inline-block">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-sm text-white bg-red-500 px-3 py-1 rounded hover:bg-red-600" onclick="return confirm('{{ __('admin.delete_tag') }}?')">{{ __('admin.delete_tag') }}</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <div class="mt-4">
        {{ $tags->links() }}
    </div>
@endsection
