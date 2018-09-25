<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProviderStoreRequest extends FormRequest
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
            'nom_fournisseur' => 'required|min:2',
            'adresse' => 'required',
            'num_tel' => 'numeric'
        ];
    }

     /**
     * Custom message for validation
     *
     * @return array
     */

    public function messages(){
        return [
            'nom_fournisseur.required' => 'Veuillez entrer le nom du fournisseur',
            'adresse.required' => 'Veuillez entrer l\'adresse du fournisseur',
            'nom_fournisseur.min' => 'Veuillez entrer un nom valide de fournisseur',
            'num_tel.numeric' => 'Veuillez entrer un numero de telephone valide'
        ];
    }
}
