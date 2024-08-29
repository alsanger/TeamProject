<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showSignIn()
    {
        return view('auth.signin', ['hideHeader' => true]);
    }

    public function showSignUp()
    {
        return view('auth.signup', ['hideHeader' => true]);
    }
}
