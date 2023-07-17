<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
        'idCard'=> [
            'nullable',
            'string'
        ],
        'firstName'=> [
            'required',
            'string'
        ],
        'lastName'=> [
            'required',
            'string'
        ],
        'dateOfBirth'=> [
            'required',
            'date'
        ],
        'gender'=> [
            'required',
            'in:male,female'
        ],
        'avatar' => [
            'nullable',
            'mimes:jpg,jpeg,png'
        ],
        'email'=> [
            'nullable',
            'email'
        ],
        'numberPhone'=> [
            'nullable',
            'string'
        ],
        'ethnic'=> [
            'required',
            'string'
        ],
        'nationality'=> [
            'required',
            'string'
        ],
        'address'=> [
            'required',
            'string'
        ],
        'occupation'=> [
            'nullable',
            'string'
        ],
        'educationLevel'=> [
            'nullable',
            'string'
        ],
        'maritalStatus'=> [
            'required',
            'in:single,married'
        ],
        'status'=> [
            'required',
            'in:alive,dead'
        ]
        ];
    }
}
