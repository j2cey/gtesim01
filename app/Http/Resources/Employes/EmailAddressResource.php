<?php

namespace App\Http\Resources\Employes;

use App\Http\Resources\StatusResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use JsonSerializable;

/**
 * Class EmailAddressResource
 * @package App\Http\Resources\Employes
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $email
 * @property string $hasemailaddress_type
 * @property integer $hasemailaddress_id
 * @property integer $posi
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class EmailAddressResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  Request  $request
     * @return array|Arrayable|JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,

            'email' => $this->email,
            'posi' => $this->posi,
            'hasemailaddress_type' => $this->hasemailaddress_type,
            'hasemailaddress_id' => $this->hasemailaddress_id,

            'status' => StatusResource::make($this->status),

            'created_at' => $this->created_at,

            'show_url' => route('emailaddresses.show', $this->uuid),
            'edit_url' => route('emailaddresses.edit', $this->uuid),
            'destroy_url' => route('emailaddresses.destroy', $this->uuid),
        ];
    }
}
