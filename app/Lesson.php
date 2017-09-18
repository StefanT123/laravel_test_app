<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
	protected $fillable = ['title', 'description', 'module_id', 'slug'];

    public function module()
    {
    	return $this->belongsTo(Module::class);
    }

    public function sessions()
    {
    	return $this->hasMany(Session::class);
    }
}
