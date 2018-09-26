<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EtagereRequest extends FormRequest
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
            'libelle' => 'required',
            'nbCasiers' => 'required'
        ];
    }

         /**
     * Custom message for validation
     *
     * @return array
     */

    public function messages(){
        return [
            'libelle.required' => 'Veuillez renseigner le libelle de l\'étagère',
            'nbCasiers.required' => 'Veuillez renseigner le nombre de casiers de l\'étagère',
        ];
    }
}
