<?php

namespace App\Http\Resources\Audit;

use Illuminate\Support\Carbon;
use App\Http\Resources\UserResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class AuditResource
 * @package App\Http\Resources\Audit
 *
 * @property integer $id
 *
 * @property string $title
 * @property string $code
 * @property string|null $view
 * @property string $description
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class AuditResource extends JsonResource
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

            'auditable_type' => $this->auditable_type,
            'auditable_id' => $this->auditable_id,
            'event' => $this->event,
            
            'user' => UserResource::make($this->user),
            
            'old_values' => $this->old_values,
            'new_values' => $this->new_values,
            'url' => $this->url,
            'ip_address' => $this->ip_address,
            'user_agent' => $this->user_agent,

            'created_at' => $this->created_at,
        ];
    }
}
