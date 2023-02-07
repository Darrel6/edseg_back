<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Annale extends Model
{
    use HasFactory;
    protected $fillable = [
        "title",
        "author",
        "description",
        "image",
        "pdf",
    ];
}