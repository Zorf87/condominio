<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class UnitaMisuraResource extends JsonResource
{


  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'tipo' => $this->tipo,
      'grandezza' => $this->grandezza,
      'simbolo' => $this->simbolo,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
