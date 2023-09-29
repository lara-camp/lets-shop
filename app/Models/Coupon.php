<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Coupon extends Model
{
    use HasFactory;
    protected $fillable = ["min_purchase", "discount","coupon_code", "discounttimeline_id","is_used"];

    public function discounttimeline() {
        return $this->belongsTo(DiscountTimeline::class);
    }
    public function payment() {
        return $this->hasOne(Payment::class);
    }
}
