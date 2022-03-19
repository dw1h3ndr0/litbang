<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use App\Models\User;
use App\Models\Setting;
use App\Models\Riset;
use App\Models\Kategori;

class DashboardController extends Controller
{
    public function index()
    {
        
        if(Auth::user()->wilayah_id == '1'){
            // $data_riset = Riset::all();
    	    $data_riset = Riset::where('wilayah_id','>=','1');
        }else{
            $data_riset = Riset::where('wilayah_id', Auth::user()->wilayah_id);
        }

        $totalRiset = $data_riset->count();
        // dd($data_riset);

	    $yearRiset = $data_riset->select(
            \DB::raw("COUNT(case when created_by = '2' then 1 end) as admbapeda"),
            \DB::raw("COUNT(case when created_by = '4' then 1 end) as oprbapeda"), 
            \DB::raw("COUNT(case when created_by = '3' then 1 end) as admkesbang"), 
            \DB::raw("COUNT(case when created_by = '5' then 1 end) as oprkesbang"),
            \DB::raw("COUNT(*) as totalRiset"))
            ->whereYear('created_at','=',date('Y'))
            ->get();

        $monthRiset = $data_riset->select(
            \DB::raw("COUNT(case when created_by = '2' then 1 end) as admbapeda"),
            \DB::raw("COUNT(case when created_by = '4' then 1 end) as oprbapeda"), 
            \DB::raw("COUNT(case when created_by = '3' then 1 end) as admkesbang"), 
            \DB::raw("COUNT(case when created_by = '5' then 1 end) as oprkesbang"),
            \DB::raw("COUNT(*) as totalRiset"))
            ->whereMonth('created_at', Carbon::now()->month)
            ->get();

        $weekRiset = $data_riset->select(
            \DB::raw("COUNT(case when created_by = '2' then 1 end) as admbapeda"),
            \DB::raw("COUNT(case when created_by = '4' then 1 end) as oprbapeda"), 
            \DB::raw("COUNT(case when created_by = '3' then 1 end) as admkesbang"), 
            \DB::raw("COUNT(case when created_by = '5' then 1 end) as oprkesbang"),
            \DB::raw("COUNT(*) as totalRiset"))
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();

        $day1Riset = $data_riset->whereDate('created_at',[Carbon::now()->startOfWeek()])->count();
        $day2Riset = $data_riset->whereDate('created_at',[Carbon::now()->startOfWeek()->addDays(1)])
        				->count();
        $day3Riset = $data_riset->whereDate('created_at',[Carbon::now()->startOfWeek()->addDays(2)])
        				->count();
        $day4Riset = $data_riset->whereDate('created_at',[Carbon::now()->startOfWeek()->addDays(3)])
        				->count();
        $day5Riset = $data_riset->whereDate('created_at',[Carbon::now()->startOfWeek()->addDays(4)])
        				->count();
        $day6Riset = $data_riset->whereDate('created_at',[Carbon::now()->startOfWeek()->addDays(5)])
        				->count();
        $day7Riset = $data_riset->whereDate('created_at',[Carbon::now()->endOfWeek()])->count();

        if(Auth::user()->wilayah_id == '1'){
            $penyelenggara = Riset::select(
                \DB::raw("COUNT(case when NOW() < tgl_mulai then 1 end) as belum"),
                \DB::raw("COUNT(case when (NOW() >= tgl_mulai) AND (NOW() <= tgl_selesai) then 1 end) as proses"), 
                'penyelenggara',
                \DB::raw("COUNT(case when NOW() > tgl_selesai then 1 end) as selesai"),
                \DB::raw("COUNT(*) as total"))
                ->groupBy('penyelenggara')
                ->get();

            $sumber_dana = Riset::select(
                \DB::raw("COUNT(*) as total"))
                ->groupBy('sumber_dana')
                ->get();

            $kategori = Riset::select('kategori_id')->get();
        }else{
            $penyelenggara = Riset::select(
                \DB::raw("COUNT(case when NOW() < tgl_mulai then 1 end) as belum"),
                \DB::raw("COUNT(case when (NOW() >= tgl_mulai) AND (NOW() <= tgl_selesai) then 1 end) as proses"), 
                'penyelenggara',
                \DB::raw("COUNT(case when NOW() > tgl_selesai then 1 end) as selesai"),
                \DB::raw("COUNT(*) as total"))
                ->where('wilayah_id', Auth::user()->wilayah_id)
                ->groupBy('penyelenggara')
                ->get();

            $sumber_dana = Riset::select(
                \DB::raw("COUNT(*) as total"))
                ->where('wilayah_id', Auth::user()->wilayah_id)
                ->groupBy('sumber_dana')
                ->get();

            $kategori = Riset::select('kategori_id')
                ->where('wilayah_id', Auth::user()->wilayah_id)
                ->get();
        }

        $data = [];

        $data['totalRiset'] = $totalRiset;
        $data['yearRiset'] = $yearRiset[0]['totalRiset'];
        $data['monthRiset'] = $monthRiset[0]['totalRiset'];
        $data['weekRiset'] = $weekRiset[0]['totalRiset'];

        $data['day1Riset'] = $day1Riset;
        $data['day2Riset'] = $day2Riset;
        $data['day3Riset'] = $day3Riset;
        $data['day4Riset'] = $day4Riset;
        $data['day5Riset'] = $day5Riset;
        $data['day6Riset'] = $day6Riset;
        $data['day7Riset'] = $day7Riset;


        foreach ($penyelenggara as $row) {
            $data['penyelenggara_label'][] = $row->penyelenggara;
            $data['penyelenggara_belum'][] = $row->belum;
            $data['penyelenggara_proses'][] = $row->proses;
            $data['penyelenggara_selesai'][] = $row->selesai;
            $data['penyelenggara_total'][] = $row->total;
        }
        
        foreach ($kategori as $key) {        
            $data['kategori'][] = Str::of($key->kategori_id)->explode(',');
        }

        // $data_kategori = Kategori::all();
        $data_kategori = Kategori::whereNotNull('name')->get();
        foreach ($data_kategori as $key) {
            $data['kategori_label'][] =  $key->name;
            $count = 0;
            for($i=0; $i<count($data['kategori']); $i++){
                if(count($data['kategori'][$i]) == 1){                    
                    if($key->id == $data['kategori'][$i][0]){
                        $count++;
                    }
                }else{
                    for($j=0; $j<count($data['kategori'][$i]); $j++){
                        if($key->id == $data['kategori'][$i][$j]){
                            $count++;
                        }   
                    }
                }
            }
            $data['kategori_total'][] = $count; 
        }

        $data['dalamNegeri'] = $sumber_dana[0]['total'];
        $data['luarNegeri'] = $sumber_dana[1]['total'];          

        // dd($data);

	    $firstOfMonth = Carbon::now()->firstOfMonth();
        $lastOfMonth = Carbon::now()->lastOfMonth();

        for($i = $firstOfMonth; $i <= $lastOfMonth; $i->addDays(1)){
            // echo $i->format("Y-m-d");
            $data['labelMonth'][] = $i->format("d-m-Y");
            // $data['dataMonth'][] = $data_riset->whereDate('created_at', $i)->count();

            //khusus karena ga bisa pake $data_riset
            if(Auth::user()->wilayah_id == '1'){
                $data['dataMonth'][] = Riset::whereDate('created_at', $i)->count();                
            }else{
                $data['dataMonth'][] = Riset::where('wilayah_id', Auth::user()->wilayah_id)->whereDate('created_at', $i)->count();
            }

        }  

        $firstOfYear = Carbon::now()->firstOfYear();
        $lastOfYear = Carbon::now()->lastOfYear();

        for($i = $firstOfYear; $i <= $lastOfYear; $i->addMonth(1)){
            // echo $i->format("Y-m-d");
            $data['labelYear'][] = $i->format("M");
            // $data['dataYear'][] = $data_riset->whereMonth('created_at', $i->format("m"))->count();

            //khusus karena ga bisa pake $data_riset
            if(Auth::user()->wilayah_id == '1'){
                $data['dataYear'][] = Riset::whereMonth('created_at', $i->format("m"))->count();
            }else{
                $data['dataYear'][] = Riset::where('wilayah_id', Auth::user()->wilayah_id)->whereMonth('created_at', $i->format("m"))->count();
            }

        }  

        if(Auth::user()->wilayah_id == '1'){
            $users = User::all()->sortByDesc('last_login');
        }else{
            $users = User::where('wilayah_id', Auth::user()->wilayah_id)->get()->sortByDesc('last_login');
        }

        $data['users'] = $users;

        $data['dashboard'] = json_encode($data);

        $data['setting'] = Setting::first();
    	// dd($data['setting']->site_title);
    	return view('dashboard.index', $data)->with('data',$data);
    }
}
