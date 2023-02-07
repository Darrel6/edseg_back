<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calendrier extends Model
{
    use HasFactory;

    protected $fillable  = [
        "annee",
        "semester",
        "date",
        "matiere",
        "heure_depart",
        "heure_fin",
        "enseignant",
        "mention"
    ];  
}