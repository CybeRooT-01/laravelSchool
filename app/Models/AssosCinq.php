<?php

namespace App\Models;

use App\Models\Classe;
use App\Models\Discipline;
use App\Models\Evaluation;
use App\Models\AnneeScolaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class AssosCinq extends Model
{
    use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected $fillable = [
        "note_max",
        "evaluation_id",
        "classe_id",
        "annee_scolaire_id",
        "discipline_id",
    ];
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class);
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class);
    }
    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class);
    }
    public function discipline()
    {
        return $this->belongsTo(Discipline::class);
    }
}
