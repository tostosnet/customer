<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'surname'           => 'required',
            'first_name'        => 'required',
            "second_name"       => '',
            'phone_number'      => 'required',
            "phone_number2"     => '',
            "street"            => 'required',
            "city"              => 'required',
            'state'             => 'required',
            'marital_status'    => 'required',
            'id_type'           => 'required',
            'id_number'         => 'required',
            'id_issue_date'     => 'required',
            'id_expiry_date'    => ''
        ];
    }
}
