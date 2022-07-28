<?php

namespace App\Http\Resources\HowTos;

use JsonSerializable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Resources\StatusResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HowToResource
 * @package App\Http\Resources\HowTos
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $title
 * @property string $code
 * @property string|null $view
 * @property string $description
 *
 * @property integer|null $created_by
 * @property integer|null $updated_by
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class HowToResource extends JsonResource
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
            'view' => $this->view,
            'htmlbody' => $this->htmlbody,
            'description' => $this->description,
            'tags' => $this->tags,

            'howtotype' => HowToTypeResource::make($this->howtotype),

            'status' => StatusResource::make($this->status),

            'created_at' => $this->created_at,

            'show_url' => route('howtos.show', $this->uuid),
            'edit_url' => route('howtos.edit', $this->uuid),
            'edithtml_url' => route('howtos.edithtml', $this->id),
            'readhtml_url' => route('howtos.readhtml', $this->id),
            'destroy_url' => route('howtos.destroy', $this->uuid),
        ];
    }
}
