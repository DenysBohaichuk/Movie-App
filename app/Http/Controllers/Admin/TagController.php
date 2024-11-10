<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTagRequest;
use App\Http\Requests\UpdateTagRequest;
use App\Models\Tag;
use App\Services\TagService;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    protected string $viewPrefix = 'admin.';

    protected TagService $tagService;

    public function __construct(TagService $tagService)
    {
        $this->tagService = $tagService;
    }



    public function index()
    {
        $tags = Tag::paginate(10);
        return view($this->viewPrefix . 'tags.index', compact('tags'));
    }



    public function create()
    {
        return view($this->viewPrefix . 'tags.create');
    }



    public function store(StoreTagRequest  $request)
    {
        $this->tagService->create($request->validated());

        return redirect()->route($this->viewPrefix . 'tags.index')->with('flash_message', [
            'type' => 'success',
            'message' => 'Тег створено успішно'
        ]);
    }


    public function edit(Tag $tag)
    {
        return view($this->viewPrefix . 'tags.edit', compact('tag'));
    }


    public function update(UpdateTagRequest  $request, Tag $tag)
    {
        $this->tagService->update($tag, $request->validated());

        return redirect()->route($this->viewPrefix . 'tags.index')->with('flash_message', [
            'type' => 'success',
            'message' => 'Тег оновлено успішно'
        ]);
    }


    public function destroy(Tag $tag)
    {
        $tag->delete();

        return redirect()->route($this->viewPrefix . 'tags.index')->with('flash_message', [
            'type' => 'success',
            'message' => 'Тег видалено успішно'
        ]);
    }
}
