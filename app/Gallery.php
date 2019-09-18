<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;


class Gallery extends Eloquent
{
    protected $connection = 'mongodb';
    protected $guarded = [];

    /**
     * Set up the relationship.
     */

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function slides(){
        return $this->hasMany('App\Slide');
    }
}
