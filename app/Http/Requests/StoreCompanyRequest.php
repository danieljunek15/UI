<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'companieName' => 'required',
            'URL' => 'required',
            'softwareSkills' => 'required',
            'email' => 'required',
            'postalCode' => 'required',
            'street' => 'required',
            'addressNumber' => 'required',
            'province' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'blacklisted' => 'required',
        ];
    }
}
