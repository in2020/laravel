<?php
/**
 * Created by PhpStorm.
 * User: inhong
 * Date: 2018-12-10
 * Time: 23:31
 */

namespace App\MyCompany\Services;


class MyClass implements \App\MyCompany\Contracts\MyClass
{

    public function greet()
    {
        dd('hi');
    }
}