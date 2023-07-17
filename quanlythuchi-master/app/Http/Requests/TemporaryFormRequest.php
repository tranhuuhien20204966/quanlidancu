<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TemporaryFormRequest extends FormRequest
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
            'personId' => [
                'required',
            ],
            'householdId' => [
                'nullable'
            ],
            'startDate' => [
                'required',
                'date'
            ],
            'endDate' => [
                'nullable',
                'date'
            ],
            'type' => [
                'required',
                'in:residence,absence'
            ],
            'reason' => [
                'required',
                'string'
            ],
            'beforeAddress' => [
                'nullable',
                'string'
            ]
        ];
    }
}
