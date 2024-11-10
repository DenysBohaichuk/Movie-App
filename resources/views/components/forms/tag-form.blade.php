<form action="{{ $action }}" method="POST" class="bg-white p-6 rounded-md shadow-md">
    @csrf
    @method($method)


    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.name_ua') }}</label>
        <input type="text" name="name_ua" class="form-input w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300" value="{{ old('name_ua', optional($tag)->name_ua) }}" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.name_en') }}</label>
        <input type="text" name="name_en" class="form-input w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300" value="{{ old('name_en', optional($tag)->name_en) }}" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.slug') }}</label>
        <input type="text" name="slug" class="form-input w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300" value="{{ old('slug', optional($tag)->slug) }}">
    </div>

    <div class="mb-4">
        <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">{{ __('admin.save') }}</button>
    </div>
</form>
