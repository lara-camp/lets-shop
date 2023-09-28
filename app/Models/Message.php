<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = ["send_to", "send_from", "body", "is_file", "type"];

    public function user(){
        return $this->belongsTo(User::class);
    }
}
