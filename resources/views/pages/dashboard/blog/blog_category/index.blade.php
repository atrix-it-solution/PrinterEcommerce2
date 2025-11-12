@extends('layouts.dashboard.master')

@section('title', 'Category Blog')

@section('dashboard-content')
<div class="container-fluid">

   
    <!-- @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif -->

    <div class="row">

        
        <div class="col-md-4">
            <div class="card-body">

                    @if(!empty($editCategory))
                        {{-- Edit Mode --}}
                        <form action="{{ route('blogcategories.update', $editCategory->id) }}" method="POST">
                            @method('PUT')
                    @else
                        {{-- Create Mode --}}
                        <form action="{{ route('blogcategories.store') }}" method="POST">
                    @endif
                    @csrf

                  
                    <div class="mb-3">
                        <label for="title" class="form-label">Title</label>
                        <input type="text" name="title" class="form-control"
                               value="{{ old('title', $editCategory->title ?? '') }}" required>
                    </div>

                    
                    <div class="mb-3">
                        <label for="slug" class="form-label">Slug</label>
                        <input type="text" name="slug" class="form-control"
                               value="{{ old('slug', $editCategory->slug ?? '') }}" required>
                    </div>

                    
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <input type="text" name="description" class="form-control"
                               value="{{ old('description', $editCategory->description ?? '') }}">
                    </div>

                    
                    <div class="mb-3">
                        <button type="submit" class="btn btn-primary">
                            {{ isset($editCategory) ? 'Update' : 'Publish' }}
                        </button>
                        @if(isset($editCategory))
                            <a href="{{ route('blogcategories.index') }}" class="btn btn-secondary">Cancel</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>


        <div class="col-md-8">
            <div class="col-12">
                <div class="card">
                    <div class="table-responsive">
                        <table class="table">
                            <thead class="table-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Slug</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($categories as $category)
                                    <tr>
                                        <td>{{ $category->title }}</td>
                                        <td>{{ $category->slug }}</td>
                                        <td>
                                            <a href="{{ route('blogcategories.edit', $category->id) }}"
                                               class="btn btn-sm btn-warning">Edit</a>

                                            <form action="{{ route('blogcategories.destroy', $category->id) }}"
                                                  method="POST" style="display:inline;">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-sm btn-danger"
                                                        onclick="return confirm('Are you sure?')">Delete</button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr><td colspan="4" class="text-center">No categories found.</td></tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@endsection
