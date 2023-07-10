<?php

namespace App\Models;

use App\Models\Inscription;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Eleve extends Model
{
    use HasFactory;

    protected $fillable = [
        'nom',
        'prenom',
        'date_naissance',
        'lieu_naissance',
        'sexe',
        'profil',
        'etat',
        'numero',
        'email'
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    protected static function booted()
    {
        static::creating(function ($eleve) {
            $eleve->numero = self::getNumeroEleve();
        });
    }
    public static function getNumeroEleve()
    {
        $numerosEtatUn = Eleve::where('etat', 1)
                              ->orderBy('numero', 'asc')
                              ->pluck('numero')
                              ->toArray();
        $dernierNumero = 0;
        foreach ($numerosEtatUn as $numero) {
            if ($numero > $dernierNumero + 1) {
                return $dernierNumero + 1;
            }
            $dernierNumero = $numero;
        }
        return $dernierNumero + 1;
    }

    public function inscriptions()
    {
        return $this->hasMany(Inscription::class, 'eleve_id');
    }
}
