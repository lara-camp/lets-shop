<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $fillable = ["payment_img","coupon_id", "delivery_price", "total_price", "method","banking_id"];

    public function coupon() {
        return $this->belongsTo(Coupon::class);
    }

    public function orders() {
        return $this->hasMany(Payment::class);
    }

}
