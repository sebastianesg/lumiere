<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $fillable = [
        'title',
        'director',
        'synopsis',
    ];
    public function genres()
    {
        return $this->belongsToMany(Genre::class);
    }
}
