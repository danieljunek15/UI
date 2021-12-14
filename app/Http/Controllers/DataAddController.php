<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyRequest;
use App\Models\Companie;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class DataAddController extends Controller
{
    // Deze functie returnt de HTML vieuw en laat deze zien op de site.
    public function addDataForm()
    {
        return view('dataAdd');
    }

    // Deze function zorgd ervoor dat de companie data nettjes word opgeslagen, en de id van de nieuwe row in een session word opgeslagen.
    public function insertIntoCompaniesTable(StoreCompanyRequest $request)
    {
        // Dit is de querry die de data opslaat in de companie table.
        $company = Companie::create($request->all());

        // Hier word de nieuwe id in een session opgeslagen
        session(['companieIdLastRowInserted' => $company->id]);

        // Dit is een simpele if statment waar ik kijk of alles goed gaat zo niet dan geeft hij dat aan.
        if ($company->id) {
            return back()->with('success', 'Data is saved to database');
        }

        return back()->with('fail', 'Some thing went wrong');
    }

    // Deze function zorgd ervoor dat de tags gesplit worden.
    public function insertIntoTagsTable(Request $request)
    {
        // Kijken of er data is
        $request->validate([
            'tags'=>'required'
        ]);

        // Als er data is dan gaan we deze splitten op de spatcie
        $explodedTags = explode(" ", $request->input('tags'));

        // Afhankelijk van de aantal opjects in explodedTags, gaan we met foreach nieuwe rows aan maken in de tags table.
        foreach($explodedTags as $tag) {
            $query = DB::table('tags')->insert([
                // Dankzij de companie id die we eerde in een session hebben opgeslagen gaan we deze nu gebruiken bij elke nieuwe row die we aanmaken.
                'companie_id'=>session('companieIdLastRowInserted'),
                'name'=>$tag
            ]);
        }

        // Omdat we de companie id nu niet meer nodig hebben gaan we deze ook vergeten ofterwijl verwijderen/
        $request->session()->forget('companieIdLastRowInserted');
    }

    // Dit is de final function die we aan roepen als de gebruiker op submit drukt.
    // Waarom ik dit heb gedaan ? Omdat ik vind dat je beter meerdere kleine functions kan maken dan een grote voor de overzichtelijkheid.
    public function insertIntoDatabase(Request $request)
    {
        // Hier roep ik companie table insert aan.
        self::insertIntoCompaniesTable($request);
        // Hier roep ik tags table insert aan.
        self::insertIntoTagsTable($request);
        // Nu terug naar de home page voor een dierecte update van de data.
        return redirect('/home');
    }
}
