<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class AdminLoginController extends Controller
{
    public function __construct()
    {
        $this->middleware('guest');
        $this->middleware('guest:admin');
        $this->middleware('guest:officer');
    }
    public function showLoginForm()
    {
        return view('auth.admin_login');
    }
    public function login(Request $request)
    {
        $this->validate($request, [
            'email' => ['required', 'email'],
            'password' => ['required']
        ]);
        $data = [
            'email' => $request->input('email'),
            'password' => $request->input('password')
        ];
        if (Auth::guard('admin')->attempt($data, $request->input('remember')))
            return redirect()->intended(route('admin.dashboard'));

        return redirect()->back()->withInput(['email' => $data['email']])
            ->with('error',  'Wrong username or password');
    }
}
