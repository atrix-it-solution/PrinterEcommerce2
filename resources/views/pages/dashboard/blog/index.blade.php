@extends('layouts.dashboard.master')

@section('title', 'Blog ')

@section('dashboard-content')
<div class="container-fluid">
  <h1>Blog</h1>
  <a href="{{ route('blogs.create') }}" class="btn btn-success mb-3">Add Blog Item</a>

  <div class="col-12">
    <div class="card">
      <div class="table-responsive">
        <table class="table">
          <thead class="table-light">
            <tr>
              <th>Title</th>
              <th>Category</th>
              <th>Image</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($blogs as $blog)
              <tr>
                <td>{{ $blog->title }}</td>
                 <td>
                  @if($blog->categories->isNotEmpty())
                    @foreach($blog->categories as $category)
                      <span >{{ $category->title }}</span>
                    @endforeach
                  @else
                    <span class="text-muted">No Category</span>
                  @endif
                </td>
                <td>
                  @if($blog->featuredImage)
                    <img src="{{ $blog->featuredImage->url }}" 
                         width="60" 
                         height="50" 
                         style="object-fit: cover; border-radius: 5px;"
                         alt="{{ $blog->title }}">
                  @else
                    <div class="text-muted" style="width: 60px; height: 50px; display: flex; align-items: center; justify-content: center; background: #f8f9fa; border-radius: 5px;">
                      No Image
                    </div>
                  @endif
                </td>
               
                <td>
                  <div class="btn-group" role="group">
                    <a href="{{ route('blogs.edit', $blog->id) }}" class="btn btn-sm btn-warning">
                      <i class="fas fa-edit"></i> Edit
                    </a>
                    <form action="{{ route('blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                      @csrf
                      @method('DELETE')
                      <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Are you sure you want to delete this blog?')">
                        <i class="fas fa-trash"></i> Delete
                      </button>
                    </form>
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection