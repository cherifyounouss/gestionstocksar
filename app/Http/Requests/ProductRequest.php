<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'nom_produit' => 'required',
            'solvant' => 'required|boolean',
            'criticite' => 'in:V,I,S',
            'qte_min' => 'required|numeric',
            'unite' => 'required',
            'etagere' => 'required|exists:etageres,libelle',
            'num_casier' => 'required|integer',
            'date_exp_fds' => 'required|date_format:d/m/Y',
            'fds' => 'mimes:pdf',
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
            'nom_produit.required' => 'Veuillez renseigner le nom du produit',
            'solvant.required' => 'Verification',
            'criticite.required' => 'Veuillez renseigner la criticite du produit',
            'qte_min.required' => 'Veuillez renseigner le stock minimal pour declencher une alerte',
            'unite.required' => 'Veuillez renseigner l\'unité de mesure',
            'etagere.required' => 'Veuillez renseigner l\'étagère ou se trouve le produit',
            'num_casier.required' => 'Veuillez renseigner le numéro de casier ou se trouve le produit',
            'date_exp_fds' => 'Veuillez renseigner la date d\'expiration de la fiche de données sécurité' ,
            'date_exp_fds.date' => 'Veuillez vérifier la date d\'expiration de la fiche de données sécurités',
            'qte_min' => 'La quantité minimale d\'alerte n\'est pas valide',
            'num_casier.integer' => 'Le numéro de casier n\'est pas valide',
            'fds.mimes' => 'Veuillez fournir un bon format pour la fiche de données sécurité',
        ];
    }
}
