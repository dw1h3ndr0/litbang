<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rules\Password;
use RealRashid\SweetAlert\Facades\Alert;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Setting;

class ChangePasswordController extends Controller
{
	/**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

	/**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(User $user)
    {
        if (session( 'success_message')){           
            Alert::success('Berhasil', session('success_message'));
        }
        if (session('eror')){
            Alert::error('Gagal', session('eror'));
        }
        // $user = \App\Models\User::find($id);
        $setting = Setting::first();
        return view('user.changePassword',[
            'setting' => $setting,
            'user' => $user]);
    } 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword($user->id)],
            'new_password' => ['required', Password::min(3)],
            'new_confirm_password' => ['same:new_password'],
        ]);
   
        // $user = User::find($id);
        $user->update(['password'=> Hash::make($request->new_password)]);
        // dd('Password change successfully.');
        
        Alert::success('Berhasil', 'Password berhasil diganti');
        return redirect('dashboard');
    }
}
