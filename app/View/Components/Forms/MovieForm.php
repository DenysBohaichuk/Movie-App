<?php

namespace App\View\Components\Forms;

use App\Models\Movie;
use App\Models\Tag;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class MovieForm extends Component
{
    public string $action;
    public string $method;
    public ?Movie $movie;
    public Collection|array $tags;
    public ?array $movieTags;
    public Collection|array $casts;

    public function __construct(
        string $action,
        Collection|array $tags,
        ?array $movieTags = null,
        Collection|array $casts = null,
        ?string $method = 'POST',
        ?Movie $movie = null)
    {
        $this->action = $action;
        $this->method = $method;
        $this->movie = $movie;
        $this->tags = $tags;
        $this->movieTags = $movieTags;
        $this->casts = $casts;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.movie-form');
    }
}
