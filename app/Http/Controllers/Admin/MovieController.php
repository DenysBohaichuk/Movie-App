<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Movies\StoreMovieRequest;
use App\Http\Requests\Admin\Movies\UpdateMovieRequest;
use App\Models\Movie;
use App\Models\Tag;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends \App\Http\Controllers\Base\MovieController
{
    protected string $viewPrefix = 'admin.';
    protected MovieService $service;

    public function __construct(MovieService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $movies = $this->service->getMovies($request);
        return view($this->viewPrefix . 'movies.index', compact('movies'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view($this->viewPrefix . 'movies.create', [
            'tags' => $tags,
        ]);
    }

    public function store(StoreMovieRequest $request)
    {
        $result = $this->service->storeMovie($request);

        return redirect()
            ->route($this->viewPrefix . 'movies.index', $result->id)
            ->with('flash_message', [
                'type' => 'success',
                'message' => 'Фільм успішно створено'
            ]);
    }

    public function edit(Movie $movie)
    {
        $tags = Tag::all();
        return view($this->viewPrefix . 'movies.edit', [
            'movie' => $movie,
            'tags' => $tags,
            'movieTags' => $movie->tags->pluck('id')->toArray(),
            'casts' => $movie->cast,
        ]);
    }

    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $this->service->updateMovie($request, $movie);

        return redirect()
            ->route($this->viewPrefix . 'movies.edit', $movie->id)
            ->with('flash_message', [
                'type' => 'success',
                'message' => 'Фільм успішно оновлено'
            ]);
    }

    public function destroy(Movie $movie)
    {
        $this->service->deleteMovie($movie);

        return redirect()
            ->back()
            ->with('flash_message', [
                'type' => 'success',
                'message' => "Фільм $movie->title_ua було успішно видалено."
            ]);
    }

}
