@php
    $isEdit = isset($tag);
@endphp

<form
    action="{{ $isEdit ? route('admin.tags.update', $tag->id) : route('admin.tags.store') }}"
    method="POST"
>
    @csrf
    @if($isEdit) @method('PUT') @endif

    {{-- Name --}}
    <div class="mb-3">
        <label class="form-label fw-bold">
            Tag Name <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="name"
            class="form-control @error('name') is-invalid @enderror"
            value="{{ old('name', $tag->name ?? '') }}"
            placeholder="e.g., Animals, Math, Tracing"
            required
        >

        @error('name')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Status --}}
    <div class="mb-4">
        <label class="form-label fw-bold d-block">Status</label>

        <div class="form-check form-switch mt-2">
            <input type="hidden" name="status" value="0">

            <input
                class="form-check-input"
                type="checkbox"
                name="status"
                value="1"
                id="statusSwitch"
                {{ old('status', $tag->status ?? 1) ? 'checked' : '' }}
            >

            <label class="form-check-label fw-bold" for="statusSwitch">
                Visible on Site
            </label>
        </div>

        @error('status')
            <div class="invalid-feedback d-block">{{ $message }}</div>
        @enderror
    </div>

    <hr>

    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.tags.index') }}" class="btn btn-light px-4 text-muted">
            <i class="bi bi-arrow-left me-1"></i> Cancel
        </a>

        <button type="submit" class="btn btn-primary px-5">
            <i class="bi bi-check2-circle me-1"></i>
            {{ $isEdit ? 'Update Tag' : 'Create Tag' }}
        </button>
    </div>
</form>
