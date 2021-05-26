<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lecture extends Model
{
    use HasFactory;

    protected $fillable = ['topic', 'description'];

    protected $casts = [
        'accepted' => 'boolean',
    ];

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
     * Get the member associated with the Lecture
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function member()
    {
        return $this->hasOne(Member::class);
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
