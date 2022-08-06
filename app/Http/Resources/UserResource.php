<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\Employes\EmployeResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class UserResource
 * @package App\Http\Resources
 *
 * @property int $id
 * @property string $uuid
 * @property string $name
 * @property string $username
 * @property string $email
 * @property boolean $is_local
 * @property boolean $is_ldap
 */
class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,

            'name' => $this->name,
            'username' => $this->username,
            'email' => $this->email,

            'is_local' => $this->is_local,
            'is_ldap' => $this->is_ldap,

            'employe' => EmployeResource::make($this->employe),

            'status' => StatusResource::make($this->status),
            'created_at' => $this->created_at,

            'edit_url' => route('users.edit', $this->uuid),
            'destroy_url' => route('users.destroy', $this->uuid),
        ];
    }
}
