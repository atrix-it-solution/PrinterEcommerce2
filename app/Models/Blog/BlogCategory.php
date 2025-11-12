<?php

namespace App\Models\Blog;

use Illuminate\Database\Eloquent\Model;
use App\Models\Media;
use Illuminate\Support\Facades\Storage;

class BlogCategory extends Model
{
     protected $fillable = [
        'title',
        'slug',
        'description',
    ];

    
    public function blogs()
    {
        return $this->belongsToMany(Blog::class, 'blog_blog_category');
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
