<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBill extends FormRequest
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
            'name' => 'required|max:255',
            'money' => 'required|numeric|between:1,100000',
            'startDate' => 'required|date',
            'endDate' => 'required|date|gte:startDate',
            'note' => 'nullable|max:255',
        ];
    }
}
