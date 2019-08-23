<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
	public $fillable = ['name'];
	
    public function books() : HasMany
    {
    	return $this->hasMany(Book::class);
    }
}
