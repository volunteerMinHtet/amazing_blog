<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];

    public function author ()
    {
        return $this->belongsTo('App\Author')->withDefault();
    }

    public function country ()
    {
        return $this->belongsTo('App\Country', 'App\Author')->withDefault();
    }
}
