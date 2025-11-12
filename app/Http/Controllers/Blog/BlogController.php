<?php

namespace App\Http\Controllers\Blog;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog\Blog;
use App\Models\Blog\BlogCategory;
use Illuminate\Support\Facades\Storage;
use App\Models\Media;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::with(['categories', 'featuredImage'])->get();
        return view('pages.dashboard.blog.index', compact('blogs'));
    }

    public function create()
    {
        $categories = BlogCategory::all();
        return view('pages.dashboard.blog.create-edit', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug',
            'description' => 'nullable|string',
            'featured_image' => 'nullable|exists:media,id',
            'tags' => 'nullable|string|max:500',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:blog_categories,id',
        ]);

        $blogData = $request->only(['title', 'slug', 'description', 'tags', 'featured_image']);

        $blog = Blog::create($blogData);

        if ($request->filled('categories')) {
            $blog->categories()->sync($request->categories);
        }

        return redirect()->route('blogs.index')->with('success', 'Blog created successfully!');
    }

    public function edit($id)
    {
        $blog = Blog::with(['categories', 'featuredImage'])->findOrFail($id);
        $categories = BlogCategory::all();
        return view('pages.dashboard.blog.create-edit', compact('blog', 'categories'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:blogs,slug,' . $id,
            'description' => 'nullable|string',
            'featured_image' => 'nullable|exists:media,id',
            'tags' => 'nullable|string|max:500',
            'categories' => 'nullable|array',
            'categories.*' => 'exists:blog_categories,id',
        ]);

        $blogData = $request->only(['title', 'slug', 'description', 'tags', 'featured_image']);

        $blog->update($blogData);

        if ($request->filled('categories')) {
            $blog->categories()->sync($request->categories);
        } else {
            $blog->categories()->detach();
        }

        return redirect()->route('blogs.index')->with('success', 'Blog updated successfully!');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return redirect()->route('blogs.index')->with('success', 'Blog deleted successfully!');
    }



    /**
     * Frontend blog listing page
     */
   public function frontendIndex()
    {
        $blogs = Blog::with(['categories', 'featuredImage'])
                    ->orderBy('created_at', 'desc')
                    ->paginate(6);

        ($blogs); // This will show the data and stop execution
        return view('pages.frontend.blog', compact('blogs'));
    }

    /**
     * Frontend single blog page
     */
    public function frontendShow($slug)
    {
        $blog = Blog::with(['categories', 'featuredImage'])
                    ->where('slug', $slug)
                    ->firstOrFail();

        // Get related blogs
        $relatedBlogs = Blog::with(['categories', 'featuredImage'])
                            ->where('id', '!=', $blog->id)
                            ->whereHas('categories', function($query) use ($blog) {
                                $query->whereIn('blog_categories.id', $blog->categories->pluck('id'));
                            })
                            ->get();

        return view('pages.frontend.single-blog', compact('blog', 'relatedBlogs'));
    }
}