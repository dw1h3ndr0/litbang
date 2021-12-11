<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\Riset;

class ApiController extends Controller
{
    public function all()
    {
        $risetCollection = Riset::get();
        
        return response()->json([
            'success' => true,
            'data' => $risetCollection
        ],200);

    }

    }
