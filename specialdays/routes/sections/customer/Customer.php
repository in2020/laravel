<?php
/**
 * Created by PhpStorm.
 * User: inhong
 * Date: 2018. 2. 25.
 * Time: PM 2:48
 */

use App\Subway;
use App\PlaceSubway;

class Customer
{
    const BASE_PATH = '';

    public static function routes(){


        Customer::get('/', function () {

            $subways = Subway::whereIn('id',function($query){
                $query->select('subway_id')
                      ->from(with(new PlaceSubway)->getTable())
                      ->groupBy('subway_id');

            })->orderBy('name')->get();
            return view('customer.index',
                ['subways' => $subways]);
        });

    }

    protected static function get($path,$mix){
        return Route::get($path, $mix);
    }
}