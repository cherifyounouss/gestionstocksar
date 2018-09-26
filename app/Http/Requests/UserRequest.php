<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
            //
            'prenom' => 'required|min:2|alpha',
            'nom' => 'required|min:2|alpha',
            'email' => 'required|email',
            'password' => 'required|confirmed',
        ];
    }

         /**
     * Custom message for validation
     *
     * @return array
     */

    public function messages(){
        return [
            'prenom.required' => 'Veuillez renseigner le prénom de l\'utilisateur',
            'prenom.min' => 'Veuillez entrer un prénom d\'au moins deux caracteres',
            'prenom.alpha' => 'Veuillez renseigner un prénom valide',
            'nom.min' => 'Veuillez entrer un nom d\'au moins deux caracteres',
            'nom.alpha' => 'Veuillez entrer un prenom valide',
            'nom.required' => 'Veuillez renseigner le nom de l\'utilisateur',
            'email.required' => 'Veuillez renseigner l\'email',
            'email.email' => 'Cet email n\'est pas valide',
            'password.required' => 'Veuillez renseigner le mot de passe',
            'password.confirmed' => 'Les deux mots de passe ne sont pas identiques',

        ];
    }
}
