<?php

namespace App\Models;

use App\Models\Region;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    //
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'region_id', 
        "name",
        "data_bs_theme",
        "data_layout_position",
        "data_topbar",
        "data_sidebar",
    ];

    public function user(){
        return $this->belongsTo(User::class);

    }
    public function region(){
        return $this->belongsTo(Region::class);
    }
}

