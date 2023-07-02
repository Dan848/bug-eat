<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateRestaurantRequest extends FormRequest
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
            'name' => ['required', Rule::unique('restaurants')->ignore($this->name), 'max:100'],
            'email' => ['required', Rule::unique('restaurants')->ignore($this->email), 'max:255'],
            'p_iva' => ['required', Rule::unique('restaurants')->ignore($this->p_iva), 'max:11'],
            'phone_num' => ['required', 'unique:restaurants,phone_num', 'max:20' , 'min:10'],
            'image' => ['required'],
            'address' => ['required', 'max:255'],
            'user_id' => ['required']
        ];
    }

    public function messages()
    {
        return[
            'name.required' => "Il campo 'nome' è obbligatorio",
            'name.unique' => "Il campo 'nome' inserito è già stato utilizzato.",
            'name.max' => "Il campo 'nome' deve contenere al massimo :max caratteri",
            'email.required' => "Il campo 'email' è obbligatorio",
            'email.unique' => "Il campo 'email' inserito è già stato utilizzato.",
            'email.max' => "Il campo 'email' deve contenere al massimo :max caratteri",
            'p_iva.required' => "Il campo 'p_iva' è obbligatorio",
            'p_iva.unique' => "Il campo 'p_iva' inserito è già stato utilizzato.",
            'p_iva.max' => "Il campo 'p_iva' deve contenere al massimo :max caratteri",
            'image.required' => "Il campo 'p_iva' è obbligatorio",
            'address.required' => "Il campo 'address' è obbligatorio",
            'address.max' => "Il campo 'address' deve contenere al massimo :max caratteri",
            'user_id.required' => "Il campo 'Utente' è obbligatorio",
        ];
    }
}
