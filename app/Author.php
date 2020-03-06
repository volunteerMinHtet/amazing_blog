<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Author extends Model
{
    protected $guarded = [];

    public function posts()
    {
        return $this->hasMany('App\Post');
    }

    public function country()
    {
        return $this->belongsTo('App\Country')->withdefault();
    }
}
