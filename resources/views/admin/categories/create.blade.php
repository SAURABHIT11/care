@extends('layouts.admin')

@section('title', isset($category) ? 'Edit Category' : 'Create Category')

@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-md-8">

            <div class="card shadow border-0 rounded-4">
                <div class="card-header bg-white py-3 rounded-top-4">
                    <h5 class="mb-0 text-primary fw-bold">
                        <i class="bi bi-{{ isset($category) ? 'pencil-square' : 'plus-circle' }} me-2"></i>
                        {{ isset($category) ? 'Edit Category' : 'Create New Category' }}
                    </h5>
                </div>

                <div class="card-body p-4">

                    <form
                        action="{{ isset($category) ? route('admin.categories.update', $category->id) : route('admin.categories.store') }}"
                        method="POST"
                    >
                        @csrf
                        @if(isset($category)) @method('PUT') @endif

                        {{-- Category Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-bold">
                                Category Name <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control @error('name') is-invalid @enderror"
                                value="{{ old('name', $category->name ?? '') }}"
                                placeholder="e.g., Math Worksheets"
                                required
                            >

                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            {{-- Icon --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Icon Class</label>

                                <input
                                    type="text"
                                    name="icon"
                                    class="form-control @error('icon') is-invalid @enderror"
                                    value="{{ old('icon', $category->icon ?? 'bi bi-folder') }}"
                                    placeholder="e.g., bi bi-grid"
                                >

                                <div class="form-text small">
                                    Use <a href="https://icons.getbootstrap.com/" target="_blank">Bootstrap Icons</a>
                                    classes like: <code>bi bi-grid</code>, <code>bi bi-book</code>
                                </div>

                                @error('icon')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            {{-- Sort Order --}}
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-bold">Sort Order</label>

                                <input
                                    type="number"
                                    name="sort_order"
                                    class="form-control @error('sort_order') is-invalid @enderror"
                                    value="{{ old('sort_order', $category->sort_order ?? 0) }}"
                                    min="0"
                                >

                                @error('sort_order')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        {{-- Status --}}
                        <div class="mb-4">
                            <div class="form-check form-switch">
                                <input type="hidden" name="status" value="0">

                                <input
                                    class="form-check-input"
                                    type="checkbox"
                                    name="status"
                                    value="1"
                                    id="statusSwitch"
                                    {{ old('status', $category->status ?? 1) ? 'checked' : '' }}
                                >

                                <label class="form-check-label fw-bold" for="statusSwitch">
                                    Visible on Site
                                </label>
                            </div>
                        </div>

                        <hr>

                        {{-- Buttons --}}
                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-light px-4 text-muted">
                                <i class="bi bi-arrow-left me-1"></i> Cancel
                            </a>

                            <button type="submit" class="btn btn-primary px-5">
                                <i class="bi bi-check2-circle me-1"></i>
                                {{ isset($category) ? 'Update Category' : 'Create Category' }}
                            </button>
                        </div>

                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
