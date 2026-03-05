@extends('layouts.admin')

@section('title', 'Contents')

@section('content')
<div class="container-fluid">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold text-primary mb-0">
            <i class="bi bi-collection me-2"></i> Contents
        </h4>

        <a href="{{ route('admin.contents.create') }}" class="btn btn-primary px-4">
            <i class="bi bi-plus-circle me-1"></i> Add Content
        </a>
    </div>

    {{-- Flash --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show rounded-4" role="alert">
            <i class="bi bi-check-circle me-1"></i> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
    @endif

    <div class="card shadow border-0 rounded-4">
        <div class="card-header bg-white py-3 rounded-top-4">
            <h6 class="mb-0 fw-bold text-dark">
                <i class="bi bi-list-ul me-2"></i> All Contents
            </h6>
        </div>

        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th style="width:70px;">#</th>
                            <th>Title</th>
                            <th>Type</th>
                            <th>Category</th>
                            <th>Sub Category</th>
                            <th>Access</th>
                            <th>Lang</th>
                            <th>Downloads</th>
                            <th>Status</th>
                            <th style="width:180px;" class="text-end">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @forelse($contents as $key => $content)
                            <tr>
                                <td class="text-muted">{{ $contents->firstItem() + $key }}</td>

                                <td>
                                    <div class="fw-bold">{{ $content->title }}</div>
                                    <div class="small text-muted">
                                        Slug: <code>{{ $content->slug }}</code>
                                    </div>
                                </td>

                                <td>
                                    <span class="badge bg-light text-dark border text-uppercase">
                                        {{ str_replace('_', ' ', $content->type) }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $content->category?->name ?? 'N/A' }}
                                    </span>
                                </td>

                                <td>
                                    @if($content->subCategory)
                                        <span class="badge bg-light text-dark border">
                                            {{ $content->subCategory->name }}
                                        </span>
                                    @else
                                        <span class="text-muted small">—</span>
                                    @endif
                                </td>

                                <td>
                                    @if($content->access_type === 'premium')
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-lock-fill me-1"></i> Premium
                                        </span>
                                        <div class="small text-muted">₹{{ $content->price }}</div>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="bi bi-unlock me-1"></i> Free
                                        </span>
                                    @endif
                                </td>

                                <td>
                                    <span class="badge bg-info text-dark text-uppercase">
                                        {{ $content->language ?? 'N/A' }}
                                    </span>
                                </td>

                                <td>
                                    <span class="badge bg-dark">
                                        {{ $content->download_count ?? 0 }}
                                    </span>
                                </td>

                                <td>
                                    @if($content->status)
                                        <span class="badge bg-success">
                                            <i class="bi bi-eye me-1"></i> Active
                                        </span>
                                    @else
                                        <span class="badge bg-danger">
                                            <i class="bi bi-eye-slash me-1"></i> Hidden
                                        </span>
                                    @endif

                                    @if($content->is_featured)
                                        <div class="small text-warning fw-semibold mt-1">
                                            <i class="bi bi-star-fill me-1"></i> Featured
                                        </div>
                                    @endif
                                </td>

                                <td class="text-end">
                                    <a href="{{ route('admin.contents.show', $content->id) }}"
                                       class="btn btn-sm btn-outline-secondary">
                                        <i class="bi bi-eye"></i>
                                    </a>

                                    <a href="{{ route('admin.contents.edit', $content->id) }}"
                                       class="btn btn-sm btn-outline-primary">
                                        <i class="bi bi-pencil-square"></i>
                                    </a>

                                    <form action="{{ route('admin.contents.destroy', $content->id) }}"
                                          method="POST"
                                          class="d-inline"
                                          onsubmit="return confirm('Are you sure you want to delete this content?')"
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
                                <td colspan="10" class="text-center py-5">
                                    <div class="text-muted">
                                        <i class="bi bi-folder-x fs-2 d-block mb-2"></i>
                                        No Content Found
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        @if($contents->hasPages())
            <div class="card-footer bg-white py-3 rounded-bottom-4">
                {{ $contents->links() }}
            </div>
        @endif
    </div>

</div>
@endsection
