<?php

namespace App\Http\Requests\HowtoStep;

use App\Models\Howtos\HowtoStep;

class StoreHowtoStepRequest extends HowtoStepRequest
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
        return HowtoStep::createRules();
    }
}
