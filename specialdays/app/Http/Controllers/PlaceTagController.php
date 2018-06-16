<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\PlaceTag;

class PlaceTagController extends Controller
{
    public function create($placeId,$tags){
        $this->delete($placeId);
        $rTag = explode(',',$tags);
        foreach($rTag as $tag){
            $this->store($placeId,$tag);
        }
    }

    public function store($placeId, $tag){
        $mPlaceTag = new PlaceTag();
        $mPlaceTag->place_id = $placeId;
        $mPlaceTag->tag = $tag;
        $mPlaceTag->save();
    }

    public function delete($placeId){
        $mPlaceTag = new PlaceTag();
        $mPlaceTag->where('place_id',$placeId)->delete();
    }
}
