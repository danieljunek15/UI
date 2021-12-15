<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataLoginController extends Controller
{
    public function loginView()
    {
        return view('login');
    }

    public function loginLogica(Request $request)
    {
        $request->validate([
            'userName'=>'required',
            'userPassword'=>'required'
        ]);

        
    }
}
