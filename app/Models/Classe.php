<?php

namespace App\Models;

use App\Models\Niveau;
use App\Models\Inscription;
use Illuminate\Contracts\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Classe extends Model
{
    use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'classe_id');
    }
    public function niveau()
    {
        return $this->belongsTo(Niveau::class, 'niveau_id');
    }
    public function AssocCinq()
    {
        return $this->hasMany(AssosCinq::class, 'classe_id');
    }
    public function evaluation()
    {
        return $this->belongsTo(Evaluation::class, 'evaluation_id');
    }
    public function discipline()
    {
        return $this->belongsTo(Discipline::class, 'discipline_id');
    }
    public function anneeScolaire()
    {
        return $this->belongsTo(AnneeScolaire::class, 'annee_scolaire_id');
    }
    public function eleves()
    {
        return $this->hasMany(Eleve::class);
    }

}
