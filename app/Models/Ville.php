<?php

namespace App\Models;

use app\Models\Decharge;
use app\Models\Region;
use app\Models\Emetteur;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ville extends Model
{
    //
    use HasFactory;

    protected $fillable = ['ville', 'region_id'];

    public function region(){
        return $this->belongsTo(Region::class);
    }


    public function decharges(){
        return $this->hasMany(Decharge::class);
    }

    public function emetteurs(){
        return $this->hasMany(Emetteur::class);
    }
}
