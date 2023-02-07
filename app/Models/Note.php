<?php

namespace App\Models;

use App\Models\Ecue;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Note extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'prenom',
        'matricule',
        'gender',
        'session',
        'note_ecue',
        'ecue_id',
        'formation'
    ];

    public function ecue()
    {
        return $this->belongsTo(Ecue::class,'ecue_id');
    }
}