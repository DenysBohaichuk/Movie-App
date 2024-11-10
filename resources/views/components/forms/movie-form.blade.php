<form action="{{ $action }}" method="POST" enctype="multipart/form-data" class="bg-white p-6 rounded-md shadow-md">
    @csrf
    @method($method)

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.status') }}</label>
        <select name="status"
                class="form-select w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
            <option value="1" {{ optional($movie)->status ? 'selected' : '' }}>{{ __('admin.show') }}</option>
            <option value="0" {{ optional($movie)->status ? '' : 'selected' }}>{{ __('admin.hide') }}</option>
        </select>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.title_ua') }}</label>
        <input type="text" name="title_ua"
               class="form-input w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"
               value="{{ old('title_ua', optional($movie)->title_ua) }}" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.title_en') }}</label>
        <input type="text" name="title_en"
               class="form-input w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"
               value="{{ old('title_en', optional($movie)->title_en) }}" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.description_ua') }}</label>
        <textarea name="description_ua"
                  class="form-textarea w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">{{ old('description_ua', optional($movie)->description_ua) }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.description_en') }}</label>
        <textarea name="description_en"
                  class="form-textarea w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">{{ old('description_en', optional($movie)->description_en) }}</textarea>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.poster') }}</label>
        <input type="file" name="poster"
               class="form-input w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"
               onchange="previewPoster(event)">

        @if (isset($movie) && $movie->poster)
            <div class="poster-card" id="current-poster">
                <img src="{{ asset('storage/' . $movie->poster) }}" alt="Poster" class="preview-image"
                     id="poster-preview">
                <button type="button" onclick="removePoster()"
                        class="delete-button">{{ __('admin.delete_poster') }}</button>
                <input type="hidden" name="delete_poster" id="delete-poster" value="0">
            </div>
        @endif
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.screenshots') }}</label>
        <input type="file" name="screenshots[]" multiple
               class="form-input w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"
               onchange="previewScreenshots(event)">

        <div class="flex flex-wrap" id="screenshots-container">
            @if (isset($movie) && $movie->screenshots)
                @foreach (json_decode($movie->screenshots) as $index => $screenshot)
                    <div class="screenshot-card" data-index="{{ $index }}">
                        <img src="{{ asset('storage/' . $screenshot) }}" alt="Screenshot" class="preview-image">
                        <button type="button" onclick="removeScreenshot({{ $index }})"
                                class="delete-button">{{ __('admin.delete_screenshot') }}</button>
                        <input type="hidden" name="keep_screenshots[]" value="{{ $screenshot }}">
                    </div>
                @endforeach
            @endif
        </div>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.trailer_id') }}</label>
        <input type="text" name="trailer_id"
               class="form-input w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"
               value="{{ old('trailer_id', optional($movie)->trailer_id) }}">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.release_year') }}</label>
        <input type="number" name="release_year" min="1900" max="{{ date('Y') }}"
               class="form-input w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"
               value="{{ old('release_year', optional($movie)->release_year) }}" required>
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.start_date') }}</label>
        <input type="datetime-local" name="view_start_date"
               class="form-input w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"
               value="{{ old('view_start_date', optional($movie)->view_start_date) }}">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.end_date') }}</label>
        <input type="datetime-local" name="view_end_date"
               class="form-input w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"
               value="{{ old('view_end_date', optional($movie)->view_end_date) }}">
    </div>

    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.cast') }}</label>
        <div id="cast-fields">
            @if (isset($casts))
                @foreach ($casts as $index => $cast)
                    <div class="flex space-x-4 mb-2 cast-entry">
                        <input type="hidden" name="cast_ids[]" value="{{ $cast->id }}">
                        <input type="text" name="cast_names[]" value="{{ $cast->name_ua }}" placeholder="Name (UA)"
                               class="form-input border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"
                               required>
                        <input type="text" name="cast_names_en[]" value="{{ $cast->name_en }}" placeholder="Name (EN)"
                               class="form-input border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"
                               required>
                        <select name="cast_types[]"
                                class="form-select border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300"
                                required>
                            <option value="Director" {{ $cast->type === 'Director' ? 'selected' : '' }}>Director
                            </option>
                            <option value="Writer" {{ $cast->type === 'Writer' ? 'selected' : '' }}>Writer</option>
                            <option value="Actor" {{ $cast->type === 'Actor' ? 'selected' : '' }}>Actor</option>
                            <option value="Composer" {{ $cast->type === 'Composer' ? 'selected' : '' }}>Composer
                            </option>
                        </select>

                        <div class="flex gap-1">
                            <img src="{{ asset('storage/' . $cast->photo) }}" alt="Cast Photo"
                                 style="width: 50px; height: 50px; object-fit: cover;">
                            <input type="hidden" name="existing_cast_photos[]" value="{{ $cast->photo }}">
                            <input type="file" name="cast_photos[]"
                                   class="form-input border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
                        </div>

                        <button type="button" onclick="removeCastField(this)"
                                class="bg-red-500 text-white px-2 rounded">X
                        </button>
                    </div>
                @endforeach
            @endif
        </div>
        <button type="button" class="bg-blue-500 text-white px-4 py-2 rounded mb-2"
                onclick="addCastField()">{{ __('admin.add_cast') }}</button>
    </div>


    <div class="mb-4">
        <label class="block text-gray-700">{{ __('admin.tags') }}</label>
        @if (isset($tags))

        <select name="tags[]" multiple
                class="form-select w-full border-gray-300 rounded-md focus:ring focus:ring-blue-200 focus:border-blue-300">
            @foreach($tags as $tag)
                <option value="{{ $tag->id }}" {{ in_array($tag->id, old('tags', $movieTags ?? [])) ? 'selected' : '' }}>
                    {{ $tag->name }}
                </option>
            @endforeach
        </select>
        @else
            <div>
                {{ __('admin.tags_not_exists') }}
            </div>
        @endif
    </div>

    <div class="mb-4">
        <button type="submit"
                class="bg-green-500 text-white px-4 py-2 rounded hover:bg-green-600">{{ __('admin.save') }}</button>
    </div>
</form>




@once
    @push('styles')
        <link rel="stylesheet" href="{{ asset('/css/movies/imageCard.css')  }}">
    @endpush

    @push('scripts')
        <script src="{{ asset('js/movies/casts.js') }}"></script>
        <script src="{{ asset('js/movies/imageManager.js') }}"></script>

        <script>
            window.translations = {
                deleteScreenshot: @json(__('admin.delete_screenshot')),
                deletePoster: @json(__('admin.delete_poster'))
            };
        </script>
    @endpush
@endonce
