<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "slug",
        "description",
        "truncate",
        "price",
        "stock",
        "category_id",
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function category():BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function ratings()
    {
        return $this->hasMany(Rating::class);
    }

    public function reviews()
    {
        return $this->hasMany(Review::class)->whereNull('parent_id');
    }

    public function wishlists()
    {
        return $this->hasMany(Wishlist::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function hotslides()
    {
        return $this->hasMany(HotSlide::class);
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productDetails()
    {
        return $this->belongsToMany(Detail::class, 'product_details')->withPivot('value');;
    }

    public function flashDiscounts()
    {
        return $this->hasMany(FlashDiscount::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class);
    }
}
