<?php

namespace App\Models;

use App\Notifications\NewLectureHasBeenAdded;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = ['topic', 'description', 'conference_id', 'member_id'];

    protected $casts = [
        'accepted' => 'boolean',
    ];

    /**
     * Boot the lecture instance.
     */
    protected static function boot()
    {
        parent::boot();

        static::created(function ($lecture) {
            User::haveRole('manager')->get()->each->notify(new NewLectureHasBeenAdded($lecture));
        });
    }

    /**
     * Get the conference that owns the Lecture
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    /**
     * Get member that owns the Lecture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function accept()
    {
        $this->accepted = true;

        $this->save();
    }

    public function reject()
    {
        $this->accepted = false;

        $this->save();
    }

    public function scopeAccepted($query)
    {
        return $query->where('accepted', true);
    }

    public function getRejectedAttribute()
    {
        return $this->accepted === false;
    }

    public function getIsNewAttribute()
    {
        return is_null($this->accepted);
    }
}
