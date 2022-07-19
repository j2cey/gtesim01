<?php

namespace App\Http\Requests\ClientEsim;

use Illuminate\Validation\Rule;
use App\Models\Esims\ClientEsim;

/**
 * Class StoreClientEsimRequest
 * @package App\Http\Requests\ClientEsim
 *
 * @property ClientEsim $client_matched_selected
 */
class StoreClientEsimRequest extends ClientEsimRequest
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
        return array_merge(ClientEsim::createRules($this->numero_telephone), [
            /*
            'numero_telephone' => Rule::unique('phone_nums', 'numero')
                ->where(function ($query) {
                    $query->where('numero', $this->numero_telephone) ->where('hasphonenum_type', ClientEsim::class);
                })->ignore($this->numero_telephone),
            */
        ]);
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'client_matched_selected' => is_null($this->input('client_matched_selected')) ? null : $this->setRelevantClientEsim( ['uuid' => $this->input('client_matched_selected')], 'uuid'),
        ]);
    }
}
