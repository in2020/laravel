<?php

namespace App\Http\Controllers;

use App\MyCompany\Facades\MyClass;

class MyController extends Controller
{
    public function index()
    {
        MyClass::greet();
    }
}