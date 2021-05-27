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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function lecture()
    {
        return $this->hasOne(Lecture::class);
    }

    public function getFullNameAttribute()
    {
        return $this->lastname . ' ' . $this->firstname;
    }
}
