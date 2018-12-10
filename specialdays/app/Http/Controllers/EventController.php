<?php

namespace App\Http\Controllers;

use App\Events\Event;
use Illuminate\Http\Request;


class EventController extends Controller
{
    //
    public function index()
    {
        event(new Event());
        return 'event';
    }
}
