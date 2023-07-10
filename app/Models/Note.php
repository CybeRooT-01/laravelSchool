<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;
    protected $fillable = ['note', 'inscription_id', 'assosCinq_id', 'semestre_id'];
    public function assosCinq()
{
    return $this->belongsTo(AssosCinq::class, 'assosCinq_id');
}
}
