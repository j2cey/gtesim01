<?php

namespace App\Http\Requests\User;

use App\Models\User;

class StoreUserRequest extends UserRequest
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
        return User::createRules();
    }

    /**
     * Prepare the data for validation.
     *
     * @return void
     */
    protected function prepareForValidation()
    {
        $this->merge([
            'is_local' => $this->setCheckOrOptionValue($this->input('is_local')),
            'is_ldap' => $this->setCheckOrOptionValue($this->input('is_ldap')),
            'status' => $this->setRelevantStatus($this->input('status'), 'id', false),
            'roles' => $this->setRelevantIdsList($this->input('roles'), false),
        ]);
    }
}
