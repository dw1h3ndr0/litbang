<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Setting;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
	{
		$setting = Setting::first();
	    return view('register.index',[
	    	'setting' => $setting,
	    	'page' => 'register',
	    	'title' => 'register'
	    ]);
	}

	public function store(Request $request)
	{
		$validatedData = $request->validate([
			'name' => 'required|max:255',
			'username' => ['required', 'min:3', 'max:255', 'unique:users'],
			'email' => 'required|email|unique:users',
			'password' => 'required|min:3|max:255'
		]);

		// $validatedData['password'] = bcrypt($validatedData['password']);
		$validatedData['password'] = Hash::make($validatedData['password']);
		$validatedData['role_id'] = 6;
		$validatedData['photo'] = 'profil/avatar-'.rand(1,5).'.png';

		User::create($validatedData);

		// $request->session()->flash('success','Registration success! Please login');

		return redirect('login')->with('success','Registration successfull! Please login');

	}
}
