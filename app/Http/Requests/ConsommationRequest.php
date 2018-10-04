<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ConsommationRequest extends FormRequest
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
            'produit' => 'required|exists:produits,id',
            'conditionnement' => 'required|numeric',
            'qte_par_cond' => 'required|numeric',
            'date_consommation' => 'required|date_format:d/m/Y',
        ];
    }

        /**
     * Custom message for validation
     *
     * @return array
     */

    public function messages()
    {
        return [
            'produit.required' => 'Veuillez renseigner le produit concerné',
            'conditionnement.required' => 'Veuillez renseigner le conditionnement',
            'qte_par_cond.required' => 'Veuillez renseigner la quantité par conditionnement',
            'date_consommation.required' => 'Veuillez renseigner la date de consommation',
            'produit.exists' => 'Le produit renseigné n\'est pas stocké',
            'date_approvision.date' => 'Veuillez vérifier la date de consommation',
            'qte_par_cond.numeric' => 'Veuillez vérifier la valeur de la quantité par conditionnement',
            'conditionnement.numeric' => 'Veuillez vérifier la valeur de la conditionnement',
        ];
    }
}
