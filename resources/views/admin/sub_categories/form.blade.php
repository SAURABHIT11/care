@php
    $isEdit = isset($subCategory);
@endphp

<form
    action="{{ $isEdit ? route('admin.sub-categories.update', $subCategory->id) : route('admin.sub-categories.store') }}"
    method="POST"
>
    @csrf
    @if($isEdit) @method('PUT') @endif

    {{-- Category --}}
    <div class="mb-3">
        <label class="form-label fw-bold">
            Parent Category <span class="text-danger">*</span>
        </label>

        <select name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
            <option value="">-- Select Category --</option>
            @foreach($categories as $cat)
                <option value="{{ $cat->id }}"
                    {{ old('category_id', $subCategory->category_id ?? '') == $cat->id ? 'selected' : '' }}
                >
                    {{ $cat->name }}
                </option>
            @endforeach
        </select>

        @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Name --}}
    <div class="mb-3">
        <label class="form-label fw-bold">
            Sub Category Name <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $subCategory->name ?? '') }}"
            placeholder="e.g., Addition, Phonics, Mazes"
            required
        >

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        {{-- Sort Order --}}
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">Sort Order</label>

            <input
                type="number"
                name="sort_order"
                class="form-control @error('sort_order') is-invalid @enderror"
                value="{{ old('sort_order', $subCategory->sort_order ?? 0) }}"
                min="0"
            >

            @error('sort_order')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Status --}}
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold d-block">Status</label>

            <div class="form-check form-switch mt-2">
                <input type="hidden" name="status" value="0">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="status"
                    value="1"
                    id="statusSwitch"
                    {{ old('status', $subCategory->status ?? 1) ? 'checked' : '' }}
                >

                <label class="form-check-label fw-bold" for="statusSwitch">
                    Visible on Site
                </label>
            </div>

            @error('status')
                <div class="invalid-feedback d-block">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <hr>

    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.sub-categories.index') }}" class="btn btn-light px-4 text-muted">
            <i class="bi bi-arrow-left me-1"></i> Cancel
        </a>

        <button type="submit" class="btn btn-primary px-5">
            <i class="bi bi-check2-circle me-1"></i>
            {{ $isEdit ? 'Update Sub Category' : 'Create Sub Category' }}
        </button>
    </div>
</form>
