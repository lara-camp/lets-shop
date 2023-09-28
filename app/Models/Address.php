<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Address extends Model
{
    use HasFactory;
    protected $fillable=['user_id','region_id','town_id','detail_address'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function region()
    {
        return $this->belongsTo(Region::class);
    }
    public function town()
    {
        return $this->belongsTo(Town::class);
    }

}
