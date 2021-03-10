<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Police;

class PoliceResource extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function index()
    {
        $officers = Police::orderBy('created_at', 'DESC')->paginate(15);
        return view('admin.police_list', ['police' => $officers]);
    }

    public function create()
    {
        return view('admin.create_officer');
    }


    public function store(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|unique:police',
            'name' => 'required',
            'password' => 'required|min:8|confirmed'
        ]);

        $data = [
            'email' => $request->input('email'),
            'name' => $request->input('name'),
            'password' => Hash::make($request->input('password'))
        ];
        $officer = Police::create($data);
        return redirect(route('police.show', $officer->id))->with('Created account successfully');
    }


    public function show(Police $police)
    {
        return view('admin.officer_details', ['officer' => $police]);
    }


    public function edit(Police $police)
    {
        return view('admin.edit_officer', ['officer' => $police]);
    }


    public function update(Request $request, Police $police)
    {
        $this->validate($request, ['email' => 'required', 'name' => 'required']);
        if (!Police::isValidEmail($police, $request->input('email')))
            return redirect()->back()->withInput(['email', 'name'])->with('error', 'Email belongs to another user.');
        $data = [
            'email' => $request->input('email'),
            'name' => $request->input('name')
        ];

        if ($request->input('password'))
        {
            $this->validate($request, ['password' => 'confirmed|min:8']);
            $data['password'] = Hash::make($request->input('password'));
        }
        $police->update($data);

        return redirect(route('police.show', $police->id))
            ->with('message', 'Updated details successfully.');
    }


    public function destroy(Police $police)
    {
        if ($police->assignedCrimes()->count() > 0)
            return redirect(route('police.show', $police->id))
                ->with('error', 'Sorry can\'t delele, Officer has assigned crimes');

        $police->delete();
        return redirect(route('police.index'))->with('message', 'Deleted officer details successfully');
    }
}
