<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class DonatiorRequest extends FormRequest
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
            'start_date' => 'required|date|before:end_date',
            'end_date' =>   'required|date|after:start_date',
            'collection_date' => 'required|date',
            'name' => 'required',
            'price' => 'required',
            'address' => 'required',
            'donator_id' => 'required',
            'party_id' => 'required',
        ];
    }
}
