<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\Eleve;
use App\Models\Classe;
use App\Models\AssosCinq;
use App\Models\Discipline;
use App\Models\Evaluation;
use App\Models\Inscription;
use Illuminate\Http\Request;
use App\Traits\RequetesInsertNote;
use App\Http\Requests\notePostRequest;
use App\Http\Resources\classeRessource;
use App\Http\Requests\DisciplinePostRequest;
use App\Http\Requests\EvaluationPostRequest;
use Illuminate\Support\Facades\DB;

class ClasseController extends Controller
{
    use RequetesInsertNote;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $classe = Classe::with('inscriptions')->find($id);
        $classeResource = new classeRessource($classe);
        // return response()->json($classeResource);
        return view('classes', ['classe' => $classeResource]);
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
    public function getDiscipline(Request $request)
    {
        $discipline = Discipline::all();
        return response()->json($discipline);
    }
    public function getEvaluation(Request $request)
    {
        $evaluation = Evaluation::all();
        return response()->json($evaluation);
    }
    public function storeEvaluation(EvaluationPostRequest $request)
    {
        $evaluation = Evaluation::create([
            "libelle" => $request->input("libelle"),
        ]);
        return response()->json([
            "message" => "Les données ont ete enregistrer",
            "data" => $evaluation,
        ], 201);
    }
    public function storeDiscipline(DisciplinePostRequest $request)
    {
        $discipline = Discipline::create([
            "libelle" => $request->input("libelle"),
        ]);
        return response()->json([
            "message" => "Les données ont ete enregistrer",
            "data" => $discipline,
        ], 201);
    }

    public function insertNote(NotePostRequest $request, $classeId, $disciplineId, $evaluationId)
    {
        $notes = $request->input('note');
        $result = [];
        foreach ($notes as $noteData) {
            $eleveId = $noteData['eleve_id'];
            $noteValue = $noteData['note'];
            $inscription = $this->inscription($eleveId, $classeId);
            if ($inscription) {
                $assosCinq = $this->assoCinq($disciplineId,$evaluationId);
                $notemax = $assosCinq->note_max;
                $semestre = 3;
                if ($assosCinq && $noteValue <= $notemax) {
                    $existingNote = $this->existingNote($inscription, $assosCinq, $noteValue, $semestre);
                    if ($existingNote) {
                        return response()->json([
                            'message' => 'Une note identique existe déjà pour cet élève.',
                        ], 400);
                    }
                    $note = Note::firstOrCreate([
                        'inscription_id' => $inscription->id,
                        'assosCinq_id' => $assosCinq->id,
                        'note' => $noteValue,
                        'semestre_id' => 4
                    ]);
                    if(!$note->wasRecentlyCreated){
                        return response()->json([
                            'message' => 'Une note identique existe déjà pour cet élève.',
                        ], 400);
                    }
                    $result[] = $note;
                } else {
                    return response()->json([
                        "message" => "donnes incoherent"
                    ]);
                }
            }
        }
        return response()->json($result);
    }
    public function updateNote(notePostRequest $request, $classeId, $disciplineId, $evaluationId)
    {
        $notes = $request->input('note');
        $result = [];
        foreach ($notes as $noteData) {
            $eleveId = $noteData['eleve_id'];
            $noteValue = $noteData['note'];
            $inscription = $this->inscription($eleveId, $classeId);
            if ($inscription) {
                $assosCinq = $this->assoCinq($disciplineId,$evaluationId);
                $notemax = $assosCinq->note_max;
                if ($assosCinq && $noteValue <= $notemax) {
                        Note::where([
                        'inscription_id' => $inscription->id,
                        'assosCinq_id' => $assosCinq->id,
                        'semestre_id' => 4
                    ])->update([
                        'note' => $noteValue,
                    ]);
                    $elevesModifes = Eleve::where('id', $eleveId)->get();
                    $result[] = $elevesModifes;
                } else {
                    return response()->json([
                        "message" => "donnes incoherent"
                    ]);
                }
            }
        }
        return response()->json($result);
    }
    // public function getNoteByDiscipline($classeId, $disciplineId)
    // {
    //     $classe = Classe::with(['inscriptions.notes.assosCinq'])
    //         ->where('id' , $classeId)
    //         ->first();

    //     if (!$classe) {
    //         return response()->json(['message' => 'La classe n\'existe pas'], 404);
    //     }
    //     $notes = [];
    //     foreach ($classe->inscriptions as $inscription) {
    //         foreach ($inscription->notes as $note) {
    //             if ($note->assosCinq->discipline_id == $disciplineId) {
    //                 $notes[] = [
    //                     'eleve_id' => $inscription->eleve_id,
    //                     'nom' => $inscription->eleve->nom,
    //                     'prenom' => $inscription->eleve->prenom,
    //                     'note' => $note->note,
    //                 ];
    //             }
    //         }
    //     }

    //     return response()->json($notes);
    // }

    // public function getNoteByClasse(Request $request, $classeId)
    // {
    //     $classe = Classe::with(['inscriptions.notes.assosCinq.discipline'])
    //         ->where('id', $classeId)
    //         ->first();

    //     if (!$classe) {
    //         return response()->json(['message' => 'La classe n\'existe pas'], 404);
    //     }

    //     $notes = [];

    //     foreach ($classe->inscriptions as $inscription) {
    //         foreach ($inscription->notes as $note) {
    //             $notes[] = [
    //                 'eleve_id' => $inscription->eleve_id,
    //                 'discipline' => $note->assosCinq->discipline->libelle,
    //                 'nom' => $inscription->eleve->nom,
    //                 'prenom' => $inscription->eleve->prenom,
    //                 'note' => $note->note,
    //             ];
    //         }
    //     }
    //     return response()->json($notes);
    // }
    // public function getNoteByEleve(Request $request, $classeId, $eleveId)
    // {
    //     $classe = Classe::with(['inscriptions.notes.assosCinq.discipline'])
    //         ->where('id', $classeId)
    //         ->first();

    //     if (!$classe) {
    //         return response()->json(['message' => 'La classe n\'existe pas'], 404);
    //     }

    //     $notes = [];

    //     foreach ($classe->inscriptions as $inscription) {
    //         if ($inscription->eleve_id == $eleveId) {
    //             foreach ($inscription->notes as $note) {
    //                 $notes[] = [
    //                     'discipline' => $note->assosCinq->discipline->libelle,
    //                     'note' => $note->note,
    //                 ];
    //             }
    //         }
    //     }

    //     return response()->json($notes);
    // }
    // =================================refais avec join=========
    public function getNoteByDiscipline($classeId, $disiplineId){
        $classe = DB::table('classes')
        ->join('inscriptions', 'inscriptions.classe_id', '=', 'classes.id')
        ->join('notes', 'notes.inscription_id', '=', 'inscriptions.id')
        ->join('assos_cinqs', 'notes.assosCinq_id', '=', 'assos_cinqs.id')
        ->join('eleves', 'eleves.id', '=', 'inscriptions.eleve_id')
        ->where('classes.id', $classeId)
        ->where('assos_cinqs.discipline_id', $disiplineId)
        ->select('eleves.nom','eleves.prenom','notes.note')
        ->get();
        $classe->isEmpty()? $classe = "pas de note pour cette discipline": $classe;

       return  response()->json($classe);
    }

    public function getNoteByClasse($classeId){
        $notes = DB::table('classes')
        ->join('inscriptions', 'inscriptions.classe_id', '=', 'classes.id')
        ->join('notes', 'notes.inscription_id', '=', 'inscriptions.id')
        ->join('eleves', 'inscriptions.eleve_id','=','eleves.id')
        ->where('classes.id', '=', $classeId)
        ->select('notes.note', 'eleves.nom', 'eleves.prenom')
        ->get();

        $notes->isEmpty()?$notes="no notes" : $notes;
        return response()->json($notes);
    }

    public function getNoteByEleve($classeId, $eleveId){
        $notes = DB::table('classes')
        ->join('inscriptions', 'inscriptions.classe_id', '=', 'classes.id')
        ->join('notes', 'notes.inscription_id', '=', 'inscriptions.id')
        ->join('eleves', 'eleves.id', '=', 'inscriptions.eleve_id')
        ->join('assos_cinqs', 'notes.assosCinq_id', '=', 'assos_cinqs.id')
        ->join('disciplines', 'disciplines.id', 'assos_cinqs.discipline_id')
        ->where('eleves.id', $eleveId)
        ->where('classes.id', $classeId)
        ->select('eleves.nom', 'eleves.prenom', 'notes.note', 'disciplines.libelle')
        ->get();
        $notes->isEmpty()?$notes = 'no notes':$notes;
        return response()->json($notes);
    }

    

}
