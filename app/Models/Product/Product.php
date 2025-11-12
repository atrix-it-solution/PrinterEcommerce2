<?php

namespace App\Models\Product;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class Product extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'featured_image',
        'regular_price',
        'sale_price',
        'sku',
        'stock_quantity',
    ];

    public function categories()
    {
        return $this->belongsToMany(ProductCategory::class, 'product_product_category');
    }

    public function featuredImage()
    {
        return $this->belongsTo(Media::class, 'featured_image');
    }

     // Add multiple gallery images relationship
    public function galleryImages()
    {
        return $this->belongsToMany(Media::class, 'product_gallery_images', 'product_id', 'media_id')
                    ->withPivot('sort_order')
                    ->withTimestamps()
                    ->orderBy('sort_order');
    }

    // Helper method to get image URL
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featuredImage) {
            return Storage::url($this->featuredImage->url);
        }
        return null;
    }

     // Helper method to get gallery images URLs
    public function getGalleryImageUrlsAttribute()
    {
        return $this->galleryImages->map(function ($image) {
            return Storage::url($image->url);
        });
    }

}
