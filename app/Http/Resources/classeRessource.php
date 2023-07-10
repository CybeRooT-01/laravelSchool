<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class classeRessource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "classe" => $this->nom,
            "inscription" => $this->inscriptions->map(function ($inscription) {
                return [
                    "id" => $inscription->id,
                    "eleve" => $inscription->eleve->nom . " " . $inscription->eleve->prenom,
                    "naissance" => date('d/m/Y', strtotime($inscription->eleve->date_naissance)),
                ];
            }),
        ];
    }
}
