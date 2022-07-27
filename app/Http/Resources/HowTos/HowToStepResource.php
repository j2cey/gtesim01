<?php

namespace App\Http\Resources\HowTos;

use App\Http\Resources\StatusResource;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HowToStepResource
 * @package App\Http\Resources\HowTos
 *
 * @property integer $id
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $title
 * @property integer $posi
 * @property string $description
 * @property int|null $how_to_id how_to reference
 * @property int|null $how_to_thread_id how_to_thread reference
 *
 * @property int|null $status_id status reference
 *
 * @property integer|null $created_by
 * @property integer|null $updated_by
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class HowToStepResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'uuid' => $this->uuid,

            'title' => $this->title,
            'posi' => $this->posi,
            'description' => $this->description,

            'how_to_thread_id' => $this->how_to_thread_id,
            'howto' => HowToResource::make($this->howto),

            'tags' => $this->tags,

            'status' => StatusResource::make($this->status),

            'created_at' => $this->created_at,

            'show_url' => route('howtosteps.show', $this->uuid),
            'edit_url' => route('howtosteps.edit', $this->uuid),
            'destroy_url' => route('howtosteps.destroy', $this->uuid),
        ];
    }
}
