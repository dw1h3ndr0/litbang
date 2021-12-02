<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {

    	$totalRiset = DB::table('risets')->count();

	    $yearRiset = \App\Models\Riset::select(
            \DB::raw("COUNT(case when created_by = '2' then 1 end) as admbapeda"),
            \DB::raw("COUNT(case when created_by = '4' then 1 end) as oprbapeda"), 
            \DB::raw("COUNT(case when created_by = '3' then 1 end) as admkesbang"), 
            \DB::raw("COUNT(case when created_by = '5' then 1 end) as oprkesbang"),
            \DB::raw("COUNT(*) as totalRiset"))
            ->whereYear('created_at','=',date('Y'))
            ->get();

        $monthRiset = \App\Models\Riset::select(
            \DB::raw("COUNT(case when created_by = '2' then 1 end) as admbapeda"),
            \DB::raw("COUNT(case when created_by = '4' then 1 end) as oprbapeda"), 
            \DB::raw("COUNT(case when created_by = '3' then 1 end) as admkesbang"), 
            \DB::raw("COUNT(case when created_by = '5' then 1 end) as oprkesbang"),
            \DB::raw("COUNT(*) as totalRiset"))
            ->whereMonth('created_at', Carbon::now()->month)
            ->get();

        $weekRiset = \App\Models\Riset::select(
            \DB::raw("COUNT(case when created_by = '2' then 1 end) as admbapeda"),
            \DB::raw("COUNT(case when created_by = '4' then 1 end) as oprbapeda"), 
            \DB::raw("COUNT(case when created_by = '3' then 1 end) as admkesbang"), 
            \DB::raw("COUNT(case when created_by = '5' then 1 end) as oprkesbang"),
            \DB::raw("COUNT(*) as totalRiset"))
            ->whereBetween('created_at', [Carbon::now()->startOfWeek(), Carbon::now()->endOfWeek()])
            ->get();

        $day1Riset = DB::table('risets')->whereDate('created_at',[Carbon::now()->startOfWeek()])->count();
        $day2Riset = DB::table('risets')->whereDate('created_at',[Carbon::now()->startOfWeek()->addDays(1)])
        				->count();
        $day3Riset = DB::table('risets')->whereDate('created_at',[Carbon::now()->startOfWeek()->addDays(2)])
        				->count();
        $day4Riset = DB::table('risets')->whereDate('created_at',[Carbon::now()->startOfWeek()->addDays(3)])
        				->count();
        $day5Riset = DB::table('risets')->whereDate('created_at',[Carbon::now()->startOfWeek()->addDays(4)])
        				->count();
        $day6Riset = DB::table('risets')->whereDate('created_at',[Carbon::now()->startOfWeek()->addDays(5)])
        				->count();
        $day7Riset = DB::table('risets')->whereDate('created_at',[Carbon::now()->endOfWeek()])->count();



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

	    $firstOfMonth = Carbon::now()->firstOfMonth();
        $lastOfMonth = Carbon::now()->lastOfMonth();

        for($i = $firstOfMonth; $i <= $lastOfMonth; $i->addDays(1)){
            // echo $i->format("Y-m-d");
            $data['labelMonth'][] = $i->format("d-m-Y");
            $data['dataMonth'][] = \App\Models\Riset::whereDate('created_at', $i)->count();

        }  

        $firstOfYear = Carbon::now()->firstOfYear();
        $lastOfYear = Carbon::now()->lastOfYear();

        for($i = $firstOfYear; $i <= $lastOfYear; $i->addMonth(1)){
            // echo $i->format("Y-m-d");
            $data['labelYear'][] = $i->format("M");
            $data['dataYear'][] = \App\Models\Riset::whereMonth('created_at', $i->format("m"))->count();

        }  

        $users = User::all()->sortByDesc('last_login');

        $data['users'] = $users;

        $data['dashboard'] = json_encode($data);

    	// dd($users);

    	return view('dashboard.index', $data)->with('data',$data);
    }
}
