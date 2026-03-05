@extends('layouts.admin')

@section('title', 'Finalize Asset')

@section('content')
<div class="container-fluid">
    <div class="card shadow border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary"><i class="bi bi-image me-2"></i>Upload Final Generated Image</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('assets.update', $asset->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                
                <div class="row">
                    <div class="col-lg-4 border-end">
                        <div class="mb-4">
                            <label class="form-label fw-bold">Select Generated Image</label>
                            <input type="file" name="image" id="imageSelector" class="form-control" accept="image/*" required>
                        </div>
                        <div id="preview-area">
                            @if($asset->image_url)
                                <img src="{{ asset('storage/'.$asset->image_url) }}" class="img-fluid rounded border shadow-sm">
                            @else
                                <div class="bg-light rounded d-flex align-items-center justify-content-center" style="height: 250px; border: 2px dashed #ddd;">
                                    <span class="text-muted">No image uploaded yet</span>
                                </div>
                            @endif
                        </div>
                    </div>

                    <div class="col-lg-8">
                        <div class="row">
                            <div class="col-12 mb-3">
                                <label class="fw-bold">Asset Title</label>
                                <div class="input-group">
                                    <input type="text" id="titleText" name="title" value="{{ $asset->title }}" class="form-control">
                                    <button class="btn btn-outline-primary" type="button" onclick="copyToClipboard('titleText', this)">
                                        <i class="bi bi-clipboard"></i> Copy
                                    </button>
                                </div>
                            </div>

                            <div class="col-12 mb-3">
                                <label class="fw-bold">Asset Description</label>
                                <div class="input-group">
                                    <textarea id="descText" name="description" class="form-control" rows="2">{{ $asset->description }}</textarea>
                                    <button class="btn btn-outline-primary" type="button" onclick="copyToClipboard('descText', this)">
                                        <i class="bi bi-clipboard"></i> Copy
                                    </button>
                                </div>
                            </div>
<div class="col-12 mb-3">
    <label class="fw-bold text-info">Keywords (Comma Separated)</label>
    <div class="input-group">
        {{-- implode converts the array into a string joined by ', ' --}}
        <textarea id="keywordsText" name="keywords_display" class="form-control" rows="3">{{ is_array($asset->keywords) ? implode(', ', $asset->keywords) : $asset->keywords }}</textarea>
        <button class="btn btn-outline-info" type="button" onclick="copyToClipboard('keywordsText', this)">
            <i class="bi bi-clipboard"></i> Copy Keywords
        </button>
    </div>
    <small class="text-muted">Total keywords: {{ is_array($asset->keywords) ? count($asset->keywords) : 0 }}</small>
</div>
                            <div class="col-12 mb-3">
                                <label class="fw-bold text-success">Copy Prompt for AI Tool</label>
                                <div class="input-group">
                                    <textarea id="promptText" name="ai_prompt" class="form-control" rows="4">{{ $asset->ai_prompt }}</textarea>
                                    <button class="btn btn-success" type="button" onclick="copyToClipboard('promptText', this)">
                                        <i class="bi bi-clipboard-check"></i> Copy Prompt
                                    </button>
                                </div>
                            </div>
                        </div>

                        <div class="text-end mt-4">
                            <button type="submit" class="btn btn-primary btn-lg px-5">Save Final Asset</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('scripts')
<script>
// Live Preview
document.getElementById('imageSelector').addEventListener('change', function(e) {
    const area = document.getElementById('preview-area');
    const reader = new FileReader();
    reader.onload = (event) => {
        area.innerHTML = `<img src="${event.target.result}" class="img-fluid rounded border shadow-sm animate__animated animate__fadeIn">`;
    };
    if(e.target.files[0]) reader.readAsDataURL(e.target.files[0]);
});

/**
 * Modern Copy Function
 * @param {string} elementId - The ID of the input/textarea
 * @param {HTMLElement} btn - The button element clicked
 */
async function copyToClipboard(elementId, btn) {
    const copyText = document.getElementById(elementId);
    const originalHtml = btn.innerHTML;

    try {
        // Use modern Clipboard API
        await navigator.clipboard.writeText(copyText.value);

        // Visual Feedback
        btn.classList.replace('btn-outline-primary', 'btn-primary');
        btn.classList.replace('btn-success', 'btn-dark'); // Special case for prompt button
        btn.innerHTML = '<i class="bi bi-check2"></i> Copied!';
        // Inside your existing copyToClipboard function, add this line near the others:
btn.classList.replace('btn-outline-info', 'btn-info');

// And in the setTimeout reset:
btn.classList.replace('btn-info', 'btn-outline-info');

        // Reset button after 2 seconds
        setTimeout(() => {
            btn.innerHTML = originalHtml;
            btn.classList.replace('btn-primary', 'btn-outline-primary');
            btn.classList.replace('btn-dark', 'btn-success');
        }, 2000);

    } catch (err) {
        console.error('Failed to copy: ', err);
        alert("Manual copy required or permission denied.");
    }
}
</script>
@endpush
@endsection