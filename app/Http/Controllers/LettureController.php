<?php

namespace App\Http\Controllers;

use App\Http\Resources\LettureResource;
use App\Models\Lettura;

class LettureController extends Controller
{

    public function index()
    {

        $letture = LettureResource::collection(Lettura::all());

        return inertia("Letture/index", ['items' => $letture]);
    }
}
