<?php
/**
 * Created by PhpStorm.
 * User: inhong
 * Date: 2018. 2. 25.
 * Time: PM 2:48
 */

include_once "Customer.php";

use App\Activity;

class CustomerActivity extends Customer
{
    public static function routes(){
        Customer::get(self::BASE_PATH.'activities/{id}', function($id=0){

            $mActivity = new Activity;
            $activity = $mActivity->find($id);

            switch($activity->activity_type_id){
                case 1:
                    $typeIcon = '/images/icon-drawing-l@2x.png';
                    break;
                case 2:
                    $typeIcon = '/images/icon-drawing-l@2x.png';
                    break;
                case 3:
                    $typeIcon = '/images/icon-mud@2x.png';
                    break;
                case 4:
                    $typeIcon = '/images/icon-wood@2x.png';
                    break;
                case 5:
                    $typeIcon = '/images/icon-drawing-l@2x.png';
                    break;
                case 6:
                    $typeIcon = '/images/icon-drawing-l@2x.png';
                    break;
                default:
                    $typeIcon = '/images/icon-drawing-l@2x.png';
                    break;

            }


            return view('customer.activity.view'
            ,['activity' => $activity
              ,'typeIcon'=> $typeIcon   ]);
        })->name('customer.activity/{id}');
    }


}