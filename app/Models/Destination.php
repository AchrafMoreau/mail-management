<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Destination extends Model
{
    //
    use HasFactory;

    protected $fillable = ['nom','adresse','ville_id','phone','email','zip'];

    public function Courrires(){
        return $this->hasMany(Courrire::class);
    }


    public function Mails(){
        return $this->hasMany(Mail::class);
    }

    public function ville(){
        return $this->belongsTo(Ville::class);
    }
}
