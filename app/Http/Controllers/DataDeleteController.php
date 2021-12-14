<?php

namespace App\Http\Controllers;

use App\Models\Companie;
use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class DataDeleteController extends Controller
{
    // Met deze function delete je alle data van een companie inclusief tags.
    public function deleteCompanieData(Request $request)
    {
        $companie = Companie::find($request->input('id'));
        $companie->tag()->delete();

        $deleted = $companie->delete();

        // Als de companies querry variable true is dan succes anders fail.
        if($deleted) {
            return back()->with('success', 'Companie is deleted');
        }

        return back()->with('fail', 'Some thing went wrong');
    }

    // deleteCompanieData function word aangeroepen, om dan terug te gaan naar het overzicht.
    public function deleteData(Request $request)
    {
        self::deleteCompanieData($request);
        return redirect('/home');
    }
}
