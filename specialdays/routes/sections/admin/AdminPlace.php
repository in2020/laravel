<?php
/**
 * Created by PhpStorm.
 * User: in202_000
 * Date: 2018-01-06
 * Time: 오후 7:31
 */


include_once "Admin.php";



use App\Place;
use App\Activity;
use App\Image;
use App\Subway;
use App\PlaceSubway;

class AdminPlace extends Admin
{
    const BASE_PATH = parent::BASE_PATH;

    public static function routes()
    {
        Admin::get(self::BASE_PATH.'/places','PlaceController@places');

        Admin::get(self::BASE_PATH.'/place/{id?}',function($id=0){
            $mPlace = new Place;
            $mActivity = new Activity;
            $mImage = new Image;
            $mSubway = new Subway;
            $mPlaceSubway = new PlaceSubway;

            $place = $mPlace::find($id);
            $arrImg = $place['arr_img'];
            $arrImg = explode(',',$arrImg);

            $subways = $mSubway->all()->sortBy('line');

            $validation = array('price'=>['regex'=>'^(0|[1-9][0-9]*)$','alert'=>'숫자만 입력 해주세요.'],
                'url' => ['regex'=>'^(file|gopher|news|nntp|telnet|https?|ftps?|sftp):\/\/([a-z0-9-]+\.)+[a-z0-9]{2,4}.*$','alert'=>'URL 형식으로 입력 해주세요.'],
                'phoneNumber'=>['regex'=>'^(\+\d{1,3}\s)?\(?\d{3,4}\)?[\s.-]\d{3,4}[\s.-]\d{4}$','alert'=>'전화번호 형식으로 입력 해주세요.'],
                'email'=>['regex'=>'^[a-zA-Z0-9.!#$%&\'*+/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$','alert'=>'이메일 형식으로 입력 해주세요.']);

            $query="
            SELECT GROUP_CONCAT(tag) AS tags
              FROM place_tag
              WHERE place_id = '{$id}'";
            list($tags) = DB::select($query);
            $tags = $tags->tags;
            if($tags == null)$tags='';

            return view('admin.place.view'
                        ,['place' => $place
                        , 'activities' => $mActivity->where('place_id',$id)->get()
                        , 'profileImg' => $mImage->find($place['profile_img'])
                        , 'subways' => $subways
                        , 'placeSubways' => $mPlaceSubway->where('place_id',$id)->get()
                        , 'tags' => $tags
                        , 'validation' => $validation]);
        })->name('admin.place');

        Route::post(self::BASE_PATH.'/place', 'PlaceController@insertPlace');
        Route::put(self::BASE_PATH.'/place', 'PlaceController@updatePlace');

    }
}