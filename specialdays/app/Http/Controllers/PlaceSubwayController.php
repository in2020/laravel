<?php

namespace App\Http\Controllers;

use App\PlaceSubway;
use Illuminate\Http\Request;

class PlaceSubwayController extends Controller
{
    //
    public function create($placeId, $subwayId)
    {

        $mPlaceSubway = new PlaceSubway();
        $mPlaceSubway->place_id = $placeId;
        $mPlaceSubway->subway_id = $subwayId;
        $mPlaceSubway->save();
    }

    public function linkPlace($placesId, $subways){
        $this->delete($placesId);

        if(is_array($subways)){
            foreach($subways as $v){
                $this->create($placesId,$v);
            }
        }
    }

    public function delete($placesId){
        $mPlaceSubway = new PlaceSubway();
        $mPlaceSubway->where('place_id',$placesId)->delete();
    }
}
