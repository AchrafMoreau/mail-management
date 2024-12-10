<?php

namespace App\Models;
use App\Models\Region;
use App\Models\Ville;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Decharge extends Model
{
    //
    use HasFactory;

    protected $fillable = ['nom', 'reception_jour','etat_id', 'ville_id', 'document'];

    public function etat(){
        return $this->belongsTo(Region::class);
    }

    public function ville(){
        return $this->belongsTo(Ville::class);
    }
}
