<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class OrderRequest extends FormRequest
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
    public function rules(Request $request): array
    {
        $rules = [
            'code'        => 'required|unique:orders',
            'description' => 'required',
            'customer_id' => 'required',
            'files'       => 'required|array|min:1'
        ];
        // For update method, add the user ID to the unique rule
        if ($this->getMethod() == 'PUT' || $this->getMethod() == 'PATCH') {
            $rules['code'] = 'required|unique:orders,code,' . $request->id;
        }

        return $rules;
    }

    public function messages()
    {
        $messages = [
            'code.required'        =>  trans('admin.error_message.code_required'),
            'description.required' =>  trans('admin.error_message.description_required'),
            'customer_id.required' =>  trans('admin.error_message.customer_id_required'),
            'files.required'       =>  trans('admin.error_message.files_required'),
            'files.array'          =>  trans('admin.error_message.files_required'),

        ];

        return $messages;
    }
}
