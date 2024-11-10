<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    protected $guarded = false;


    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'movie_tag');
    }

    public function cast()
    {
        return $this->hasMany(Cast::class);
    }

    public function getTitleAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"title_" . $locale};
    }

    public function getDescriptionAttribute()
    {
        $locale = app()->getLocale();
        return $this->{"description_" . $locale};
    }

    public function isTrailerAvailable(): bool
    {
        $now = Carbon::now();

        $viewStartDate = $this->view_start_date ? Carbon::parse($this->view_start_date) : null;
        $viewEndDate = $this->view_end_date ? Carbon::parse($this->view_end_date) : null;

        if (!$viewStartDate) {
            return false;
        }

        if ($viewEndDate && $viewStartDate->equalTo($viewEndDate)) {
            return $now->isSameDay($viewStartDate);
        }

        $isAfterStartDate = $now->greaterThanOrEqualTo($viewStartDate);
        $isBeforeEndDate = !$viewEndDate || $now->lessThanOrEqualTo($viewEndDate);

        return $isAfterStartDate && $isBeforeEndDate;
    }
}
