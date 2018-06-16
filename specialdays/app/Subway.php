<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Subway extends Model
{
    function place(){
        return $this->belongsToMany(Place::class, 'place_subway', 'subway_id', 'place_id');
    }
}
