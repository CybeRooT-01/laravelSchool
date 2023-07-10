<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Evaluation extends Model
{
    use HasFactory;
    protected $fillable = [
        'libelle',
    ];
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    public function assocCinqs()
    {
        return $this->hasMany(AssocCinq::class);
    }
}