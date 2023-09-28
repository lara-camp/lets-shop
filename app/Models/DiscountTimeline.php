<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DiscountTimeline extends Model
{
    use HasFactory;
    protected $fillable = ["start", "end"];

    public function flashDiscounts () {
        return $this->hasMany(FlashDiscount::class);
    }
    public function couponDiscounts () {
        return $this->hasMany(Coupon::class);
    }
}
