<?php

namespace App\Http\Resources\Esims;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientEsimResource extends JsonResource
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

            'nom_raison_sociale' => $this->nom_raison_sociale,
            'prenom' => $this->prenom,
            'email' => $this->email,
            'numero_telephone' => $this->numero_telephone,
            'pin' => $this->pin,
            'puk' => $this->puk,

            'esim' => EsimResource::make($this->esim),

            'created_at' => $this->created_at,

            'show_url' => route('clientesims.show', $this->uuid), 
            'edit_url' => route('clientesims.edit', $this->uuid), 
            'destroy_url' => route('clientesims.destroy', $this->uuid),
        ];
    }
}
