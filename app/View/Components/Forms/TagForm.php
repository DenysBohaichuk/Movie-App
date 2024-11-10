<?php

namespace App\View\Components\Forms;

use App\Models\Tag;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\View\Component;

class TagForm extends Component
{
    public string $action;
    public string $method;
    public ?Tag $tag;

    public function __construct(
        string $action,
        string $method = 'POST',
        ?Tag $tag = null)
    {
        $this->action = $action;
        $this->method = $method;
        $this->tag = $tag;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.tag-form');
    }
}
