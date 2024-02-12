<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function showLogin()
{
    return view('account.login');
}
public function showadminLogin()
{
    return view('account.admin-login');
}
public function showRegistration()
{
    return view('account.register');
}

public function showEmailVerification()
{
    return view('account.create-using-email');
}

public function showVerification()
{
    return view('account.verification-code');
}

public function showforgotpassowrd()
{
    return view('account.forgot-password');
}
public function verificationEmil()
{
    return view('account.verification-email');
}


}
