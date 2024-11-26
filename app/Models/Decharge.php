<?php

// app/Models/Decharge.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decharge extends Model
{
    protected $fillable = [
        'nom_complet',
        'date',
        'etat',
        'ville',
        'image_scan', // Ajoutez cette ligne
    ];
}