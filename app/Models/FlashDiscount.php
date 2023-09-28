<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FlashDiscount extends Model
{
    use HasFactory;
    protected $fillable = ["product_id", "discount_percentage", "discounttimeline_id"];
    public function product () {
        return $this->belongsTo(Product::class);
    }
    public function discounttimeline () {
        return $this->belongsTo(DiscountTimeline::class);
    }
    public function orders () {
        return $this->hasMany(Order::class);
    }
}
