<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use Illuminate\Support\Facades\Redirect;

class LoginController extends Controller
{    
    /**
     * login
     *
     * @param  LoginRequest $request
     * @return void
     */
    public function login(LoginRequest $request)
    {
        if($request->all()['user_name'] == 'admin' && $request->all()['password'] == 'admin'){
            return Redirect('/log');
        }else{
            return redirect('/login')->withErrors(['msg' => 'Wrong Credintials']);
        }
    }
}
