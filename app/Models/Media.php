<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Media extends Model
{
    use HasFactory; 

     protected $fillable = [
        'file_name',
        'file_path',
        'original_name',
        'mime_type',
        'size'
    ];

    // Accessor for full URL
    public function getUrlAttribute()
    {
        return asset('storage/' . $this->file_path);
    }

    // Helper method to check if file exists
    public function fileExists()
    {
        return Storage::exists($this->file_path);
    }
}
