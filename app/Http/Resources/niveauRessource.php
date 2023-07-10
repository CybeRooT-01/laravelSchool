<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class niveauRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        // return parent::toArray($request);
        return [
            'id' => $this->id,
            'niveau'=>$this->nom,
            'classes' => $this->classe->map(function ($classe) {
                return [
                    'id' => $classe->id,
                    'nom' => $classe->nom,
                    "prenom" => $classe->prenom,
                ];
            }),
        ];
    }
}
