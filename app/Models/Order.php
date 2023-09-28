<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        "status",
        "unit_price",
        "quantity",
        "total_price",
        "flash_discount_id",
        "grand_price",
        "product_id",
        "user_id",
        "payment_id",
    ];

    public function flashDiscount()
    {
        return $this->belongsTo(FlashDiscount::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class);
    }
}
