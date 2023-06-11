<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    //
    public function loginPage(){
        return view('login');
    }

    public function registerPage(){
        return view('register');
    }
    //panel
    public function dashboard(){
        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin#list');

        }
            return redirect()->route('user#user');


}
}
