<?php

namespace App\Http\Requests\HowtoStepType;

use App\Models\Howtos\HowtoStepType;
use Illuminate\Foundation\Http\FormRequest;

class HowtoStepTypeRequest extends FormRequest
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
        return HowtoStepType::defaultRules();
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return HowtoStepType::messagesRules();
    }
}
