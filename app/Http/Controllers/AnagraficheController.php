<?php

namespace App\Http\Controllers;

use App\Models\Anagrafica;
use Illuminate\Http\Request;

class AnagraficheController extends Controller
{
    public function index()
    {

        $anagrafiche = Anagrafica::all();

        return inertia("Anagrafiche/Index", $anagrafiche);
    }
}
