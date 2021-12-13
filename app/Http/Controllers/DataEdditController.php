<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataEdditController extends Controller
{
    public function editData(Request $request)
    {
        $idSelectedCompanieRow = $request->input('id');

        session(['tester' => $request->input('id')]);
        echo $request->input('id');

        $dataCompanies = DB::table('companies')->find($idSelectedCompanieRow);
        $dataTags = DB::table('tags')->where('companie_id', $idSelectedCompanieRow)->get();

        return view('dataEddit', [
            'data' => $dataCompanies,
            'tags' => $dataTags
        ]);
    }

    public function deleteCurentCompanieAndTagsData(Request $request)
    {
        $tagsRows = DB::table('tags')->where('companie_id', '=', session('tester'))->delete();
        $companieRow = DB::table('companies')->where('id', '=', session('tester'))->delete();
        $request->session()->forget('tester');
    }

    public function updateCompanieData(Request $request)
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
    }

    public function updateTagsData(Request $request)
    {
        $request->validate([
            'tags'=>'required'
        ]);

        $explodedTags = explode(" ", $request->input('tags'));

        foreach ($explodedTags as $tag) {
            $query = DB::table('tags')->insert([
                'companie_id'=>session('companieIdLastRowInserted'),
                'name'=>$tag
            ]);
        }

        $request->session()->forget('companieIdLastRowInserted');
    }

    public function updateCompanieAndTagsData(Request $request)
    {
        self::deleteCurentCompanieAndTagsData($request);
        self::updateCompanieData($request);
        self::updateTagsData($request);
        return redirect('/home');
    }
}
