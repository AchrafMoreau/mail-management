<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Courrire;

class Emetteur extends Model
{
    //

    use HasFactory;

    protected $fillable = ['nom', 'adresse', 'phone', 'ville_id', 'zip'];

    public function Courrire(){
        return $this->hasMany(Courrire::class);
    }

    public function ville(){
        return $this->belongsTo(Ville::class);
    }
}
