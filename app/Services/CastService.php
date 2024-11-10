<?php

namespace App\Services;

use App\Models\Movie;

class CastService
{
    public function saveCast(Movie $movie, $request)
    {
        $movie->cast()->delete();

        if ($request->has('cast_names')) {
            foreach ($request->cast_names as $index => $name) {
                $photo = null;

                if ($request->file("cast_photos.$index")) {
                    $photo = app(ImageService::class)->storeImage($request->file("cast_photos.$index"), 'cast_photos');
                } elseif (isset($request->existing_cast_photos[$index])) {
                    $photo = $request->existing_cast_photos[$index];
                }

                $movie->cast()->create([
                    'name_ua' => $name,
                    'name_en' => $request->cast_names_en[$index],
                    'type' => $request->cast_types[$index],
                    'photo' => $photo,
                ]);
            }
        }
    }
}
