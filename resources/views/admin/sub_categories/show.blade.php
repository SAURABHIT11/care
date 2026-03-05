@extends('layouts.admin')

@section('title', 'Sub Category Details')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-white py-3 rounded-top-4">
                    <h5 class="mb-0 text-primary fw-bold">
                        <i class="bi bi-eye me-2"></i>
                        Sub Category Details
                    </h5>
                </div>

                <div class="card-body p-4">

                    <div class="mb-3">
                        <div class="text-muted small">Sub Category Name</div>
                        <div class="fw-bold fs-5">{{ $subCategory->name }}</div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small">Parent Category</div>
                        <div class="fw-semibold">
                            {{ $subCategory->category?->name ?? 'N/A' }}
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small">Slug</div>
                        <code>{{ $subCategory->slug }}</code>
                    </div>

                    <div class="mb-3">
                        <div class="text-muted small">Sort Order</div>
                        <span class="badge bg-secondary">{{ $subCategory->sort_order }}</span>
                    </div>

                    <div class="mb-4">
                        <div class="text-muted small">Status</div>
                        @if($subCategory->status)
                            <span class="badge bg-success">
                                <i class="bi bi-eye me-1"></i> Active
                            </span>
                        @else
                            <span class="badge bg-danger">
                                <i class="bi bi-eye-slash me-1"></i> Hidden
                            </span>
                        @endif
                    </div>

                    <hr>

                    <div class="d-flex justify-content-between">
                        <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-light px-4 text-muted">
                            <i class="bi bi-arrow-left me-1"></i> Back
                        </a>

                        <a href="{{ route('admin.sub-categories.edit', $subCategory->id) }}" class="btn btn-primary px-4">
                            <i class="bi bi-pencil-square me-1"></i> Edit
                        </a>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
