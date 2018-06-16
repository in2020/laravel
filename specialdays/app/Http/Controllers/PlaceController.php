<?php

namespace App\Http\Controllers;

use App\ImagePlace;
use App\Subway;
use App\Place;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mPlace = new Place;
        $mSubway = new Subway();

        if($request['subway']){
            $subway = $request['subway'];

            $mPlace = $mPlace->whereHas('subway',function($query)use($subway){
                $query->where('name', 'like', "%$subway%");
            });
        }

        if($request['place_state_id']){
            $mPlace = $mPlace->where('place_state_id',$request['place_state_id']);
        }

        if($request['name']){
            $mPlace = $mPlace->where('name',$request['name']);
        }

        return $mPlace->withCount('activity')->orderby('id','desc')->paginate(20);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
/*    public function create()
    {
        //
    }*/

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function show(Place $place)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function edit(Place $place)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
/*    public function update(Request $request, Place $place)
    {
        //
    }*/

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Place  $place
     * @return \Illuminate\Http\Response
     */
    public function destroy(Place $place)
    {
        //
    }


    //2018.02.10 lagacy
    public function places(Request $request)
    {
        $mPlace = new Place;
        $mSubway = new Subway();

        if($request['subway']){
            $subway = $request['subway'];

            $mPlace = $mPlace->whereHas('subway',function($query)use($subway){
                $query->where('name', 'like', "%$subway%");
            });
        }

        if($request['place_state_id']){
            $mPlace = $mPlace->where('place_state_id',$request['place_state_id']);
        }

        if($request['name']){
            $mPlace = $mPlace->where('name',$request['name']);
        }

        return view('admin/place/list',['places'=>$mPlace->withCount('activity')->orderby('id','desc')->paginate(20)]);
    }


    private function createImage(Request $request){
        $imgs = $request->file('imgs');
        $arr_img = '';
        if(count($imgs) > 0){

        }

        if($arr_img) $arr_img = substr($arr_img,0,-1);

        return $arr_img;
    }

    private function deleteImages($request){

        $rDeletingImageId = $request->deletingImages;
        $placeId = $request->id;


        if($rDeletingImageId ){
            $imageController = new ImageController();

            $mImagePlace = new ImagePlace;
            foreach($rDeletingImageId as $imageId){
                $imagePlace = $mImagePlace->where('place_id','=',$placeId)
                    ->where('image_id','=',$imageId)
                    ->first();
                $imagePlace->delete();
            }

            $imageController->delete($rDeletingImageId);


        }
    }

    private function placeValidate(Request $request){
        $this->validate($request, [
            'name' => 'required|max:50',
            'introduce' => 'max:2000',
            'homepage' => 'max:100',
            'blog' => 'max:100',
            'sns' => 'max:100',
            'phone' => 'max:30',
            'kakao' => 'max:256',
            'email' => 'max:256',
            'address' => 'max:100',
            'location' => 'max:1000'
        ]);
    }


    /**
     * Create a new place instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function insertPlace(Request $request)
    {
        $imageController = new ImageController();
        $profile_img = $imageController->create($request, 'profile_img', 'profile', 'admin');

        $mPlace = new Place;
        $mPlace->name = $request->name;
        if($profile_img) $mPlace->profile_img = $profile_img;
        $mPlace->introduce = $request->introduce;
        $mPlace->homepage = $request->homepage;
        $mPlace->blog = $request->blog;
        $mPlace->sns = $request->sns;
        $mPlace->phone = $request->phone;
        $mPlace->kakao = $request->kakao;
        $mPlace->email = $request->email;
        $mPlace->address = $request->address;
        $mPlace->lat = $request->lat;
        $mPlace->lng = $request->lng;
        $mPlace->location = $request->location;
        $mPlace->created_by = 'admin';
        $mPlace->updated_by = 'admin';

        $mPlace->save();

        $placeSubwayController = new PlaceSubwayController();
        $placeSubwayController->linkPlace($mPlace->id,$request->subways);

        $placeTagController = new PlaceTagController();
        $placeTagController->create($mPlace->id,$request->tags);

        $arrImage = $imageController->create($request, 'imgs', 'place', 'admin');
        if(is_array($arrImage)){
            $mImagePlace = new ImagePlace;
            foreach($arrImage as $i => $image_id){
                $mImagePlace->place_id = $mPlace->getKey();
                $mImagePlace->image_id = $image_id;
                $mImagePlace->sort = $i;
                $mImagePlace->save();
            }
        }

        return redirect()->action('PlaceController@places');
    }

    /**
     * Update a new place instance.
     *
     * @param  Request  $request
     * @return Response
     */
    public function updatePlace(Request $request)
    {
        $imageController = new ImageController();

        $placeId = $request->id;

        $this->placeValidate($request);
        //processing image
        $profile_img = $imageController->create($request, 'profile_img', 'profile', 'admin');

        $mPlace = new Place;
        $place = $mPlace->find($request->id) ;

        if($profile_img) $imageController->delete(array($place->profile_img));


        $place->name = $request->name;
        if($profile_img) $place->profile_img = $profile_img;
        $place->introduce = $request->introduce;
        $place->homepage = $request->homepage;
        $place->blog = $request->blog;
        $place->sns = $request->sns;
        $place->phone = $request->phone;
        $place->kakao = $request->kakao;
        $place->email = $request->email;
        $place->lat = $request->lat;
        $place->lng = $request->lng;
        $place->location = $request->location;
        $place->created_by = 'admin';
        $place->updated_by = 'admin';

        $place->save();


        $placeSubwayController = new PlaceSubwayController();
        $placeSubwayController->linkPlace($request->id,$request->subways);

        $placeTagController = new PlaceTagController();
        $placeTagController->create($request->id,$request->tags);

        $this->deleteImages($request);


        $arrImage = $imageController->create($request, 'imgs', 'place', 'admin');
        if(is_array($arrImage)){
            $mImagePlace = new ImagePlace;

            $maxSortImage = $mImagePlace->where('place_id','=',$placeId)
                ->orderby('sort','desc')
                ->first();

            $maxSort = $maxSortImage ? $maxSortImage->sort+1 : 0 ;

            foreach($arrImage as $i => $imageId){
                $mImagePlace->place_id = $placeId;
                $mImagePlace->image_id = $imageId;
                $mImagePlace->sort = $maxSort + $i;
                $mImagePlace->save();
            }
        }

        return redirect()->action('PlaceController@places');
    }
}
