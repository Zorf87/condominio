<?php

namespace App\Http\Controllers;

use App\Http\Resources\AnagraficheResource;
use App\Models\Anagrafica;
use Illuminate\Http\Request;

class AnagraficheController extends Controller
{
    public function index()
    {

        $anagrafiche = AnagraficheResource::collection(Anagrafica::all());

        return inertia("Anagrafiche/index", ['items' => $anagrafiche]);
    }
}
