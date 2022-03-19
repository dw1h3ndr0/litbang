<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Kategori;

class KategoriController extends Controller
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
        		'name' => 'required',
                'description' => 'nullable',        		
        	],
            $messages = [
                'required' => 'rincian :attribute tidak boleh kosong',   
            ]
        );

        if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{
    		//insert ke tabel kategoris
    		try{
    			$kategori = new \App\Models\Kategori;
    			$kategori->name = $request->name;
    			$kategori->description = $request->description;
    			$kategori->save();

    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}
    	}

        return redirect('setting')->withSuccessMessage('Kategori berhasil ditambahkan');
    }

    public function update(Request $request, Kategori $kategori)
    {
    	$validator = Validator::make($request->all(),
            [
        		'name' => 'required',
                'description' => 'nullable',        		
        	],
            $messages = [
                'required' => 'rincian :attribute tidak boleh kosong',   
            ]
        );

        if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{
    		// insert ke tabel kategoris
    		try{

    			$kategori->name = $request->name;
    			$kategori->description = $request->description;
    			$kategori->save();

    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}
    	}

        return redirect('setting')->withSuccessMessage('Kategori berhasil diedit');
    }
    
    public function destroy(Kategori $kategori)
    {
    	//delete kategori
    	// dd($kategori);

        // $data = [];
        // $riset_kategori = Riset::select('kategori_id')->get();
        // foreach ($riset_kategori as $key) {        
        //     $data['riset_id'][] = 
        //     $data['kategori'][] = Str::of($key->kategori_id)->explode(',');
        // }

        // $data_kategori = Kategori::all();
        // foreach ($data_kategori as $key) {
        //     $data['kategori_label'][] =  $key->name;
        //     $count = 0;
        //     for($i=0; $i<count($data['kategori']); $i++){
        //         if(count($data['kategori'][$i]) == 1){                    
        //             if($key->id == $data['kategori'][$i][0]){
        //                 $count++;
        //             }
        //         }else{
        //             for($j=0; $j<count($data['kategori'][$i]); $j++){
        //                 if($key->id == $data['kategori'][$i][$j]){
        //                     $count++;
        //                 }   
        //             }
        //         }
        //     }
        //     $data['kategori_total'][] = $count; 
        // }



    	// $kategori->delete($kategori);    	    	
        $kategori->name = null;
        $kategori->description = null;
        $kategori->save();
        // dd($kategori);
        return redirect('setting')->withSuccessMessage('Kategori berhasil dihapus');

    	// if ($request->ajax()){

     //        $kategori = Kategori::findOrFail($id);

     //        if ($kategori){

     //            $kategori->delete();

                // return response()->json(array('success' => true));
            // }

        // }
    }
}
