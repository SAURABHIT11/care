@extends('layouts.admin') {{-- Assuming your provided code is layouts/admin.blade.php --}}

@section('title', 'AI Image Upscaler')

@section('content')
<div class="container-fluid">
    <div class="card shadow border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary"><i class="bi bi-cloud-upload me-2"></i>Upload Images for Upscaling</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold">Select Images (PNG recommended)</label>
                    <input type="file" name="images[]" id="imageSelector" multiple class="form-control" accept="image/*" required>
                </div>

                <div id="preview-area" class="row g-3">
                    </div>

                <div class="mt-4 text-end">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-cpu me-2"></i> Start AI Processing
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
document.getElementById('imageSelector').addEventListener('change', function(e) {
    const area = document.getElementById('preview-area');
    area.innerHTML = ''; // Clear previous
    
    Array.from(e.target.files).forEach((file, index) => {
        const reader = new FileReader();
        reader.onload = (event) => {
            const card = `
                <div class="col-md-6 col-lg-4">
                    <div class="card h-100 border shadow-sm">
                        <img src="${event.target.result}" class="card-img-top p-2" style="height: 180px; object-fit: cover; border-radius: 12px;">
                        <div class="card-body pt-0">
                            <div class="mb-2">
                                <input type="text" name="data[${index}][title]" class="form-control form-control-sm" placeholder="Title" required>
                            </div>
                            <div class="mb-2">
                                <textarea name="data[${index}][description]" class="form-control form-control-sm" rows="2" placeholder="Description"></textarea>
                            </div>
                            <div>
                                <input type="text" name="data[${index}][keywords]" class="form-control form-control-sm" placeholder="Keywords (Tags)">
                            </div>
                        </div>
                    </div>
                </div>`;
            area.insertAdjacentHTML('beforeend', card);
        };
        reader.readAsDataURL(file);
    });
});
</script>
@endpush
@endsection