<?php
namespace App\Http\Controllers\Client;

use App\Models\Movie;
use App\Services\MovieService;
use Illuminate\Http\Request;

class MovieController extends \App\Http\Controllers\Base\MovieController
{

    protected MovieService $service;

    public function __construct(MovieService $service)
    {
        $this->service = $service;
    }

    public function index(Request $request)
    {
        $movies = $this->service->getMovies($request);
        return view('client.movies.index', compact('movies'));
    }

    public function show(Movie $movie)
    {
        if ($movie->status == 0) {
            abort(404);
        }

        $canShowVideo = true;
        if ($movie->view_start_date && $movie->view_end_date) {
            $now = now();
            $canShowVideo = $now->between($movie->view_start_date, $movie->view_end_date);
        }

        return view('client.movies.show', compact('movie', 'canShowVideo'));
    }
}
