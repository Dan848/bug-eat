<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'user_email' => ['required','min:3', 'max:255'],
            'shipment_address' => ['required', 'min:4', 'max:150'],
            'total_price' => ['required', 'numeric', 'min:1'],
            'date_time' => ['required', 'date'],
            'products' => ['required', 'array'],
        ];
    }
}
