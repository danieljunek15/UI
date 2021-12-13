<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Controllers\Controller;
use App\Http\Requests;

class DataDeleteController extends Controller
{
    public function deleteCompanieData(Request $request)
    {
        $idSelectedCompanieRow = $request->input('id');
        $companieRow = DB::table('companies')->delete($idSelectedCompanieRow);
        $tagsRows = DB::delete('delete from tags where companie_id = ?', [$idSelectedCompanieRow]);

        if($companieRow) {
            return back()->with('success', 'Companie is deleted');
        }else{
            return back()->with('fail', 'Some thing went wrong');
        }

        
        if($tagsRows) {
            return back()->with('success', 'Companie is deleted');
        }else{
            return back()->with('fail', 'Some thing went wrong');
        }
    }

    public function deleteData(Request $request)
    {
        self::deleteCompanieData($request);
        return redirect('/home');
    }
}
