<?php

namespace App\Http\Controllers;

use App\Models\Companie;
use DB;
use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\Controller;
// use App\Models\Companie;
// use App\Models\Tag;

class DataEdditController extends Controller
{
    // Deze function weergeeft alle data van de geselecteerde companie.
    public function vieuwDataOpEditPage(Request $request, Companie $companie)
    {
        // Hier wordt de companie_id in een session opgeslagen.
        session(['companieIdVoorDeleteQuerry' => $request->input('id')]);

        // Querry voor de bij behoorende tags van companies.
        $dataTags = DB::table('tags')->where('companie_id', $idSelectedCompanieRow)->get();

        // Geeft alle data van een bedrijf door naar de vieuw.
        return view('dataEddit', [
            'data' => [$companie],
            'tags' => $dataTags
        ]);
    }

    // Deze function delete alle data van een bedrijf.
    public function deleteCurentCompanieAndTagsData(Request $request)
    {
        // Querry voor het delete van alle bedrijfen
        $companieRow = DB::table('companies')->where('id', '=', session('companieIdVoorDeleteQuerry'))->delete();
        // Querry voor het delete van alle tags.
        $tagsRows = DB::table('tags')->where('companie_id', '=', session('companieIdVoorDeleteQuerry'))->delete();

        // Verwijderd de session.
        $request->session()->forget('companieIdVoorDeleteQuerry');
    }

    // Deze function insert alle nieuw opgegeven data in de database.
    public function updateCompanieData(Request $request)
    {
        // Check of alle data is ingevuld door de gebruiker
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

        // Querry die alle companies data in de database opslaat.
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

        // Hier wordt een session aangemaakt, met het id van de companies tabel.
        session(['companieIdLastRowInserted' => $companieId]);
    }

    // Querry die alle tags data in de database opslaat.
    public function updateTagsData(Request $request)
    {
        // Checken of alle data er is.
        $request->validate([
            'tags'=>'required'
        ]);

        // Onderschijds tags met behulp van een spatie, en zet dit in een array.
        $explodedTags = explode(" ", $request->input('tags'));

        // Insert voor elke key => value in de array een tag voor de tags tabel, met het zelfde companie_id als id in companies.
        foreach ($explodedTags as $tag) {
            // Companie_id zit nog in de session, waarbij een tag naam komt te staan.
            $query = DB::table('tags')->insert([
                'companie_id'=>session('companieIdLastRowInserted'),
                'name'=>$tag
            ]);
        }

        // Session wordt verwijderd.
        $request->session()->forget('companieIdLastRowInserted');
    }

    // Deze function voerd alle functions in de juiste volgorde uit, en je wordt terug gestuurt naar het overzicht.
    public function updateCompanieAndTagsData(Request $request)
    {
        // Self is voor laravel een function dat hij moet zoeken voor de function in zijn eigen class.
        self::deleteCurentCompanieAndTagsData($request);
        self::updateCompanieData($request);
        self::updateTagsData($request);
        return redirect('/home');
    }
}
