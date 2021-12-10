<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataAddController extends Controller
{
    public function addDataForm()
    {
        return view('dataAdd');
    }

    public function insertIntoCompaniesTable(Request $request)
    {
        $request->validate([
            'companieName'=>'required',
            'URL'=>'required',
            'softwareSkills'=>'required',
            'email'=>'required',
            'postalCode'=>'required',
            'street'=>'required',
            'addressNumber'=>'required',
            'province'=>'required',
            'latitude'=>'required',
            'longitude'=>'required',
            'blacklisted'=>'required'
        ]);

        $companieId = DB::table('companies')->insertGetId([
            'name'=>$request->input('companieName'),
            'url'=>$request->input('URL'),
            'latitude'=>$request->input('latitude'),
            'longitude'=>$request->input('longitude'),
            'software_skils'=>$request->input('softwareSkills'),
            'blacklisted'=>$request->input('blacklisted'),
            'email'=>$request->input('email'),
            'postal_code'=>$request->input('postalCode'),
            'street'=>$request->input('street'),
            'address_number'=>$request->input('addressNumber'),
            'province'=>$request->input('province')
        ]);

        session(['companieIdLastRowInserted' => $companieId]);

        if($companieId) {
            return back()->with('success', 'Data is saved to database');
        }else{
            return back()->with('fail', 'Some thing went wrong');
        }
    }

    public function insertIntoTagsTable(Request $request)
    {
        $request->validate([
            'tags'=>'required'
        ]);

        $explodedTags = explode(" ", $request->input('tags'));

        foreach($explodedTags as $tag) {
            $query = DB::table('tags')->insert([
                'companie_id'=>session('companieIdLastRowInserted'),
                'name'=>$tag
            ]);
        }

        $request->session()->forget('companieIdLastRowInserted');
    }

    public function insertIntoDatabase(Request $request)
    {
        self::insertIntoCompaniesTable($request);
        self::insertIntoTagsTable($request);
        return redirect('/home');
    }
}
