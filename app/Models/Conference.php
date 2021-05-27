<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Conference extends Model
{
    use HasFactory;

    protected $fillable = ['topic', 'start_date'];

    /**
     * Get all of the lectures for the Conference
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function lectures()
    {
        return $this->hasMany(Lecture::class);
    }

    /**
     * Get all of the members for the Conference
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function members()
    {
        return $this->hasMany(Member::class);
    }

    public function acceptedLectures()
    {
        return $this->lectures()->accepted()->get();
    }

    public function scopeSortByStartDate($query, $direction = 'desc')
    {
        return $query->orderBy('start_date', $direction);
    }

    public function getStartDateAttribute()
    {
        if (!isset($this->attributes['start_date'])) {
            return null;
        }

        return Carbon::parse($this->attributes['start_date'])->format('d.m.Y');
    }

    public function isHappened()
    {
        return Carbon::parse($this->start_date)->lessThan(now());
    }

    public function isDoesNotHappened()
    {
        return !$this->isHappened();
    }

    public function addNewMember($data)
    {
        return $this->members()->create($data);
    }

    public function addNewLecture($data)
    {
        return $this->lectures()->create($data);
    }
}
