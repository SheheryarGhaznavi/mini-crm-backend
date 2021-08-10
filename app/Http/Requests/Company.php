<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class Company extends FormRequest
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
            'name' => 'required',
            'email' => [
                            'email',
                            'unique:employees,email',
                            Rule::unique('companies','email')->ignore($this->user),
                        ],
            'logo' => 'image|dimensions:min_width=100,min_height=100',
        ];
    }
}
