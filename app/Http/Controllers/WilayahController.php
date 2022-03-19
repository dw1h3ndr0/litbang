<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Wilayah;

class WilayahController extends Controller
{
    public function index(){
    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}
    }

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(),
            [
        		'kode' => 'required',
                'wilayah' => 'required',        		
        	],
            $messages = [
                'required' => 'rincian :attribute tidak boleh kosong',   
            ]
        );

        if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{
    		//insert ke tabel Wilayahs
    		try{
    			$wilayah = new \App\Models\Wilayah;
    			$wilayah->kode = $request->kode;
    			$wilayah->wilayah = $request->wilayah;
    			$wilayah->save();

    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}
    	}

        return redirect('setting')->withSuccessMessage('Wilayah berhasil ditambahkan');
    }

    public function update(Request $request, Wilayah $wilayah)
    {
    	$validator = Validator::make($request->all(),
            [
        		'kode' => 'required',
                'wilayah' => 'required',        		
        	],
            $messages = [
                'required' => 'rincian :attribute tidak boleh kosong',   
            ]
        );

        if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{
    		// insert ke tabel Wilayahs
    		try{

    			$wilayah->kode = $request->kode;
    			$wilayah->wilayah = $request->wilayah;
    			$wilayah->save();

    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}
    	}

        return redirect('setting')->withSuccessMessage('Wilayah berhasil diedit');
    }
    
    public function destroy(Wilayah $wilayah)
    {
    	//delete Wilayah
    	$wilayah->delete($wilayah);    	    	
        return redirect('setting')->withSuccessMessage('Wilayah berhasil dihapus');
    }
}
