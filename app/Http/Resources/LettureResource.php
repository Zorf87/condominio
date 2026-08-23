<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Request;

class LettureResource extends JsonResource
{


  public function toArray(Request $request): array
  {
    return [
      'id' => $this->id,
      'data_lettura' => $this->data_lettura,
      'valore' => $this->valore,
      'unita_misura' => $this->unitaMisura,
      'anagrafica' => $this->anagrafica,
      'created_at' => $this->created_at,
      'updated_at' => $this->updated_at,
    ];
  }
}
