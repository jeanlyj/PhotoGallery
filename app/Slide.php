<?php

namespace App;

use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Slide extends Eloquent
{
    protected $connection = 'mongodb';
    protected $guarded = [];
    
    /**
     * Set up the relationship.
     */

    public function gallery(){
        return $this->belongsTo('App\Gallery');
    }
}
