<?php

namespace App\Http\Controllers;

use DB;
use App\Models\Tag;
use Illuminate\Http\Request;
use App\Models\Companie;

class DataVieuwController extends Controller
{
    public function showData()
    {
        $dataCompanies = Companie::with('tag')->get(); 

        return view('dataVieuw', [
            'data' => $dataCompanies
        ]);
    }
}
