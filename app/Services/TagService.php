<?php

namespace App\Services;

use App\Models\Tag;
use Illuminate\Support\Str;

class TagService
{
    public function create(array $data): Tag
    {
        $data['slug'] = $data['slug'] ?? Str::slug($data['name_en'] ?? $data['name_ua']);
        return Tag::create($data);
    }

    public function update(Tag $tag, array $data): bool
    {
        $data['slug'] = $data['slug'] ?? Str::slug($data['name_en'] ?? $data['name_ua']);
        return $tag->update($data);
    }
}
