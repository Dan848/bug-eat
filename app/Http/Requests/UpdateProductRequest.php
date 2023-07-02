<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProductRequest extends FormRequest
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

     public function rules()
    {
        return [
            'name' => ['required', Rule::unique('products')->ignore($this->name), 'max:100'],
            'price' => ['required', 'min:1'],
            'address' => ['required', 'max:255'],
            'visible' => ['required']
        ];
    }

    public function messages()
    {
        return[
            'name.required' => "Il campo 'nome' è obbligatorio",
            'name.unique' => "Il campo 'nome' inserito è già stato utilizzato.",
            'name.max' => "Il campo 'nome' deve contenere al massimo :max caratteri",
            'price.required' => "Il campo 'prezzo' è obbligatorio",
            'price.min' => "Il campo 'prezzo' deve essere maggiore di :min",
            'visible.required' => "Il campo 'visible' è obbligatorio",
        ];
    }
}
