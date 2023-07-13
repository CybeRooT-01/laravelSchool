<?php
namespace App\Traits;

use App\Models\AssosCinq;
use App\Models\Inscription;
use App\Models\Note;

trait RequetesInsertNote{

    public function inscription($eleveId, $classeID){
        return Inscription::where('eleve_id',$eleveId)
        ->where('classe_id', $classeID)
        ->first();
    }
    public function assoCinq($disciplineId, $evaluationId){
        return AssosCinq::where('discipline_id', $disciplineId)
        ->where('evaluation_id', $evaluationId)
        ->first();
    }
    public function existingNote($inscription, $assosCinq, $noteValue,$semestre){
        Note::where('inscription_id', $inscription->id)
        ->where('assosCinq_id', $assosCinq->id)
        ->where('note', $noteValue)
        ->where('semestre_id', $semestre)
        ->first();
    }
}