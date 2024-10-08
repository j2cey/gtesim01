<?php

namespace App\Http\Requests\Setting;

use App\Models\Setting;

class UpdateSettingRequest extends SettingRequest
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
        return Setting::updateRules($this->setting);
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'group' => $this->setRelevantGroup($this->input('group'), true),
        ]);
    }
}
