<?php

namespace App\Http\Requests\HowtoStep;

use App\Models\Howtos\HowtoStep;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class HowtoStepRequest
 * @package App\Http\Requests\Howtos
 *
 * @property string $title
 * @property string|null $view
 * @property string $description
 *
 * @property integer|null $howto_step_prev_id
 * @property integer|null $howto_step_next_id
 *
 * @property HowtoStep $howtostep
 */
class HowtoStepRequest extends FormRequest
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
        return HowtoStep::defaultRules();
    }

    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return HowtoStep::messagesRules();
    }
}
