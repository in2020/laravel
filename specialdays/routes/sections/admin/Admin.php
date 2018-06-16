<?php
/**
 * Created by PhpStorm.
 * User: in202_000
 * Date: 2018-01-06
 * Time: 오후 7:17
 */

class Admin
{
    const BASE_PATH = '';

    public static function routes(){
        Admin::get(self::BASE_PATH, function () {
            return view('admin.index');
        });
/*
        Route::get(self::BASE_PATH.'/login', function () {
            return view('admin.login');
        });*/
    }

    protected static function get($path,$mix){
        return Route::get($path, $mix)->middleware('auth');
    }

}