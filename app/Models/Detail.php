<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Detail extends Model
{
    use HasFactory;
    protected $fillable = ["key"];

    public function product () {
        return $this->belongsToMany(Product::class, 'product_details');
    }
}
