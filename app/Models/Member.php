<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'email', 'unit'];

    /**
     * Get the conference that owns the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function conference()
    {
        return $this->belongsTo(Conference::class);
    }

    /**
     * Get the lecture that owns the Member
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lecture()
    {
        return $this->belongsTo(Lecture::class);
    }

    public function getFullNameAttribute()
    {
        return $this->lastname . ' ' . $this->firstname;
    }
}
