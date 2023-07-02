<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTypeRequest extends FormRequest
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
            'name' => ['required','unique:types,name', 'max:100'],
            'image' => ['required']
        ];
    }

    public function messages()
    {
        return [
            'name.required' => "Il campo 'nome' è obbligatorio",
            'name.unique' => "Il campo 'nome' inserito è già stato utilizzato.",
            'name.max' => "Il campo 'nome' deve contenere al massimo :max caratteri",
            'image.required' => "Il campo 'immagine' è obbligatorio"
        ];
    }
}
