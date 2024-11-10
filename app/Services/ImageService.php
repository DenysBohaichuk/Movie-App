<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;

class ImageService
{
    public function storeImage($file, $path)
    {
        return $file->store($path, 'public');
    }

    public function deleteImage($filePath)
    {
        Storage::disk('public')->delete($filePath);
    }

    public function handleScreenshots($request)
    {
        $screenshots = $request->input('keep_screenshots', []);

        if ($request->hasFile('screenshots')) {
            foreach ($request->file('screenshots') as $screenshot) {
                $screenshots[] = $this->storeImage($screenshot, 'screenshots');
            }
        }

        return json_encode($screenshots);
    }
}
