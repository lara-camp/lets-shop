<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banking extends Model
{
    use HasFactory;
    protected $fillable=['username','phone_no','account_id','image','banking_type'];

    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
}
