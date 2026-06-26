<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class UnitaMisura extends Model
{
    protected $table = 'unita_misura';
    protected $fillable = ["grandeza", "simbolo"];
}
