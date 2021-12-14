<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class DataDeleteController extends Controller
{
    // Met deze function delete je alle data van een companie inclusief tags.
    public function deleteCompanieData(Request $request)
    {
        // Hier wordt de is opgehaald die via GET mee gegeven wordt.
        $idSelectedCompanieRow = $request->input('id');
        // De delete querry voor de companies table
        $companieRow = DB::table('companies')->delete($idSelectedCompanieRow);
        // De delete querry voor de tags table.
        $tagsRows = DB::delete('delete from tags where companie_id = ?', [$idSelectedCompanieRow]);

        // Als de companies querry variable true is dan succes anders fail.
        if($companieRow) {
            return back()->with('success', 'Companie is deleted');
        }else{
            return back()->with('fail', 'Some thing went wrong');
        }

        // Het zelfde voor de tags querry
        if($tagsRows) {
            return back()->with('success', 'Companie is deleted');
        }else{
            return back()->with('fail', 'Some thing went wrong');
        }
    }

    // deleteCompanieData function word aangeroepen, om dan terug te gaan naar het overzicht.
    public function deleteData(Request $request)
    {
        self::deleteCompanieData($request);
        return redirect('/home');
    }
}
