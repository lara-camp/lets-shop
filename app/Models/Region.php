<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Region extends Model
{
    use HasFactory;

    protected $fillable = ["name", "slug"];

    public function towns()
    {
        return $this->hasMany(Town::class);
    }
    public function addresses()
    {
        return $this->hasMany(Address::class);
    }
}
