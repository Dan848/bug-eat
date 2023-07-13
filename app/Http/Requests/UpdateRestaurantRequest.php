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
            'name' => ['required', 'max:100'],
            'email' => ['required', Rule::unique('restaurants')->ignore($this->restaurant), 'min:4', 'max:255'],
            'p_iva' => ['required', Rule::unique('restaurants')->ignore($this->restaurant), 'max:11'],
            'phone_num' => ['required', Rule::unique('restaurants')->ignore($this->restaurant), 'max:16' , 'min:9'],
            'image' => ['required'],
            'address' => ['required', 'max:255'],
        ];
    }

    public function messages()
    {
        return[
            //Name
            'name.required' => "Il campo 'nome' è obbligatorio",
            'name.unique' => "Il campo 'nome' inserito è già stato utilizzato.",
            'name.max' => "Il campo 'nome' deve contenere al massimo :max caratteri",
            //Mail
            'email.required' => "Il campo 'email' è obbligatorio",
            'email.unique' => "Il campo 'email' inserito è già stato utilizzato.",
            'email.max' => "Il campo 'email' deve contenere al massimo :max caratteri",
            //P_Iva
            'p_iva.required' => "Il campo 'p_iva' è obbligatorio",
            'p_iva.unique' => "Il campo 'p_iva' inserito è già stato utilizzato.",
            'p_iva.max' => "Il campo 'p_iva' deve contenere al massimo :max caratteri",
            //Phone_Num
            'phone_num.required' => "Il campo 'Telefono' è obbligatorio",
            'phone_num.unique' => "Il campo 'Telefono' inserito è già stato utilizzato.",
            'phone_num.max' => "Il campo 'Telefono' deve contenere al massimo :max caratteri",
            'phone_num.min' => "Il campo 'Telefono' deve contenere minimo :min caratteri",
            //Image
            'image.required' => "Il campo 'Immagine' è obbligatorio",
            //Address
            'address.required' => "Il campo 'address' è obbligatorio",
            'address.max' => "Il campo 'address' deve contenere al massimo :max caratteri",
        ];
    }
}
