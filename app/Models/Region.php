<?php

namespace App\Models;

use app\Models\Decharge;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;


class Region extends Model
{
    //
    use HasFactory;

    protected $fillable = ['region'];

    public function villes(){
        return $this->hasMany(Ville::class);
    }

    public function decharges(){
        return $this->hasMany(Decharge::class);
    }
}
