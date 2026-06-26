<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AnagraficheResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {

        /*
        Per aggiungere la relazione con user_id, è necessario aggiungere la relazione nel modello Anagrafica e poi includerla qui. Ad esempio:
        'user' => new UserResource($this->whenLoaded('user')),
    */

        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'email' => $this->email,
            'telefono' => $this->telefono,
            'cellulare' => $this->cellulare,
            'note' => $this->note,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
