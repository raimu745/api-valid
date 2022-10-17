<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FlightController extends Controller
{
    function demo(){

        // Session::put('data','i am storing data through session');

        // dd($request->session()->all());
        // dd(session()->all());
      $a = 'hello';
      return redirect('/')->with('msg','you are champion');

    }
}
