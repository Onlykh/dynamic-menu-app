<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    /**
     * Auth
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        $credentials = request(['email', 'password']);
        if (Auth::attempt($credentials)) {
            return  response(
                [
                    'status' => 'success',
                    'result' => Auth::user()
                ],
                200
            );
        }

        return  response(
            [
                'status' => 'failed',
                'result' => 'Wrong Password Or email'
            ],
            200
        );
    }
    /**
     * Auth
     *
     * @return \Illuminate\Http\Response
     */
    public function logout()
    {
        Session::flush();
        Auth::logout();
    }
}
