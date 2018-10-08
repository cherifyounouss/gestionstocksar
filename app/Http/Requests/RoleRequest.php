<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RoleRequest extends FormRequest
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
            'nom_role' => 'required|min:2',
        ];
    }

    
     /**
     * Custom message for validation
     *
     * @return array
     */

    public function messages(){
        return [
            'nom_role.required' => 'Veuillez renseigner le nom du role',
            'nom_role.min' => 'Le nom du role doit comprendre au moins deux caracteres',
        ];
    }
}
