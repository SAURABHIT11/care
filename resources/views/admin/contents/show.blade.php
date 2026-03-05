@extends('layouts.admin')

@section('title', 'Content Details')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-10">

            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-white py-3 rounded-top-4">
                    <h5 class="mb-0 text-primary fw-bold">
                        <i class="bi bi-eye me-2"></i>
                        Content Details
                    </h5>
                </div>

                <div class="card-body p-4">

                    <div class="row">
                        <div class="col-md-8">

                            <div class="mb-3">
                                <div class="text-muted small">Title</div>
                                <div class="fw-bold fs-5">{{ $content->title }}</div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">Description</div>
                                <div class="fw-semibold">
                                    {{ $content->description ?? '—' }}
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="text-muted small">Type</div>
                                    <span class="badge bg-light text-dark border">
                                        {{ strtoupper(str_replace('_',' ', $content->type)) }}
                                    </span>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="text-muted small">Language</div>
                                    <span class="badge bg-info text-dark text-uppercase">
                                        {{ $content->language ?? 'N/A' }}
                                    </span>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="text-muted small">Difficulty</div>
                                    <span class="badge bg-secondary text-uppercase">
                                        {{ $content->difficulty ?? 'N/A' }}
                                    </span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <div class="text-muted small">Access</div>
                                    @if($content->access_type === 'premium')
                                        <span class="badge bg-warning text-dark">
                                            <i class="bi bi-lock-fill me-1"></i> Premium
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="bi bi-unlock me-1"></i> Free
                                        </span>
                                    @endif
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="text-muted small">Price</div>
                                    <div class="fw-bold">₹{{ $content->price }}</div>
                                </div>

                                <div class="col-md-4 mb-3">
                                    <div class="text-muted small">Downloads</div>
                                    <div class="fw-bold">{{ $content->download_count ?? 0 }}</div>
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">Category</div>
                                <div class="fw-semibold">
                                    {{ $content->category?->name ?? 'N/A' }}
                                    @if($content->subCategory)
                                        <span class="text-muted">→</span>
                                        {{ $content->subCategory->name }}
                                    @endif
                                </div>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">Slug</div>
                                <code>{{ $content->slug }}</code>
                            </div>

                            <div class="mb-3">
                                <div class="text-muted small">Status</div>
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
                                    <span class="badge bg-warning text-dark ms-2">
                                        <i class="bi bi-star-fill me-1"></i> Featured
                                    </span>
                                @endif
                            </div>

                        </div>

                        <div class="col-md-4">
                            <div class="p-3 border rounded-4 bg-light">
                                <h6 class="fw-bold mb-3">
                                    <i class="bi bi-tags me-1"></i> Meta
                                </h6>

                                <div class="mb-3">
                                    <div class="text-muted small">Age Groups</div>
                                    @forelse($content->ageGroups as $age)
                                        <span class="badge bg-dark me-1 mb-1">{{ $age->label }}</span>
                                    @empty
                                        <div class="text-muted small">—</div>
                                    @endforelse
                                </div>

                                <div class="mb-0">
                                    <div class="text-muted small">Tags</div>
                                    @forelse($content->tags as $tag)
                                        <span class="badge bg-secondary me-1 mb-1">{{ $tag->name }}</span>
                                    @empty
                                        <div class="text-muted small">—</div>
                                    @endforelse
                                </div>
                            </div>
                        </div>
                    </div>

                    <hr>

                    {{-- Files --}}
                    <div class="mt-3">
                        <h6 class="fw-bold mb-3">
                            <i class="bi bi-paperclip me-1"></i> Content Files
                        </h6>

                        @if($content->files && $content->files->count())
                            <div class="table-responsive">
                                <table class="table table-sm table-bordered align-middle">
                                    <thead class="table-light">
                                        <tr>
                                            <th>#</th>
                                            <th>Type</th>
                                            <th>File</th>
                                            <th>Preview</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($content->files as $k => $file)
                                            <tr>
                                                <td>{{ $k + 1 }}</td>
                                                <td class="text-uppercase fw-bold">{{ $file->file_type }}</td>
                                                <td><code>{{ $file->file_path }}</code></td>
                                                <td>
                                                    @if($file->preview_image)
                                                        <code>{{ $file->preview_image }}</code>
                                                    @else
                                                        <span class="text-muted">—</span>
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @else
                            <div class="text-muted">
                                No files attached yet.
                            </div>
                        @endif
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.contents.index') }}" class="btn btn-light px-4 text-muted">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>

                        <a href="{{ route('admin.contents.edit', $content->id) }}" class="btn btn-primary px-4">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
