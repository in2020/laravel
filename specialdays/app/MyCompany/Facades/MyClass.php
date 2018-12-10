<?php

namespace App\MyCompany\Facades;

use Illuminate\Support\Facades\Facade;

class MyClass extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'MyClass';
    }
}