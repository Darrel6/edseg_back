<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diplome extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'prenom',
        'email',
        'category',
        'date_soutenance',
        'formation',
        'status',
        'date_naiss',
        'lieu_naiss',
        'promotion',
        "annee_ac",
        "annee_etude",
        "num_demande"
    ];
}