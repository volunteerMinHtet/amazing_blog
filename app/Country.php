<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $guarded = [];

    public function Authors ()
    {
        return $this->hasMany('App\Author');
    }

    public function posts () {
        return $this->hasManyThrough('App\Post', 'App\Author');
    }
}
