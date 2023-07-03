<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
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
            'name' => ['required', 'unique:restaurants,name', 'max:100'],
            'price' => ['required', 'min:0'],
            'image' => ['nullable'],
            'description' => ['nullable'],
            'visible' => ['required'],
            'restaurant_id' => ['required', 'exists:restaurants,id'],

        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Il campo 'nome' è obbligatorio",
            'name.unique' => "Il campo 'nome' inserito è già stato utilizzato.",
            'name.max' => "Il campo 'nome' deve contenere al massimo :max caratteri",
            'price.required' => "Il campo 'prezzo' è obbligatorio",
            'price.min' => "Il campo 'prezzo' deve essere maggiore di :min",
            'visible.required' => "Il campo 'visible' è obbligatorio",
        ];
    }
}
