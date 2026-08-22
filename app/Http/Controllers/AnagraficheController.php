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

    public function edit(Anagrafica $anagrafica)
    {
        return inertia("Anagrafiche/edit", ['item' => AnagraficheResource::make($anagrafica)]);
    }

    public function update(Request $request, Anagrafica $anagrafica)
    {
        $validatedData = $request->validate([
            'nome' => 'required|string|max:255',
            'email' => 'nullable|email|max:255',
            'telefono' => 'nullable|string|max:20',
            'cellulare' => 'nullable|string|max:20',
            'note' => 'nullable|string',
        ]);

        $anagrafica->update($validatedData);

        return redirect()->route('anagrafiche.index');
    }

    public function create()
    {
        return inertia("Anagrafiche/create");
    }

    public function destroy(Anagrafica $anagrafica)
    {
        $anagrafica->delete();

        return redirect()->route('anagrafiche.index');
    }
}
