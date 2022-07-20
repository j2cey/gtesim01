<?php

namespace App\Http\Resources\Howtos;

use JsonSerializable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Resources\StatusResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class HowtoStepResource
 * @package App\Http\Resources\Howtos
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $title
 * @property string|null $view
 * @property string $description
 *
 * @property integer|null $howto_step_prev_id
 * @property integer|null $howto_step_next_id
 *
 * @property integer|null $created_by
 * @property integer|null $updated_by
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class HowtoStepResource extends JsonResource
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
            'view' => $this->view,
            'description' => $this->description,

            'howtosteptype' => HowtoStepTypeResource::make($this->howtosteptype),

            'status' => StatusResource::make($this->status),

            'created_at' => $this->created_at,

            'show_url' => route('howtosteps.show', $this->uuid),
            'edit_url' => route('howtosteps.edit', $this->uuid),
            'destroy_url' => route('howtosteps.destroy', $this->uuid),
        ];
    }
}
