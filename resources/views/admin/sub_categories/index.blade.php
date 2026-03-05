@extends('layouts.admin')

@section('title', 'Sub Categories')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0">
            <i class="bi bi-diagram-3 me-2"></i> Sub Categories
        </h4>

        <a href="{{ route('admin.sub-categories.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-1"></i> Add Sub Category
        </a>
    </div>

    {{-- Flash Message --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-white py-3 rounded-top-4">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="bi bi-list-ul me-2"></i> All Sub Categories
            </h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px;">#</th>
                            <th>Sub Category</th>
                            <th>Category</th>
                            <th>Slug</th>
                            <th style="width:120px;">Sort</th>
                            <th style="width:120px;">Status</th>
                            <th style="width:180px;" class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($subCategories as $key => $subCategory)
                            <tr>
                                <td class="text-muted">
                                    {{ $subCategories->firstItem() + $key }}
                                </td>

                                <td>
                                    <div class="fw-bold">{{ $subCategory->name }}</div>
                                    <div class="small text-muted">
                                        ID: {{ $subCategory->id }}
                                    </div>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border">
                                        {{ $subCategory->category?->name ?? 'N/A' }}
                                    </span>
                                </td>

                                <td>
                                    <code>{{ $subCategory->slug }}</code>
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $subCategory->sort_order }}
                                    </span>
                                </td>

                                <td>
                                    @if($subCategory->status)
                                        <span class="badge bg-success">
                                            <i class="bi bi-eye me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="bi bi-eye-slash me-1"></i> Hidden
                                        </span>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('admin.sub-categories.show', $subCategory->id) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.sub-categories.edit', $subCategory->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('admin.sub-categories.destroy', $subCategory->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this sub category?')"
                                    >
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-sm btn-outline-danger">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-folder-x fs-2 d-block mb-2"></i>
                                        No Sub Categories Found
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($subCategories->hasPages())
            <div class="card-footer bg-white py-3 rounded-bottom-4">
                {{ $subCategories->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
