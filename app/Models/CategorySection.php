<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorySection extends Model
{
    use HasFactory;
    protected $fillable = ["category_id", "section_id"];
    public function category() {
        return $this->belongsTo(Category::class);
    }
}
