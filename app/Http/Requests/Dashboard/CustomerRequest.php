<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class CustomerRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'whatsapp' => 'required',
            'address' => 'required',

        ];
    }
    public function messages()
    {
        $messages = [
            'email.required' =>  trans('admin.error_message.email_required'),
            'name.required' =>  trans('admin.error_message.name_required'),
            'phone.required' =>  trans('admin.error_message.phone_required'),
            'whatsapp.required' =>  trans('admin.error_message.whatsapp_required'),
            'address.required' =>  trans('admin.error_message.address_required'),

        ];
   
        return $messages;
    }
}
