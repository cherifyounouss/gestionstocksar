<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ApprovisionnementRequest extends FormRequest
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
            'num_bl' => 'required',
            'produit' => 'required|exists:produits,id',
            'fournisseur' => 'required|exists:fournisseurs,id',
            'conditionnement' => 'required|numeric',
            'qte_par_cond' => 'required|numeric',
            'date_approvision' => 'required|date_format:d/m/Y',
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
            'num_bl.required' => 'Veuillez renseigner le numero du bon de livraison',
            'produit.required' => 'Veuillez renseigner le produit concerné',
            'fournisseur.required' => 'Veuillez renseigner le fournisseur',
            'conditionnement.required' => 'Veuillez renseigner le conditionnement',
            'qte_par_cond.required' => 'Veuillez renseigner la quantité par conditionnement',
            'date_approvision.required' => 'Veuillez renseigner la date d\'approvisionnement',
            'produit.exists' => 'Le produit renseigné n\'est pas stocké',
            'fournisseur.exists' => 'Le fournisseur renseigné n\'est pas stocké',
            'date_approvision.date' => 'Veuillez vérifier la date d\'approvisionnement',
            'qte_par_cond.numeric' => 'Veuillez vérifier la valeur de la quantité par conditionnement',
            'conditionnement.numeric' => 'Veuillez vérifier la valeur de la conditionnement',
        ];
    }
}