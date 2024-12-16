<?php

namespace App\Models;

use App\Models\Decharge;
use App\Models\Setting;
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

    public function settings(){
        return $this->hasMany(Setting::class);
    }
}
