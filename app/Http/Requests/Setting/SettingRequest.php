<?php

namespace App\Http\Requests\Setting;

use App\Models\Setting;
use App\Traits\Request\RequestTraits;
use Illuminate\Foundation\Http\FormRequest;

/**
 * Class SettingRequest
 * @package App\Http\Requests\Setting
 *
 * @property string $group_id
 * @property string $name
 * @property string|null $full_path
 * @property string|null $value
 * @property string $type
 * @property string $array_sep
 * @property string|null $description
 *
 * @property Setting $setting
 * @property Setting|null $group
 */
class SettingRequest extends FormRequest
{
    use RequestTraits;

    public $default_rules = [];

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
        return Setting::defaultRules($this->type, $this->value);
    }

    public function setRelevantGroup($value, $json_decode_before = false) {
        if (is_null($value)) {
            return null;
        }
        if ($json_decode_before) {
            $value = $this->decodeJsonField($value);
        }
        return $value ? Setting::where('id', $value['id'])->first() : null;
    }
}
