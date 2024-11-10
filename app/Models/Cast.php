<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cast extends Model
{
    use HasFactory;

    protected $guarded = false;

    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }

    public function getNameAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"name_" . $locale};
    }
}
