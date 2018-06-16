<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{

    function place(){
        return $this->belongsTo(Place::class);
    }

    function state(){
        return $this->belongsTo(ActivityState::class,'activity_state_id');
    }

    function type(){
        return $this->belongsTo(ActivityType::class,'activity_type_id');
    }

    function image(){
        return $this->belongsToMany(Image::class, 'activity_image', 'activity_id', 'image_id');
    }

}
