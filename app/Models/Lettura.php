<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lettura extends Model
{
    //
    use HasFactory;

    protected $table = 'letture';
    protected $fillable = ["anagrafica_id", "valore", "unita_misura_id"];


    public function anagrafica()
    {
        return $this->belongsTo(Anagrafica::class, "anagrafica_id");
    }

    public function unitaMisura()
    {
        return $this->belongsTo(UnitaMisura::class, "unita_misura_id");
    }
}
