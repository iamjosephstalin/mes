<?php

namespace App\Http\Controllers\authentications;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
  public function register()
  {
    return view('content.authentications.auth-register');
  }

  public function login()
  {
    return view('content.authentications.auth-login');
  }

  public function forgotPassword()
  {
    return view('content.authentications.auth-forgot-password');
  }

  public function logout()
  {
    return $this->login();
  }
}
