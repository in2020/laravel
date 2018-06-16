<?php
/**
 * Created by PhpStorm.
 * User: inhong
 * Date: 2018. 3. 5.
 * Time: PM 10:46
 */

include_once "Customer.php";

class CustomerSetting extends Customer
{
    public static function routes(){
        Customer::get(self::BASE_PATH.'setting', function(){
            return view('customer.setting.index');
        })->name('customer.setting');

        Customer::get(self::BASE_PATH.'company', function(){
            return view('customer.setting.company');
        })->name('customer.company');

        Customer::get(self::BASE_PATH.'inquire', function(){
            return view('customer.setting.inquire');
        })->name('customer.inquire');
    }
}