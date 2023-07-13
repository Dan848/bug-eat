<?php

namespace App\Http\Requests;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Expr\BinaryOp\Equal;

class StoreRestaurantRequest extends FormRequest
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
            'email' => ['required', 'unique:restaurants,email', 'min:4', 'max:255'],
            'p_iva' => ['required', 'unique:restaurants,p_iva', 'size:11'],
            'phone_num' => ['required', 'unique:restaurants,phone_num', 'min:9', 'max:16'],
            'image' => ['required'],
            'address' => ['required', 'max:255'],
        ];
    }

    public function messages()
    {
        return[
            //Name
            'name.required' => "Il campo 'Nome' è obbligatorio",
            'name.unique' => "Il campo 'Nome' inserito è già stato utilizzato.",
            'name.max' => "Il campo 'Nome' deve contenere al massimo :max caratteri",
            //Email
            'email.required' => "Il campo 'email' è obbligatorio",
            'email.unique' => "Il campo 'email' inserito è già stato utilizzato.",
            'email.max' => "Il campo 'email' deve contenere al massimo :max caratteri",
            'email.min' => "Il campo 'email' deve contenere almeno :min caratteri",
            //P_Iva
            'p_iva.required' => "Il campo 'Partita Iva' è obbligatorio",
            'p_iva.unique' => "Il campo 'Partita Iva' inserito è già stato utilizzato.",
            'p_iva.size' => "Il campo 'Partita Iva' deve contenere esattamente :size caratteri",
            //Phone_Num
            'phone_num.required' => "Il campo 'Telefono' è obbligatorio",
            'phone_num.unique' => "Il campo 'Telefono' inserito è già stato utilizzato.",
            'phone_num.max' => "Il campo 'Telefono' deve contenere al massimo :max caratteri",
            'phone_num.min' => "Il campo 'Telefono' deve contenere minimo :min caratteri",
            //Image
            'image.required' => "Il campo 'Immagine' è obbligatorio",
            //Address
            'address.required' => "Il campo 'Indirizzo' è obbligatorio",
            'address.max' => "Il campo 'address' deve contenere al massimo :max caratteri",
        ];
    }
}
