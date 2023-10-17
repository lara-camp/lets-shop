<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductDetail extends Model
{
    use HasFactory;
    protected $fillable = ["product_id", "detail_id", "value"];

    public function product(){
        return $this->belongsTo(Product::class);
    }
        public function detail(){
            return $this->belongsTo(Detail::class, 'detail_id');
        }
}
