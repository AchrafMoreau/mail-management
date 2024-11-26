<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Courrier extends Model
{
    use HasFactory;

    protected $fillable = [
        'objet', 
        'type', 
        'date', 
        'emetteur', 
        'adresse_emetteur', 
        'observation', 
        'image_scan', 
        'date_creation', 
        'division'
    ];

    protected $dates = ['date_creation'];

    // Assurez-vous que 'date_creation' est automatiquement assigné
    protected $attributes = [
        'date_creation' => null,
    ];

    // Génération automatique de la date de création lors de la création du modèle
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($courrier) {
            $courrier->date_creation = now();
        });
    }
}
