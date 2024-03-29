<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Setting;

class LoginController extends Controller
{
	public function index()
	{
		$setting = Setting::first();
	    return view('login.index',[
	    	'title' => 'login',
	    	'page' => 'login',
	    	'setting' => $setting
	    ]);
	}

	public function authenticate(Request $request)
	{
		$credentials = $request->validate([
			// 'username' => ['required', 'min:3', 'max:255', 'unique:users'],
			'email' => 'required|email:dns',
			'password' => 'required'
		]);

		if(Auth::attempt($credentials)){
			$request->session()->regenerate();

			return redirect()->intended('dashboard');
		}

		// return back()->withErrors([
  //           'email' => 'The provided credentials do not match our records.',
  //       ]);
		return back()->with('loginError','Login failed!');
	}

	public function logout(Request $request)
	{
		Auth::logout();

	    $request->session()->invalidate();

	    $request->session()->regenerateToken();

	    return redirect('login');
	}
}
