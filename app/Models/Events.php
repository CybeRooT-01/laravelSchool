<?php

namespace App\Models;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Events extends Model
{
    use HasFactory;
    protected $fillable = ['libelle', 'description', 'date_Evenement', 'user_id'];
    public function classes()
    {
        return $this->belongsToMany(Classe::class, 'event_classe');
    }
}
