<?php

namespace App\Models;

use App\Models\Eleve;
use App\Models\Classe;
use App\Models\AnneeScolaire;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Inscription extends Model
{
    use HasFactory;
    protected $fillable = [
        'date_inscription',
        'eleve_id',
        'classe_id',
        'annee_scolaire_id'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'annee_scolaire_id');
    }
    public function classe()
    {
        return $this->belongsTo(Classe::class, 'classe_id');
    }
    public function eleve()
    {
        return $this->belongsTo(Eleve::class, 'eleve_id');
    }
    public function notes()
    {
        return $this->hasMany(Note::class, 'inscription_id');
    }
}
