<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['firstname', 'lastname', 'email', 'unit'];

    public function getFullNameAttribute()
    {
        return $this->lastname . ' ' . $this->firstname;
    }
}
