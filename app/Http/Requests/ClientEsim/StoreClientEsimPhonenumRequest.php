<?php

namespace App\Http\Requests\ClientEsim;

use App\Models\Esims\ClientEsim;
use App\Traits\Request\RequestTraits;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class StoreClientEsimPhonenumRequest
 * @package App\Http\Requests\ClientEsim
 *
 * @property string numero
 * @property string $hasphonenum_type
 * @property integer $hasphonenum_id
 * @property integer $posi
 * @property integer|null $esim_id
 * @property ClientEsim $client_esim
 */
class StoreClientEsimPhonenumRequest extends FormRequest
{
    use RequestTraits;

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
            'numero' => [
                'required',
                'regex:/^([0-9\s\-\+\(\)]*)$/',
                'min:8',
                'unique:phone_nums,numero,NULL,id'
            ],
        ];
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'numero.required' => 'Numéro de téléphone requis',
            'numero.regex' => 'Numéro de téléphone non valide',
            'numero.min' => 'Numéro de téléphone doit avoir 8 digits minimum',
            'numero.unique' => 'Numéro déjà attribué',
        ];
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'client_esim' => $this->setRelevantClientEsim( $this->input('client_esim')),
        ]);
    }
}
