<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class HotelRequests extends FormRequest
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
            'name' => 'required|string',
            'description' => 'required|string',
            'phone' => 'required|numeric',
            'rate' => 'required|string',
            'latitude' => 'required',
            'longtude' => 'required',
            'address' => 'required',
            'hotel_url' => 'string',
        ];
    }
    public function messages()
    {
        return [
            //
        ];
    }
}
