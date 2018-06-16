<?php
/**
 * Created by PhpStorm.
 * User: inhong
 * Date: 2018. 2. 25.
 * Time: PM 10:58
 */

include_once "Customer.php";

use App\Place;

class CustomerPlace extends Customer
{
    public static function routes(){
        Customer::get(self::BASE_PATH.'places/{id}/location', function($id=0){

            $mPlace = new Place;
            $place = $mPlace->find($id);

            return view('customer.place.location'
                ,['place' => $place]);
        });

        Customer::get(self::BASE_PATH.'places/{id}', function($id=0){

            $mPlace = new Place;
            $place = $mPlace->find($id);

            return view('customer.place.view'
                ,['place' => $place]);
        })->name('customer.places/{id}');
    }
}