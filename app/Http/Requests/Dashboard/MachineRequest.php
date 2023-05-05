<?php

namespace App\Http\Requests\Dashboard;

use Illuminate\Foundation\Http\FormRequest;

class MachineRequest extends FormRequest
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
            'name' => 'required',
            'machine_type_id' => 'required',
            'status' => 'required'
        ];
    }

    public function messages()
    {
        $messages = [
            'name.required' =>  trans('admin.error_message.name_required'),
            'machine_type_id.required' =>  trans('admin.error_message.machine_type_id_required'),
            'status.required' =>  trans('admin.error_message.status_required'),

        ];
   
        return $messages;
    }
}
