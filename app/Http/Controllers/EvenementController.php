<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\Events;
use Illuminate\Http\Request;
use App\Http\Requests\EventPostRequest;

class EvenementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $evenements = Events::all();
        return response()->json($evenements);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EventPostRequest $request)
    {
        $evenement = Events::create([
            'libelle' => $request->input('libelle'),
            'description' => $request->input('description'),
            'date_Evenement' => $request->input('date_Evenement'),
            'user_id' => $request->input('user_id'),
        ]);
        return response()->json([
            'message' => 'Les données ont ete enregistrer',
            'data' => $evenement,
        ], 201);
    }

    public function participate(Request $request, $id)
    {
        $evenement = Events::find($id);
        $classeId = $request->input('classe_id');

        if ($evenement && Classe::find($classeId)) {
            $evenement->classes()->attach($classeId);
            return response()->json([
                'message' => "l'evenement a ete ajouter a la classe",
            ]);
        }
        return response()->json([
            'message' => 'Événement ou classe introuvable.',
        ], 404);
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
