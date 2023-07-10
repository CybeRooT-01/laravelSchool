<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use App\Models\AssosCinq;
use Illuminate\Http\Request;
use App\Http\Resources\coefRessource;
use App\Http\Requests\CoefPostRequest;
use App\Http\Resources\classeRessource;

class coefController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CoefPostRequest $request, $id)
    {
        $AssosCinq = AssosCinq::create([
            "note_max" => $request->input("note_max"),
            "evaluation_id" => $request->input("evaluation_id"),
            "classe_id" => $id,
            "annee_scolaire_id" => $request->input("annee_scolaire_id"),
            "discipline_id" => $request->input("discipline_id"),
        ]);
        return response()->json([
            "message" => "Les données ont ete enregistrer",
            "data" => $AssosCinq,
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $classe = Classe::join('assos_cinqs' , 'assos_cinqs.classe_id', '=', 'classes.id')
            ->join('disciplines', 'disciplines.id', '=', 'assos_cinqs.discipline_id')
            ->join('evaluations', 'evaluations.id', '=', 'assos_cinqs.evaluation_id')
            ->join('annee_scolaires', 'annee_scolaires.id', '=', 'assos_cinqs.annee_scolaire_id')
            ->join('niveaux', 'niveaux.id', '=', 'classes.niveau_id')
            ->where('classes.id', '=', $id)
            ->select('classes.nom as nom_classe', 'disciplines.libelle as nom_discipline', 'evaluations.libelle as nom_evaluation', 'annee_scolaires.libelle as nom_annee_scolaire', 'niveaux.nom as nom_niveau')
            ->get();
        return response()->json($classe);
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
