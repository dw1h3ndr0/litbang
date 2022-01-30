<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use App\Models\Setting;
use App\Models\Kategori;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends Controller
{
    public function index()
    {
    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}

    	$setting = Setting::first();
        $data_kategori = Kategori::all();
    	return view('setting.index',[
            'setting' => $setting,
            'data_kategori' => $data_kategori
        ]);
    }

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(),
            [        		
        		'site_description' => 'required',
        		'infografis' => 'image|max:10000',
        		'banner' => 'image|max:10000',
        		'login_pick' => 'image|max:10000',
                'site_title' => 'required',
                'site_tagline' => 'required',
                'site_logo' => 'image|max:10000',
                'site_favicon' => 'image|max:10000'
        	],
            $messages = [
                'required' => 'rincian :attribute tidak boleh kosong',  
                'max' => 'ukuran file maksimum adalah 10MB',  
                'image' => 'Format gambar yang dibolehkan adalah jpg, jpeg, png, dan bmp'
            ]
        );

        if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{
    		try{
    			if(Setting::find(1) == NULL){    				
	    			$setting = new Setting;
    			}else{
    				$setting = Setting::find(1);
    			}

	    		$setting->site_description = $request->site_description;		

		    	// menyimpan foto yang diupload ke storage
	    		// dd($request->file('infografis'));
	    		if($request->file('infografis')){
					$file = $request->file('infografis');
					$nama_file = time()."_".$file->getClientOriginalName();
					$folder = uniqid().'-'.now()->timestamp;
					$setting->infografis = $file->storeAs('infografis/'.$folder, $nama_file);
		    	}
		   //  	else{
		   //  		$folder = Str::beforeLast($setting->infografis,'/');							
					// //hapus folder lama  				   
				 //    Storage::deleteDirectory($folder);
		   //  		$setting->infografis = NULL;
		   //  	}

		    	if($request->file('banner')){
					$file = $request->file('banner');
					$nama_file = time()."_".$file->getClientOriginalName();
					$folder = uniqid().'-'.now()->timestamp;
					$setting->banner = $file->storeAs('banner/'.$folder, $nama_file);
		    	}
		   //  	else{
		   //  		$folder = Str::beforeLast($setting->banner,'/');							
					// //hapus folder lama  				   
				 //    Storage::deleteDirectory($folder);				    
		   //  		$setting->banner = NULL;
		   //  	}

		    	if($request->file('login_pict')){
					$file = $request->file('login_pict');
					$nama_file = time()."_".$file->getClientOriginalName();
					$folder = uniqid().'-'.now()->timestamp;
					$setting->login_pict = $file->storeAs('login_pict/'.$folder, $nama_file);
		    	}

                $setting->site_title = $request->site_title;                
                $setting->site_tagline = $request->site_tagline;

                if($request->file('site_logo')){
                    $file = $request->file('site_logo');
                    $nama_file = time()."_".$file->getClientOriginalName();
                    $folder = uniqid().'-'.now()->timestamp;
                    $setting->site_logo = $file->storeAs('logo/'.$folder, $nama_file);
                }

                if($request->file('site_favicon')){
                    $file = $request->file('site_favicon');
                    $nama_file = time()."_".$file->getClientOriginalName();
                    $folder = uniqid().'-'.now()->timestamp;
                    $setting->site_favicon = $file->storeAs('favicon/'.$folder, $nama_file);
                }

		    	$setting->save();
	    		
    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}
    	}


        return redirect('setting')->withSuccessMessage('Pengaturan berhasil dirubah');
    }

    public function removeFile($jenis)
    {
        $setting = Setting::findOrFail(1);

        // dd(Storage::exists($setting->banner));
        //hapus file
        if($jenis == 'banner'){
            if(Storage::exists($setting->banner)) {
                $folder = Str::beforeLast($setting->banner,'/');                            
                //hapus folder lama                     
                Storage::deleteDirectory($folder);
                //hapus file lama
                Storage::delete($setting->banner);
            }
            $setting->banner = NULL;            
        }else if($jenis == 'infografis'){
            if(Storage::exists($setting->infografis)) {
                $folder = Str::beforeLast($setting->infografis,'/');                            
                //hapus folder lama                     
                Storage::deleteDirectory($folder);
                //hapus file lama
                // Storage::delete($setting->infografis);
            }
            $setting->infografis = NULL;
        }else if($jenis == 'login_pict'){
            if(Storage::exists($setting->login_pict)) {
                $folder = Str::beforeLast($setting->login_pict,'/');                            
                //hapus folder lama                     
                Storage::deleteDirectory($folder);
                //hapus file lama
                // Storage::delete($setting->login_pict);
            }
            $setting->login_pict = 'login_pict/login-bg.jpg';
        }else if($jenis == 'logo'){
            if(Storage::exists($setting->site_logo)) {
                $folder = Str::beforeLast($setting->site_logo,'/');                            
                //hapus folder lama                     
                Storage::deleteDirectory($folder);
                //hapus file lama
                // Storage::delete($setting->site_logo);
            }
            $setting->site_logo = 'logo/_Logo.png';
        }else if($jenis == 'favicon'){
            if(Storage::exists($setting->site_favicon)) {
                $folder = Str::beforeLast($setting->site_favicon,'/');                            
                //hapus folder lama                     
                Storage::deleteDirectory($folder);
                //hapus file lama
                // Storage::delete($setting->site_favicon);
            }
            $setting->site_favicon = 'favicon/_favicon.png';
        }

        $setting->save();

        return \Redirect::back();
    }
}
