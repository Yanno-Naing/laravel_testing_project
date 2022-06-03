<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TourBookingRequest extends FormRequest
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
            'email' => 'required|email:rfc,dns',
            'phone_no' => 'bail|required|regex:/^([0-9]*)$/|digits:11',
            'from_date' => 'required|date',
            'to_date' => 'required|date|after:from_date',
            'num_of_ppl' => 'required|integer|between:1,20',
            'tour' => 'nullable',
            'contact' => 'required',
            'contact.*' => 'in:phone,email,other',
            'tour_image' => 'required|file|mimes:pdf,xlsx,png,jpeg,jpg|max:10240'
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'The :attribute field is required.',
        ];
    }
}
