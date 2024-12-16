<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Destination;
use App\Models\Expediteur;

class Mail extends Model
{
    use HasFactory;

    protected $fillable = [
        'type',
        'reception_jour', 
        'object', 
        'expediteur_id', 
        'destination_id',
        'observation', 
        // 'division', 
        'document', 
        'reception_heure'
    ];


    public function Destination(){
        return $this->belongsTo(Destination::class);
    }

    public function Expediteur(){
        return $this->belongsTo(Expediteur::class);
    }
}
