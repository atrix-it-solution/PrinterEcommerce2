<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;
use App\Models\Product\Product;

class ProductCategory extends Model
{
     protected $fillable = [
        'title',
        'slug',
        'description',
        'category_image'
    ];

    
    public function products()
    {
        return $this->belongsToMany(Product::class, 'product_product_category');
    }


    public function categoryImage()
    {
        return $this->belongsTo(Media::class, 'category_image');
    }

    // Helper method to get image URL
    public function getcategoryImageUrlAttribute()
    {
        if ($this->categoryImage) {
            return Storage::url($this->categoryImage->url);
        }
        return null;
    }
}
