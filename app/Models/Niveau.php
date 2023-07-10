<?php

namespace App\Models;

use App\Models\Classe;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Niveau extends Model
{
    use HasFactory;
    protected $hidden = [
        'created_at',
        'updated_at',
    ];
    
    public function classe():HasMany
    {
        return $this->hasMany(Classe::class);
    }
}
