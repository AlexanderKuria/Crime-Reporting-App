<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Admin;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }

    public function index()
    {
        return view('admin.dashboard');
    }

    public function editProfile(Admin $admin)
    {
        if ($admin->id != Auth::guard('admin')->user()->id)
            return redirect()->back()->with('error', 'The operation is not authorized');

        return view('admin.profile', ['admin' => $admin]);
    }

    public function updateProfile(Request $request, Admin $admin)
    {
        if ($admin->id != Auth::guard('admin')->user()->id)
            return redirect()->back()->with('error', 'The operation is not authorized');
        
        $this->validate($request, [
            'name' => 'required',
        ]);

        $admin->update(['name' => $request->input('name')]);

        return redirect(route('admin.profile', $admin->id))->with('message', 'Updated details successfully');
    }

    public function logout()
    {
        Auth::guard('admin')->logout();
        return redirect(route('admin.login'))->with('message', 'Ended session successfully.');
    }
}
