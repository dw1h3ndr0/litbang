<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Riset;
use DateTime;

class RisetController extends Controller
{
    public function index()
    {
    	if (session( 'success_message')){    		
	    	Alert::success('Berhasil', session('success_message'));
    	}
    	if (session('eror')){
    		Alert::error('Gagal', session('eror'));
    	}

        $data_riset = \App\Models\Riset::all();

    	return view('riset.index',[
            'data_riset' => $data_riset,
        ]);
    }

    public function create()
    {
    	return view('riset.create');
    }

    public function store(Request $request)
    {
    	$validator = Validator::make($request->all(),
            [
        		'judul' => 'required',
        		'tahun' => 'required',
        		'pelaksana' => 'required',
                'ktp' => 'max:1024|mimes:pdf,jpg,png',
                'proposal' => 'max:10240|mimes:pdf',
        	],
            $messages = [
                'required' => 'rincian :attribute tidak boleh kosong', 
                'mimes' => 'Format file yang dibolehkan adalah pdf', 
                'max' => 'ukuran file maksimum adalah 10MB',    
            ]
        );

    	
    	if($validator->fails()){
    		Alert::error('Gagal', 'Terdapat eror');
    		$validator->validate();
    	}else{

    		//insert ke tabel risets
    		try{
    			$riset = new \App\Models\Riset;
	    		$riset->tahun = $request->tahun;
	    		$riset->judul = $request->judul;
                
                $slug = Str::slug($request->judul, '-');
                $i=1;
                do{
                    if(Riset::where('slug', $slug)->exists()){
                        $slug = Str::slug($request->judul, '-')."(".$i.")";
                        $i++;
                    }
                }while(Riset::where('slug', $slug)->exists());

                $riset->slug = $slug;

	    		$riset->pelaksana = $request->pelaksana;
                $riset->nik = $request->nik;            
	    		$riset->no_surat_izin = $request->no_surat_izin;	    		
                $riset->tgl_surat_izin = $this->getTanggal($request->tgl_surat_izin);

                // menyimpan file yang diupload ke storage
                if($request->hasFile('ktp')){
                    $file_ktp = $request->file('ktp');
                    $nama_ktp = time()."_".$file_ktp->getClientOriginalName();
                    $folder_ktp = uniqid().'-'.now()->timestamp;
                    $riset->ktp = $file_ktp->storeAs('ktp/'.$folder_ktp, $nama_ktp);    
                }

                if($request->hasFile('proposal')){
                    $file = $request->file('proposal');
                    $nama_file = time()."_".$file->getClientOriginalName();
                    $folder = uniqid().'-'.now()->timestamp;
                    $riset->proposal = $file->storeAs('files/'.$folder, $nama_file);    
                }

	    		$riset->abstrak = $request->abstrak;
                $riset->created_by = auth()->user()->id;
	    		$riset->save();
    		}catch(\Exception $exception){
    			Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
    			$validator->validate();
    		}
		}
        // dd($riset);

        return redirect('riset')->withSuccessMessage('Riset berhasil ditambahkan');
    }

    public function show(Riset $riset)
    {
        // $riset = \App\Models\Riset::findOrFail($id);
        return view('riset.show', ['riset' => $riset]);
    }

    public function edit(Riset $riset)
    {
        // $riset = \App\Models\Riset::findOrFail($id);
        return view('riset.edit', ['riset' => $riset]);
    }

    public function update(Request $request, Riset $riset)
    {
        $validator = Validator::make($request->all(),
            [
                'judul' => 'required',
                'tahun' => 'required',
                'pelaksana' => 'required',
                'ktp' => 'max:1024|mimes:pdf,jpg,png',
                'proposal' => 'max:10240|mimes:pdf',
            ],
            $messages = [
                'required' => 'rincian :attribute tidak boleh kosong',   
                'mimes' => 'Format file yang dibolehkan adalah pdf', 
                'max' => 'ukuran file maksimum adalah 10MB',    
            ]
        );

        // dd($id);
        
        if($validator->fails()){
            Alert::error('Gagal', 'Terdapat eror');
            $validator->validate();
        }else{

            //insert ke tabel risets dengan id
            try{
                // $riset = \App\Models\Riset::findOrFail($id);
                $riset->tahun = $request->tahun;
                $riset->judul = $request->judul;

                $slug = Str::slug($request->judul, '-');
                $i=1;
                do{
                    if(Riset::where('slug', $slug)->exists()){
                        $slug = Str::slug($request->judul, '-')."(".$i.")";
                        $i++;
                    }
                }while(Riset::where('slug', $slug)->exists());

                $riset->slug = $slug;

                $riset->pelaksana = $request->pelaksana;
                $riset->nik = $request->nik;            
                $riset->no_surat_izin = $request->no_surat_izin;                
                $riset->tgl_surat_izin = $this->getTanggal($request->tgl_surat_izin);

                // menyimpan file yang diupload ke storage
                if($request->hasFile('ktp')){
                    $file_ktp = $request->file('ktp');
                    $nama_ktp = time()."_".$file_ktp->getClientOriginalName();
                    $folder_ktp = Str::beforeLast($riset->ktp,'/');
                    
                    //hapus file lama  
                    if(Storage::exists($riset->ktp)) {
                        Storage::delete($riset->ktp);
                    }

                    $riset->ktp = $file_ktp->storeAs($folder_ktp, $nama_ktp);    
                }

                if($request->hasFile('proposal')){

                    $file = $request->file('proposal');
                    $nama_file = time()."_".$file->getClientOriginalName();
                    $folder = Str::beforeLast($riset->proposal,'/');                    
                        
                    //hapus file lama  
                    if(Storage::exists($riset->proposal)) {
                        Storage::delete($riset->proposal);
                    }
                
                    $riset->proposal = $file->storeAs($folder, $nama_file);    
                }
                $riset->abstrak = $request->abstrak;
                $riset->updated_by = auth()->user()->id;
                $riset->save();
            }catch(\Exception $exception){
                Alert::error('Gagal', 'Terdapat kesalahan saat menyimpan ke database');
                $validator->validate();
            }
        }

        return redirect('riset')->withSuccessMessage('Riset berhasil diedit');
    }

    public function destroy(Riset $riset)
    {
        // $riset = \App\Models\Riset::findOrFail($id);
        
        //hapus file beserta folder        
        $folder = Str::beforeLast($riset->kuesioner,'/'); 
        if(Storage::exists($riset->kuesioner)) {
            Storage::deleteDirectory($folder);
        }

        //delete riset
        $riset->delete($riset);

        return redirect('riset')->withSuccessMessage('Riset berhasil dihapus');
    }

    public function removeFile($id)
    {
        $riset = \App\Models\Riset::findOrFail($id);

        // dd(Storage::exists($riset->kuesioner));
        //hapus file
        if(Storage::exists($riset->kuesioner)) {
            Storage::delete($riset->kuesioner);
        }

        $riset->kuesioner = NULL;
        $riset->save();

        return \Redirect::back();
    }

    public function getTanggal($tanggal)
    {
        if($this->validateDate($tanggal)){
            return $tanggal;    
        }else{
            $date = date_create_from_format("m/d/Y",$tanggal);
            return  date_format($date,"Y-m-d");         
        }
    }

    public function validateDate($date, $format = 'Y-m-d')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
}
