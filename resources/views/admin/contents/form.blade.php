@php
    $isEdit = isset($content);

    $selectedAgeGroups = old('age_groups', $isEdit ? $content->ageGroups->pluck('id')->toArray() : []);
    $selectedTags = old('tags', $isEdit ? $content->tags->pluck('id')->toArray() : []);
@endphp

<form
    action="{{ $isEdit ? route('admin.contents.update', $content->id) : route('admin.contents.store') }}"
    method="POST"
    enctype="multipart/form-data"
>
    @csrf
    @if($isEdit) @method('PUT') @endif

    <div class="row">
        {{-- Category --}}
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">
                Category <span class="text-danger">*</span>
            </label>

            <select id="categorySelect" name="category_id" class="form-select @error('category_id') is-invalid @enderror" required>
                <option value="">-- Select Category --</option>
                @foreach($categories as $cat)
                    <option value="{{ $cat->id }}"
                        {{ old('category_id', $content->category_id ?? '') == $cat->id ? 'selected' : '' }}
                    >
                        {{ $cat->name }}
                    </option>
                @endforeach
            </select>

            @error('category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Sub Category --}}
        <div class="col-md-6 mb-3">
            <label class="form-label fw-bold">
                Sub Category <span class="text-muted">(optional)</span>
            </label>

            <select id="subCategorySelect" name="sub_category_id" class="form-select @error('sub_category_id') is-invalid @enderror">
                <option value="">-- Select Sub Category --</option>
                @foreach($subCategories as $sub)
                    <option value="{{ $sub->id }}"
                        data-category="{{ $sub->category_id }}"
                        {{ old('sub_category_id', $content->sub_category_id ?? '') == $sub->id ? 'selected' : '' }}
                    >
                        {{ $sub->name }} ({{ $sub->category?->name ?? '' }})
                    </option>
                @endforeach
            </select>

            @error('sub_category_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="form-text small">
                Sub categories auto-filter when you select category.
            </div>
        </div>
    </div>

    {{-- Type --}}
    <div class="mb-3">
        <label class="form-label fw-bold">
            Content Type <span class="text-danger">*</span>
        </label>

        <select name="type" class="form-select @error('type') is-invalid @enderror" required>
            <option value="">-- Select Type --</option>
            @foreach(['worksheet','coloring_page','coloring_book','game'] as $type)
                <option value="{{ $type }}"
                    {{ old('type', $content->type ?? '') == $type ? 'selected' : '' }}
                >
                    {{ strtoupper(str_replace('_',' ', $type)) }}
                </option>
            @endforeach
        </select>

        @error('type')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Title --}}
    <div class="mb-3">
        <label class="form-label fw-bold">
            Title <span class="text-danger">*</span>
        </label>

        <input
            type="text"
            name="title"
            class="form-control @error('title') is-invalid @enderror"
            value="{{ old('title', $content->title ?? '') }}"
            placeholder="e.g., Number Tracing 1 to 10"
            required
        >

        @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    {{-- Description --}}
    <div class="mb-3">
        <label class="form-label fw-bold">
            Description <span class="text-muted">(optional)</span>
        </label>

        <textarea
            name="description"
            rows="4"
            class="form-control @error('description') is-invalid @enderror"
            placeholder="Write short description for SEO and users..."
        >{{ old('description', $content->description ?? '') }}</textarea>

        @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>

    <div class="row">
        {{-- Language --}}
        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Language</label>

            <select name="language" class="form-select @error('language') is-invalid @enderror">
                <option value="">-- Select --</option>
                @foreach(['english','hindi','urdu'] as $lang)
                    <option value="{{ $lang }}"
                        {{ old('language', $content->language ?? '') == $lang ? 'selected' : '' }}
                    >
                        {{ strtoupper($lang) }}
                    </option>
                @endforeach
            </select>

            @error('language')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Difficulty --}}
        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Difficulty</label>

            <select name="difficulty" class="form-select @error('difficulty') is-invalid @enderror">
                <option value="">-- Select --</option>
                @foreach(['easy','medium','hard'] as $diff)
                    <option value="{{ $diff }}"
                        {{ old('difficulty', $content->difficulty ?? '') == $diff ? 'selected' : '' }}
                    >
                        {{ strtoupper($diff) }}
                    </option>
                @endforeach
            </select>

            @error('difficulty')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        {{-- Access Type --}}
        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">
                Access Type <span class="text-danger">*</span>
            </label>

            <select id="accessTypeSelect" name="access_type" class="form-select @error('access_type') is-invalid @enderror" required>
                <option value="free" {{ old('access_type', $content->access_type ?? 'free') == 'free' ? 'selected' : '' }}>
                    FREE
                </option>
                <option value="premium" {{ old('access_type', $content->access_type ?? '') == 'premium' ? 'selected' : '' }}>
                    PREMIUM
                </option>
            </select>

            @error('access_type')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
    </div>

    <div class="row">
        {{-- Price --}}
        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold">Price (₹)</label>

            <input
                id="priceInput"
                type="number"
                name="price"
                class="form-control @error('price') is-invalid @enderror"
                value="{{ old('price', $content->price ?? 0) }}"
                min="0"
                step="1"
            >

            @error('price')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror

            <div class="form-text small">
                Keep 0 for Free content.
            </div>
        </div>

        {{-- Featured --}}
        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold d-block">Featured</label>

            <div class="form-check form-switch mt-2">
                <input type="hidden" name="is_featured" value="0">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="is_featured"
                    value="1"
                    id="featuredSwitch"
                    {{ old('is_featured', $content->is_featured ?? 0) ? 'checked' : '' }}
                >

                <label class="form-check-label fw-bold" for="featuredSwitch">
                    Show in Featured Section
                </label>
            </div>
        </div>

        {{-- Status --}}
        <div class="col-md-4 mb-3">
            <label class="form-label fw-bold d-block">Status</label>

            <div class="form-check form-switch mt-2">
                <input type="hidden" name="status" value="0">

                <input
                    class="form-check-input"
                    type="checkbox"
                    name="status"
                    value="1"
                    id="statusSwitch"
                    {{ old('status', $content->status ?? 1) ? 'checked' : '' }}
                >

                <label class="form-check-label fw-bold" for="statusSwitch">
                    Visible on Site
                </label>
            </div>
        </div>
    </div>

    {{-- Age Groups --}}
    <div class="mb-3">
        <label class="form-label fw-bold">
            Age Groups <span class="text-muted">(optional)</span>
        </label>

        <div class="row">
            @foreach($ageGroups as $age)
                <div class="col-md-3 col-6 mb-2">
                    <label class="border rounded-3 p-2 w-100 d-flex align-items-center gap-2">
                        <input
                            type="checkbox"
                            name="age_groups[]"
                            value="{{ $age->id }}"
                            {{ in_array($age->id, $selectedAgeGroups) ? 'checked' : '' }}
                        >
                        <span class="fw-semibold">{{ $age->label }}</span>
                    </label>
                </div>
            @endforeach
        </div>

        @error('age_groups')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    {{-- Tags --}}
    <div class="mb-4">
        <label class="form-label fw-bold">
            Tags <span class="text-muted">(optional)</span>
        </label>

        <div class="row">
            @foreach($tags as $tag)
                <div class="col-md-3 col-6 mb-2">
                    <label class="border rounded-3 p-2 w-100 d-flex align-items-center gap-2">
                        <input
                            type="checkbox"
                            name="tags[]"
                            value="{{ $tag->id }}"
                            {{ in_array($tag->id, $selectedTags) ? 'checked' : '' }}
                        >
                        <span class="fw-semibold">{{ $tag->name }}</span>
                    </label>
                </div>
            @endforeach
        </div>

        @error('tags')
            <div class="text-danger small">{{ $message }}</div>
        @enderror
    </div>

    {{-- 🔥 Modern Upload UI --}}
    <div class="mb-4">
        <label class="form-label fw-bold">
            Upload Files <span class="text-muted">(PDF / PNG / JPG / MP4)</span>
        </label>

        <div
            class="border rounded-4 p-4 bg-light"
            style="border-style:dashed !important;"
        >
            <div class="d-flex align-items-center gap-3">
                <div class="fs-1">📁</div>
                <div>
                    <div class="fw-bold">Drag & Drop your files here</div>
                    <div class="text-muted small">
                        Or click the button below to choose files
                    </div>
                </div>
            </div>

            <div class="mt-3">
                <input
                    id="fileInput"
                    type="file"
                    name="files[]"
                    class="form-control @error('files') is-invalid @enderror"
                    multiple
                    accept=".pdf,.png,.jpg,.jpeg,.mp4"
                >
            </div>

            <div class="form-text mt-2">
                Max 20MB per file. You can upload multiple files.
            </div>

            @error('files')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror

            @error('files.*')
                <div class="text-danger small mt-2">{{ $message }}</div>
            @enderror

            {{-- Preview list --}}
            <div id="filePreview" class="mt-3"></div>
        </div>
    </div>

    {{-- Existing files (Edit only) --}}
    @if($isEdit && isset($content->files) && $content->files->count())
        <div class="mb-4">
            <label class="form-label fw-bold">Existing Uploaded Files</label>

            <div class="list-group shadow-sm rounded-4 overflow-hidden">
                @foreach($content->files as $file)
                    <div class="list-group-item d-flex justify-content-between align-items-center py-3">
                        <div>
                            <div class="fw-bold">{{ $file->original_name }}</div>
                            <div class="small text-muted">
                                {{ $file->file_type }} • {{ $file->file_size_kb }} KB
                            </div>
                        </div>

                        <div class="d-flex gap-2">
                            <a href="{{ asset('storage/' . $file->file_path) }}"
                               target="_blank"
                               class="btn btn-sm btn-outline-primary rounded-pill px-3">
                                View
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="form-text mt-2">
                (Delete option can be added next.)
            </div>
        </div>
    @endif

    <hr>

    <div class="d-flex justify-content-between align-items-center">
        <a href="{{ route('admin.contents.index') }}" class="btn btn-light px-4 text-muted">
            <i class="bi bi-arrow-left me-1"></i> Cancel
        </a>

        <button type="submit" class="btn btn-primary px-5 rounded-pill">
            <i class="bi bi-check2-circle me-1"></i>
            {{ $isEdit ? 'Update Content' : 'Create Content' }}
        </button>
    </div>
</form>

@push('scripts')
<script>
    // Sub category filter
    function filterSubCategories() {
        const categoryId = document.getElementById('categorySelect').value;
        const subSelect = document.getElementById('subCategorySelect');
        const options = subSelect.querySelectorAll('option');

        options.forEach(opt => {
            const optCat = opt.getAttribute('data-category');
            if (!optCat) return;

            opt.style.display = (categoryId && optCat === categoryId) ? 'block' : 'none';
        });

        // reset if selected not matching
        const selectedOption = subSelect.options[subSelect.selectedIndex];
        if (selectedOption && selectedOption.getAttribute('data-category') !== categoryId) {
            subSelect.value = "";
        }
    }

    document.getElementById('categorySelect').addEventListener('change', filterSubCategories);
    window.addEventListener('load', filterSubCategories);

    // Access type → auto price
    const accessType = document.getElementById("accessTypeSelect");
    const priceInput = document.getElementById("priceInput");

    function updatePriceField() {
        if (accessType.value === "free") {
            priceInput.value = 0;
            priceInput.setAttribute("readonly", "readonly");
        } else {
            priceInput.removeAttribute("readonly");
        }
    }

    accessType.addEventListener("change", updatePriceField);
    window.addEventListener("load", updatePriceField);

    // Modern file preview
    const fileInput = document.getElementById("fileInput");
    const preview = document.getElementById("filePreview");

    fileInput.addEventListener("change", function () {
        preview.innerHTML = "";

        if (!this.files.length) return;

        const list = document.createElement("div");
        list.className = "list-group mt-2 rounded-4 overflow-hidden";

        Array.from(this.files).forEach((file) => {
            const item = document.createElement("div");
            item.className = "list-group-item d-flex justify-content-between align-items-center py-3";

            const left = document.createElement("div");
            left.innerHTML = `
                <div class="fw-bold">${file.name}</div>
                <div class="small text-muted">${(file.size / 1024).toFixed(1)} KB</div>
            `;

            const badge = document.createElement("span");
            badge.className = "badge bg-primary rounded-pill px-3 py-2";
            badge.innerText = file.type ? file.type : "file";

            item.appendChild(left);
            item.appendChild(badge);

            list.appendChild(item);
        });

        preview.appendChild(list);
    });
</script>
@endpush
