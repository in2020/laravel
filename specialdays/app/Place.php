<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    function activity(){
        return $this->hasMany(Activity::class);
    }

    function subway(){
        return $this->belongsToMany(Subway::class, 'place_subway', 'place_id', 'subway_id');
    }

    function image(){
        return $this->belongsToMany(Image::class, 'image_place', 'place_id', 'image_id');
    }

    function profile(){
        return $this->hasOne(Image::class,'id','profile_img');
    }

    function tag(){
        return $this->hasMany(PlaceTag::class);
    }
}
