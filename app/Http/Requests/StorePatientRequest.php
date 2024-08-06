<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorePatientRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file_number' => 'required|unique:patients',
            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'gender' => 'required|string|max:10',
            'date_of_birth' => 'required|date',
            'phone_number' => 'nullable|string|max:15',
            'next_of_kin_name' => 'required|string|max:255',
            'next_of_kin_relationship' => 'required|string|max:255',
            'next_of_kin_phone_number' => 'nullable|string|max:15',
        ];
    }
}
