<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthwebController extends Controller
{
    public function getPassword($token)
    {
        return view('auth.reset_password', ['token' =>$token]);
    }

}
