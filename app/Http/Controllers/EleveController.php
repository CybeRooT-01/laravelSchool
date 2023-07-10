<?php

namespace App\Http\Controllers;

use App\Models\Eleve;

use App\Models\Classe;
use App\Models\Inscription;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\ElevePostRequest;
use App\Http\Requests\sortiePutRequest;

class EleveController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $dernierabandon =  Eleve::where('etat', 0)->latest()->first();
        return $dernierabandon->numero;
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ElevePostRequest $request)
    {
        $dateNaissance = Carbon::parse($request->input("date_naissance"));
        $age = $dateNaissance->diffInYears(Carbon::now());
    
        if ($age < 5) {
            return response()->json([
                "message" => "L'âge minimum requis est de 5 ans.",
            ], 422);
        }
        $classeId = $request->input("classe_id");
    
        $classe = Classe::find($classeId);
        if (!$classe) {
            return response()->json([
                "message" => "La classe spécifiée n'existe pas.",
            ], 422);
        }
    
        $eleve = Eleve::create([
            "nom" => $request->input("nom"),
            "prenom" => $request->input("prenom"),
            "date_naissance" => $request->input("date_naissance"),
            "lieu_naissance" => $request->input("lieu_naissance"),
            "sexe" => $request->input("sexe"),
            "profil" => $request->input("profil"),
            'email' => $request->input('email'),
        ]);
    
        $inscription = Inscription::create([
            "date_inscription" => now(),
            "eleve_id" => $eleve->id,
            "classe_id" => $classeId,
            "annee_scolaire_id" => $request->input("annee_scolaire_id"),
        ]);
    
        return response()->json([
            "message" => "Élève enregistré avec succès",
            "eleve" => $eleve,
            "inscription" => $inscription,
        ]);
    }


    public function sortie(sortiePutRequest $request)
    {
        $ids = $request->input('id');
        Eleve::whereIn('id', $ids)->update(['etat' => 0]);
        $elevesModifies = Eleve::whereIn('id', $ids)->get();
        return response()->json([
            "message" => "Les élèves ont été modifiés avec succès",
            "eleves" => $elevesModifies,
        ]);
    }
    public function getEventsByEleve($idEleves){
        $eleves = DB::table('event_classe')
        ->join('events', 'events.id', '=', 'event_classe.events_id')
        ->join('classes', 'classes.id', '=', 'event_classe.classe_id')
        ->join('inscriptions', 'inscriptions.classe_id','=', 'classes.id')
        ->join('eleves', 'eleves.id', '=', 'inscriptions.eleve_id')
        ->where('eleves.id', $idEleves)
        ->select('eleves.nom', 'eleves.prenom', 'events.libelle', 'events.date_Evenement')
        ->get();
        $eleves->isEmpty()?$eleves="no event":$eleves;
        return response()->json($eleves);
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
