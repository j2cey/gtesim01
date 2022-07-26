<?php

namespace App\Http\Resources\HowTos;

use JsonSerializable;
use App\Models\Status;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Resources\StatusResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HowToTypeResource
 * @package App\Http\Resources\Howtos
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $title
 * @property string $description
 *
 * @property integer|null $created_by
 * @property integer|null $updated_by
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 * @property Status status
 */
class HowToTypeResource extends JsonResource
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

            'title' => $this->title,
            'description' => $this->description,

            'status' => StatusResource::make($this->status),
            'created_at' => $this->created_at,

            'show_url' => route('howtotypes.show', $this->uuid),
            'edit_url' => route('howtotypes.edit', $this->uuid),
            'destroy_url' => route('howtotypes.destroy', $this->uuid),
        ];
    }
}
