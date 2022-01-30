<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Role;
use App\Models\Setting;

class UserController extends Controller
{
    public function index()
    {
    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}

        if(Auth()->user()->role_id < '4'){
            $data_user = User::all();
        }else{
            $data_user = User::where('role_id','>=','4')->get();
        }

        // dd($data_user);
        $setting = Setting::first();

    	return view('user.index',[
            'setting' => $setting,
            'data_user' => $data_user,
        ]);
    }

    public function create(Request $request)
    {
        if(Auth()->user()->role_id == '1'){            
            $data_role = Role::all();
        }elseif(Auth()->user()->role_id == '2'){
            $data_role = Role::where('id','>=','2')->get();
        }elseif(Auth()->user()->role_id == '4'){
            $data_role = Role::where('id','>=','4')->get();
        }

        $setting = Setting::first();
    	return view('user.create', [
            'setting' => $setting,
    		'data_role' => $data_role,
    		'avatar' => 'avatar-'.rand(1,5).'.png',
    	]);
    }

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(),
            [
        		'name' => 'required',
        		// 'username' => 'required|unique:App\Models\User,username',
        		'email' => 'required|email:dns|regex:/^.+@.+$/i|unique:App\Models\User,email',
        		'role' => 'required',
        		'phone' => 'regex:/^[0-9\s]*$/|nullable',
        		'nip' => 'regex:/^[0-9\s]*$/|nullable',
        		'photo' => 'image|max:1024',
        		'password' => ['required', 'confirmed', Password::min(3)],
        	],
            $messages = [
                'required' => 'rincian :attribute tidak boleh kosong',  
                'max' => 'ukuran file maksimum adalah 1MB',  
                'image' => 'Format foto yang dibolehkan adalah jpg, jpeg, png, dan bmp'
            ]
        );

        // dd($validator->validate());
    	
    	if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

    		//insert ke tabel users
    		try{
    			$user = new \App\Models\User;
	    		$user->name = $request->name;

                // if(\App\Models\User::where('username',$request->username)->exists()){
                //     if($request->username == $user->username){                      
                //         $user->username = $request->username;
                //     }else{
                //         Alert::error('Gagal', 'Username sudah digunakan');
                //         return \Redirect::back()->withError('Username sudah digunakan');
                //     }
                // }else{                  
                //     $user->username = $request->username;
                // }

                $username = Str::beforeLast($request->email,'@'); 
                $i=1;
                do{
                    if(User::where('username', $username)->exists()){
                        $username = $username."(".$i.")";
                        $i++;
                    }
                }while(User::where('username', $username)->exists());
	    		$user->username = $username;

	    		$user->email = $request->email;
	    		$user->role_id = $request->role;
	    		$user->phone = $request->phone;
	    		$user->nip = $request->nip;	    		

		    	// menyimpan foto yang diupload ke storage
	    		// dd($request->file('photo'));
	    		if($request->file('photo')){
					$file = $request->file('photo');
					$nama_file = time()."_".$file->getClientOriginalName();
					$folder = uniqid().'-'.now()->timestamp;
					$user->photo = $file->storeAs('profil/'.$folder, $nama_file);
		    	}else{
		    		$user->photo = 'profil/'.$request->avatar;
		    	}
	    		
	    		$user->password = bcrypt($request->password);
	    		$user->save();
    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}
		}

        return redirect('user')->withSuccessMessage('Pengguna berhasil ditambahkan');
    }

    public function show(User $user)
    {
        // $user = \App\Models\User::findOrFail($id);
        $data_role = \App\Models\Role::all();
        $setting = Setting::first();
        return view('user.show', [
            'setting' => $setting,
        	'user' => $user,
        	'data_role' => $data_role,
    		'avatar' => 'avatar-'.rand(1,5).'.png',
        ]);
    }

    public function edit(User $user)
    {
        if(Auth()->user()->role_id == '1'){            
            $data_role = Role::all();
        }elseif(Auth()->user()->role_id == '2'){
            $data_role = Role::where('id','>=','2')->get();
        }elseif(Auth()->user()->role_id == '4'){
            $data_role = Role::where('id','>=','4')->get();
        }
        
        $setting = Setting::first();
        return view('user.edit', [
            'setting' => $setting,
        	'user' => $user,
        	'data_role' => $data_role,
    		'avatar' => 'avatar-'.rand(1,5).'.png',
        ]);
    }

    public function update(Request $request, User $user)
    {

        $validator = Validator::make($request->all(),
            [
        		'name' => 'required',
        		// 'username' => 'required',
        		'email' => 'required|email|regex:/^.+@.+$/i',
        		'role' => 'required',
        		'phone' => 'regex:/^[0-9\s]*$/|nullable',
        		'nip' => 'regex:/^[0-9\s]*$/|nullable',
        		'photo' => 'image|max:1024'
        	],
            $messages = [
                'required' => 'rincian :attribute tidak boleh kosong',  
                'max' => 'ukuran file maksimum adalah 1MB',  
                'image' => 'format foto yang dibolehkan adalah jpg, jpeg, png, dan bmp'
            ]
        );
        
        if($validator->fails()){
            Alert::error('Gagal', 'Terdapat eror');
            $validator->validate();
        }else{

            //insert ke tabel users dengan id
            try{
                // $user = \App\Models\User::findOrFail($id);
	    		$user->name = $request->name;
	    		$user->role_id = $request->role;
	    		$user->phone = $request->phone;
	    		$user->nip = $request->nip;
	    		$user->is_active = $request->status;
	    		
	    		// if(\App\Models\User::where('username',$request->username)->exists()){
	    		// 	if($request->username == $user->username){	    				
		    	// 		$user->username = $request->username;
	    		// 	}else{
		    	// 		Alert::error('Gagal', 'Username sudah digunakan');
		    	// 		return \Redirect::back()->withError('Username sudah digunakan');
	    		// 	}
	    		// }else{	    			
		    	// 	$user->username = $request->username;
	    		// }

                $username = Str::beforeLast($request->email,'@'); 
                $i=1;
                do{
                    if(User::where('username', $username)->exists()){
                        $username = $username."(".$i.")";
                        $i++;
                    }
                }while(User::where('username', $username)->exists());
                $user->username = $username;

	    		if(\App\Models\User::where('email',$request->email)->exists()){
	    			if($request->email == $user->email){
	    				$user->email == $request->email;
	    			}else{	    		
		    			Alert::error('Gagal', 'Email sudah digunakan');		
		    			return \Redirect::back()->withError('Email sudah digunakan');
	    			}
	    		}else{	    			
		    		$user->email = $request->email;
	    		}

	    		// dd(Str::afterLast($user->photo,'/'));
	    		// merubah foto yang diupload ke storage
	    		if($request->file('photo')){

					$file = $request->file('photo');
					$nama_file = time()."_".$file->getClientOriginalName();

					if(substr($user->photo, 7,6) == "avatar" ){
						$folder = uniqid().'-'.now()->timestamp;					
					}else{
						$folder = Str::beforeLast($user->photo,'/');
							
						//hapus file lama  
					    if(Storage::exists($user->photo)) {
					        Storage::delete($user->photo);
					    }
					}

					//simpan file baru
					$user->photo = $file->storeAs($folder, $nama_file);
		    	}
		    	// else{
		    	// 	$user->photo = 'profil/'.$request->avatar;
		    	// }

	    		// $user->password = bcript($request->password);
	    		$user->save();

            }catch(\Exception $exception){
                Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
                $validator->validate();
            }
        }

        return redirect('user')->withSuccessMessage('Pengguna berhasil diedit');
    }

    public function destroy(User $user)
    {        
        // $user = \App\Models\User::findOrFail($id);

        //hapus file beserta folder 
        $folder = Str::beforeLast($user->kuesioner,'/'); 
        if(Storage::exists($user->photo)) {
            Storage::deleteDirectory($folder);
        }

        //delete user
        $user->delete($user);

        return redirect('user')->withSuccessMessage('Pengguna berhasil dihapus');
    }

    public function removeImage($id)
    {    	
        $user = \App\Models\User::findOrFail($id);

        // dd(Storage::exists($user->photo));
        //hapus file
        if(Storage::exists($user->photo)) {
            Storage::delete($user->photo);
        }

        $user->photo = 'profil/avatar-'.rand(1,5).'.png';
        $user->save();

        return \Redirect::back();
    }

}
