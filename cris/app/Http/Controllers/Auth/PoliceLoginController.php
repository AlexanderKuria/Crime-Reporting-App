<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PoliceLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:officer');
    }
    public function showLoginForm()
    {
        return view('auth.police_login_form');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required'
        ]);
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];

        if (Auth::guard('officer')->attempt($data, $request->input('remember')))
            return redirect()->intended(route('police.dashboard'));

        return redirect()->back()->withInput(['email'])->with('error', 'Wrong email or password');
    }
}
