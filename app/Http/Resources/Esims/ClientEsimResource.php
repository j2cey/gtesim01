<?php

namespace App\Http\Resources\Esims;

use App\Http\Resources\UserResource;
use App\Http\Resources\Employes\EmailAddressResource;
use App\Http\Resources\Employes\PhoneNumResource;
use App\Http\Resources\StatusResource;
use Illuminate\Contracts\Support\Arrayable;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Carbon;
use JsonSerializable;

/**
 * Class ClientEsimResource
 * @package App\Http\Resources\Esims
 *
 * @property integer $id
 *
 * @property string $uuid
 * @property bool $is_default
 * @property string|null $tags
 *
 * @property string $nom_raison_sociale
 * @property string $prenom
 * @property string $email
 * @property string $numero_telephone
 * @property string $pin
 * @property string $puk
 *
 * @property integer|null $esim_id
 *
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class ClientEsimResource extends JsonResource
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

            'nom_raison_sociale' => $this->nom_raison_sociale,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'numero_telephone' => $this->numero_telephone,
            'pin' => $this->pin,
            'puk' => $this->puk,

            'latestPhonenum' => PhoneNumResource::make($this->latestPhonenum),
            'oldestPhonenum' => PhoneNumResource::make($this->oldestPhonenum),
            'phonenums' => PhoneNumResource::collection($this->phonenums),

            'latestEmailAddress' => EmailAddressResource::make($this->latestEmailAddress),
            'oldestEmailAddress' => EmailAddressResource::make($this->oldestEmailAddress),
            'emailaddresses' => EmailAddressResource::collection($this->emailaddresses),

            'creator' => UserResource::make($this->creator),
            'esim_id' => $this->esim_id,

            'status' => StatusResource::make($this->status),
            'created_at' => $this->created_at,

            'show_url' => route('clientesims.show', $this->uuid),
            'edit_url' => route('clientesims.edit', $this->uuid),
            'destroy_url' => route('clientesims.destroy', $this->uuid),
        ];
    }
}
