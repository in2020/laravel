<?php
/**
 * Created by PhpStorm.
 * User: in202_000
 * Date: 2018-01-06
 * Time: 오후 7:40
 */

include_once "Admin.php";

use App\Place;
use App\Activity;
use App\ActivityType;
use App\Image;

class AdminActivity extends Admin
{
    const BASE_PATH = parent::BASE_PATH;

    public static function routes()
    {
        Admin::get(self::BASE_PATH.'/activities','ActivityController@activities')->name('admin.activities');

        Admin::get(self::BASE_PATH.'/activity/{id?}',function($id=0){
            $mPlace = new Place;
            $mActivity = new Activity;
            $mImage = new Image;
            $mActivityType = new ActivityType;

            if(isset($_GET['place_id'])){
                $place = $mPlace::find($_GET['place_id']);
            }else{
                $place = null;
            }

            $activity = $mActivity::find($id);

            $validation = array('price'=>['regex'=>'^(0|[1-9][0-9]*)$','alert'=>'숫자만 입력 해주세요.']);


            return view('admin.activity.view'
                       ,['place' => $place
                        ,'activity' => $activity
                        ,'activityType' => $mActivityType->all()
                        ,'validation' => $validation]);
        })->name('admin.activity');

        Route::post(self::BASE_PATH.'/activity', 'ActivityController@insertActivity');
        Route::put(self::BASE_PATH.'/activity', 'ActivityController@updateActivity');
    }
}