<?php

namespace App\Http\Resources\Employes;

use App\Http\Resources\Esims\EsimResource;
use App\Http\Resources\StatusResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use JsonSerializable;

/**
 * Class PhoneNumResource
 * @package App\Http\Resources\Employes
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 * @property integer|null $status_id
 *
 * @property string $numero
 * @property string $hasphonenum_type
 * @property integer $hasphonenum_id
 * @property integer $posi
 * @property integer|null $esim_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class PhoneNumResource extends JsonResource
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

            'numero' => $this->numero,
            'posi' => $this->posi,
            'hasphonenum_type' => $this->hasphonenum_type,
            'hasphonenum_id' => $this->hasphonenum_id,

            'esim' => EsimResource::make($this->esim),
            'status' => StatusResource::make($this->status),

            'created_at' => $this->created_at,

            'show_url' => route('phonenums.show', $this->uuid),
            'edit_url' => route('phonenums.edit', $this->uuid),
            'destroy_url' => route('phonenums.destroy', $this->uuid),
        ];
    }
}
