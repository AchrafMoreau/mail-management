<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Emetteur;

class Courrire extends Model
{
    //
    use HasFactory;

    protected $fillable = ['type','reception_jour', 'object', 'emetteur_id', 'observation', 'division', 'document', 'reception_heure'];


    public function Emetteur(){
        return $this->belongsTo(Emetteur::class);
    }
}
