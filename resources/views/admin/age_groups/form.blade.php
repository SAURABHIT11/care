@php
    $isEdit = isset($ageGroup);
@endphp

<form
    action="{{ $isEdit ? route('admin.age-groups.update', $ageGroup->id) : route('admin.age-groups.store') }}"
    method="POST"
>
    @csrf
    @if($isEdit) @method('PUT') @endif

    {{-- Name --}}
    <div class="mb-3">
        <label class="form-label fw-bold">
            Age Group Name <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $ageGroup->name ?? '') }}"
            placeholder="e.g., 3-4 Years, 5-6 Years"
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
                value="{{ old('sort_order', $ageGroup->sort_order ?? 0) }}"
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
                    {{ old('status', $ageGroup->status ?? 1) ? 'checked' : '' }}
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
        <a href="{{ route('admin.age-groups.index') }}" class="btn btn-light px-4 text-muted">
            <i class="bi bi-arrow-left me-1"></i> Cancel
        </a>

        <button type="submit" class="btn btn-primary px-5">
            <i class="bi bi-check2-circle me-1"></i>
            {{ $isEdit ? 'Update Age Group' : 'Create Age Group' }}
        </button>
    </div>
</form>
