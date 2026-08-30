<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class UnitaMisura extends Model
{

    use HasFactory;

    protected $table = 'unita_misura';
    protected $fillable = ["tipo", "grandeza", "simbolo"];

    protected static function booted(): void
    {
        static::saved(fn() => Cache::forget('unita-misura'));
        static::deleted(fn() => Cache::forget('unita-misura'));
    }
}
