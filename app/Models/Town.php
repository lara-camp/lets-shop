<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Town extends Model
{
    use HasFactory;
    protected $fillable=["name","fees","region_id"];

    public function region(){
        return $this->belongsTo(Region::class);
    }

    public function addresses(){
        return $this->hasMany(Address::class);
    }
}
