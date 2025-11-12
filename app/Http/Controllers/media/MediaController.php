<?php

namespace App\Http\Controllers\media;

use App\Http\Controllers\Controller;
use App\Models\Media;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medias = Media::all();
        return view('pages.dashboard.common.media.index', compact('medias'));
    }

    /**
     * API endpoint for getting images (for your media manager)
     */
    public function getImages()
    {
        try {
            $images = Media::latest()->get()->map(function($image) {
                return [
                    'id' => $image->id,
                    'url' => asset('storage/' . $image->file_path), // Use asset() directly
                    'file_path' => $image->file_path,
                    'file_name' => $image->file_name,
                    'original_name' => $image->original_name ?? $image->file_name, // Fallback
                    'size' => $image->size ?? 0, // Fallback
                    'uploaded_at' => $image->created_at->format('Y-m-d H:i:s')
                ];
            });

            return response()->json($images);
        } catch (\Exception $e) {
            \Log::error('MediaController getImages error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Failed to load images: ' . $e->getMessage()
            ], 500);
        }
    }

   /**
 * Store a newly created resource in storage.
 */
public function store(Request $request)
{
    $request->validate([
        'image' => [
            'required',
            'file',
            'mimes:jpeg,png,jpg,gif,webp,avif', // Explicitly list all allowed types
            'max:4096'
        ]
    ]);

    try {
        \Log::info('Upload attempt started', ['file' => $request->file('image')?->getClientOriginalName()]);

        $file = $request->file('image');
        
        // Check if file was uploaded successfully
        if (!$file->isValid()) {
            return response()->json([
                'error' => 'File upload failed'
            ], 422);
        }

        // Additional manual validation for image types
        $allowedMimes = ['image/jpeg', 'image/png', 'image/gif', 'image/webp', 'image/avif'];
        if (!in_array($file->getMimeType(), $allowedMimes)) {
            return response()->json([
                'error' => 'Invalid file type. Allowed: JPEG, PNG, GIF, WEBP, AVIF'
            ], 422);
        }

        $path = $file->store('media', 'public');

        $media = Media::create([
            'file_name' => basename($path),
            'file_path' => $path,
            'original_name' => $file->getClientOriginalName(),
            'mime_type' => $file->getMimeType(),
            'size' => $file->getSize(),
        ]);

        \Log::info('Media created successfully', ['media_id' => $media->id]);

        return response()->json([
            'id' => $media->id,
            'url' => asset('storage/' . $path),
            'file_path' => $path,
            'file_name' => $media->file_name,
            'original_name' => $media->original_name,
            'size' => $media->size,
            'message' => 'Image uploaded successfully'
        ], 201);

    } catch (\Exception $e) {
        \Log::error('MediaController store error: ' . $e->getMessage());
        \Log::error('Stack trace: ' . $e->getTraceAsString());
        
        return response()->json([
            'error' => 'Upload failed: ' . $e->getMessage()
        ], 500);
    }
}

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Media $media)
    {
        try {
            if(Storage::disk('public')->exists($media->file_path)){
                Storage::disk('public')->delete($media->file_path);
            }
            $media->delete();

            return response()->json([
                'message' => 'Media deleted successfully.'
            ]);

        } catch (\Exception $e) {
            \Log::error('MediaController destroy error: ' . $e->getMessage());
            return response()->json([
                'error' => 'Delete failed: ' . $e->getMessage()
            ], 500);
        }
    }

    // Other methods for regular common
    public function create() 
    {
        return view('pages.dashboard.common.media.create');
    }
    
    public function show(Media $media) 
    {
        // Not used for API
    }
    
    public function edit(Media $media) 
    {
        return view('pages.dashboard.common.media.edit', compact('media'));
    }
    
    public function update(Request $request, Media $media) 
    {
        // For future use
    }
}