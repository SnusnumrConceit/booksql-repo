<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    public function author() : BelognsTo
    {
        return $this->belongsTo(Author::class);
    }

    public function categories() : HasMany
    {
        return $this->hasMany(Category::class);
    }
}
