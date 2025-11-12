<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class Blog extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'description',
        'featured_image',
        'tags',
    ];

    public function categories()
    {
        return $this->belongsToMany(BlogCategory::class, 'blog_blog_category');
    }

    public function featuredImage()
    {
        return $this->belongsTo(Media::class, 'featured_image');
    }

    public function getTagsArrayAttribute()
    {
        if (empty($this->tags)) {
            return [];
        }
        
        return array_map('trim', explode(',', $this->tags));
    }

    // Helper method to get image URL
    public function getFeaturedImageUrlAttribute()
    {
        if ($this->featuredImage) {
            return Storage::url($this->featuredImage->url);
        }
        return null;
    }
}
