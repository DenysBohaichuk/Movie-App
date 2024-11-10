<?php
namespace App\Services;

use App\Models\Movie;
use Illuminate\Http\Request;

class MovieService
{
    protected $imageService;
    protected $castService;

    public function __construct(ImageService $imageService, CastService $castService)
    {
        $this->imageService = $imageService;
        $this->castService = $castService;
    }

    public function getMovies($request){
        $perPage = $request->input('perPage', 10);

        $movies = Movie::where('status', 1)->paginate($perPage);

        return $movies->appends([
            'perPage' => $perPage,
        ]);
    }

    public function storeMovie(Request $request)
    {
        $validated = $request->validated();

        if ($request->hasFile('poster')) {
            $validated['poster'] = $this->imageService->storeImage($request->file('poster'), 'posters');
        }

        $validated['screenshots'] = $this->imageService->handleScreenshots($request);

        $tags = $validated['tags'] ?? [];
        unset($validated['tags']);
        $movie = Movie::create($validated);

        $this->castService->saveCast($movie, $request);

        $movie->tags()->sync($tags);

        return $movie;
    }

    public function updateMovie(Request $request, Movie $movie)
    {
        $validated = $request->validated();

        if ($request->input('delete_poster') == 1 && $movie->poster) {
            $this->imageService->deleteImage($movie->poster);
            $validated['poster'] = null;
        } elseif ($request->hasFile('poster')) {
            $this->imageService->deleteImage($movie->poster);
            $validated['poster'] = $this->imageService->storeImage($request->file('poster'), 'posters');
        }

        $validated['screenshots'] = $this->imageService->handleScreenshots($request);

        $tags = $validated['tags'] ?? [];
        unset($validated['tags']);
        $movie->update($validated);

        $this->castService->saveCast($movie, $request);

        $movie->tags()->sync($tags);

        return $movie;
    }

    public function deleteMovie(Movie $movie): bool
    {
        $movie->tags()->detach();
        $movie->cast()->delete();

        $this->imageService->deleteImage($movie->poster);

        $screenshots = json_decode($movie->screenshots, true);
        if (is_array($screenshots)) {
            foreach ($screenshots as $screenshot) {
                $this->imageService->deleteImage($screenshot);
            }
        }

        return $movie->delete();
    }
}
