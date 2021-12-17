<?php

namespace App\Http\Controllers;
 
use App\Http\Requests\StoreCompanyRequest;
use App\Models\Company;
use App\Models\Tag;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $companyData = array(
            'name' => $request->name,
            'url' => $request->url,
            'software_skils' => $request->software_skils,
            'email' => $request->email,
            'postal_code' => $request->postal_code,
            'street' => $request->street,
            'address_number' => $request->address_number,
            'province' => $request->province,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'blacklisted' => $request->blacklisted
        );

        $companyId = Company::create($companyData);
        
        $tagsData = explode(",", $request->tags);
        
        foreach($tagsData as $tag) {
            $tagsInsertArray = array(
                'companie_id' => $companyId->id,
                'name' => $tag
            );
            $tagId = Tag::create($tagsInsertArray);
        }
        return redirect('/data');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        return view('dataAdd');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        $dataCompanies = Company::with('tag')->get(); 

        return view('dataVieuw', [
            'data' => $dataCompanies
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, $id)
    {
        $dataCompanies = Company::find($id);
        
        return view('dataEddit', [
            'data' => $dataCompanies,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company, $id)
    {
        $companyData = array(
            'name' => $request->name,
            'url' => $request->url,
            'software_skils' => $request->software_skils,
            'email' => $request->email,
            'postal_code' => $request->postal_code,
            'street' => $request->street,
            'address_number' => $request->address_number,
            'province' => $request->province,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'blacklisted' => $request->blacklisted
        );
        

        $dataCompanies = Company::whereId($id)->update($companyData);

        $tagsDeleteQuerry = Tag::where('companie_id', $id)->delete();

        $tagsData = explode(",", $request->tags);

        foreach($tagsData as $tag) {
            $tagsInsertArray = array(
                'companie_id' => $id,
                'name' => $tag
            );
            $tagId = Tag::create($tagsInsertArray);
        }

        return redirect('/data');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $company
     * @return \Illuminate\Http\Response
     */
    
    public function destroy($id)
    {
        $company = Company::find($id);
        $company->tag()->delete();

        $deleted = $company->delete();

        if($deleted) {
            return back()->with('success', 'company is deleted');
        }

        return back()->with('fail', 'Some thing went wrong');
        return redirect('/data');
    }
}
