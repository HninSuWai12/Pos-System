<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomePageController extends Controller
{
    //
    public function list(){
        return view('User.user');
    }
}
