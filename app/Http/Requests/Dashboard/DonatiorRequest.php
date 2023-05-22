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
            $files = request()->isMethod('PATCH') ? 'nullable' : 'required|array|min:1|mimes:jpeg,jpg,png,gif,svg|max:8000';

        return [
            'start_date' => 'required|date|before:end_date',
            'end_date' =>   'required|date|after:start_date',
            'collection_date' => 'required|date',
            'name' => 'required',
            'price' => 'required',
            'address' => 'required',
            'donator_id' => 'required',
            'party_id' => 'required',
            'files'       =>  $files
        ];
    }
    public function messages()
    {
        $messages = [
            'name.required' =>  trans('admin.error_message.name_required'),
            'start_date.required' =>  trans('admin.error_message.start_date_required'),
            'start_date.date' =>  trans('admin.error_message.start_date_date'),
            'start_date.before' =>  trans('admin.error_message.start_date_before'),
            'end_date.required' =>  trans('admin.error_message.end_date_required'),
            'end_date.date' =>  trans('admin.error_message.end_date_date'),
            'end_date.after' =>  trans('admin.error_message.end_date_after'),
            'collection_date.required' =>  trans('admin.error_message.collection_date_reduired'),
            'collection_date.date' =>  trans('admin.error_message.collection_date_date'),
            'price.required' => trans('admin.error_message.price_required'),
            'address.required' => trans('admin.error_message.address_required'),
            'donator_id.required' => trans('admin.error_message.donator_id_required'),
            'party_id.required' => trans('admin.error_message.party_id_required'),
            'files.required'       =>  trans('admin.error_message.files_required'),
            'files.array'          =>  trans('admin.error_message.files_required'),
        ];
   
        return $messages;
    }


}
