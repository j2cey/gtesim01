<?php

namespace App\Http\Resources\Employes;

use JsonSerializable;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Http\Resources\StatusResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Class FonctionEmployeResource
 * @package App\Http\Resources\Employes
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $intitule
 * @property string $slug
 * @property string|null $description
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class FonctionEmployeResource extends JsonResource
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

            'intitule' => $this->intitule,
            'slug' => $this->slug,
            'description' => $this->description,
            
            'status' => StatusResource::make($this->status),

            'created_at' => $this->created_at,

            'show_url' => route('fonctionemployes.show', $this->uuid),
            'edit_url' => route('fonctionemployes.edit', $this->uuid),
            'destroy_url' => route('fonctionemployes.destroy', $this->uuid),
        ];
    }
}
