@extends('layouts.admin')

@section('title', 'Categories')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary"><i class="bi bi-tags me-2"></i>Category Management</h4>
        <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Add New Category
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card shadow-sm border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light text-muted small uppercase fw-bold">
                        <tr>
                            <th class="ps-4">Sort</th>
                            <th>Icon</th>
                            <th>Category Name</th>
                            <th>Slug</th>
                            <th>Status</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td class="ps-4 text-muted">{{ $category->sort_order }}</td>
                            <td><i class="{{ $category->icon ?? 'bi bi-folder' }} fs-5"></i></td>
                            <td class="fw-bold">{{ $category->name }}</td>
                            <td class="text-muted small">{{ $category->slug }}</td>
                            <td>
                                @if($category->status)
                                    <span class="badge bg-success-subtle text-success px-3">Active</span>
                                @else
                                    <span class="badge bg-danger-subtle text-danger px-3">Inactive</span>
                                @endif
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil"></i>
                                    </a>
                                    <form action="{{ route('admin.categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Delete this category?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger ms-1">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-5 text-muted">No categories found.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        @if($categories->hasPages())
            <div class="card-footer bg-white py-3">
                {{ $categories->links() }}
            </div>
        @endif
    </div>
</div>
@endsection