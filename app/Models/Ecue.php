<?php

namespace App\Models;

use App\Models\Ue;
use App\Models\Note;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ecue extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "coeff",
        "ue_id"
    ];
    public function note()
    {
        return $this->hasOne(Note::class);
      
    }
    public function ue()
    {
        return $this->belongsTo(Ue::class);
    }
}