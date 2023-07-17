<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReceiptFormRequest extends FormRequest
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
            'householdId' => [
                'nullable',
            ],
            'personId' => [
                'required',
            ],
            'feeId' => [
                'required',
            ],
            'amount' => [
                'required',
                'integer'
            ],
            'note' => [
                'nullable',
                'string'
            ]
        ];
    }
}
