<?php

namespace App\Http\Resources\HowTos;

use JsonSerializable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Resources\StatusResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HowToThreadResource
 * @package App\Http\Resources\HowTos
 *
 * @property integer $id
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $title
 * @property string $code
 *
 * @property string $description
 *
 * @property int|null $status_id status reference
 *
 * @property integer|null $created_by
 * @property integer|null $updated_by
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class HowToThreadResource extends JsonResource
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
            'code' => $this->code,
            'description' => $this->description,
            'tags' => $this->tags,

            'status' => StatusResource::make($this->status),

            'created_at' => $this->created_at,

            'show_url' => route('howtothreads.show', $this->uuid),
            'edit_url' => route('howtothreads.edit', $this->uuid),
            'read_url' => route('howtothreads.read', [$this->uuid, 1]),
            'destroy_url' => route('howtothreads.destroy', $this->uuid),
        ];
    }
}
