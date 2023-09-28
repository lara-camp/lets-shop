<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HotSlide extends Model
{
    use HasFactory;
    protected $fillable = ["image","product_id", "url"];
    public function product() {
        return $this->belongsTo(Product::class);
    }
}
