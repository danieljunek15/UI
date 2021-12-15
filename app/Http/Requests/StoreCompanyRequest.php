<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    // /**
    //  * Determine if the user is authorized to make this request.
    //  *
    //  * @return bool
    //  */
    // public function authorize()
    // {
    //     return false;
    // }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required',
            'url' => 'required',
            'software_skils' => 'required',
            'email' => 'required',
            'postal_code' => 'required',
            'street' => 'required',
            'address_number' => 'required',
            'province' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'blacklisted' => 'required',
        ];

        // return [
        //     'tags'=>'required'
        // ];
    }
}
