<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class coefRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom,
            'niveau' => $this->niveau,
            'evaluation' => $this->evaluation,
            'discipline' => $this->discipline,
            'annee_scolaire' => $this->anneeScolaire,
        ];
    }
    
}
