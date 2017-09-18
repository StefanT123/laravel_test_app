<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Session extends Model
{
	protected $fillable = ['title', 'lesson_id', 'content', 'video', 'slug'];

    public function lesson()
    {
    	return $this->belongsTo(Lesson::class);
    }

    public function users()
    {
    	return $this->belongsToMany(User::class)->withTimestamps();
    }
}
