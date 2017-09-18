<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
	protected $fillable = ['title', 'description', 'slug'];

    public function lessons()
    {
    	return $this->hasMany(Lesson::class);
    }
}
