@extends('layouts.admin')

@section('title', 'Verify AI Suggestions')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-dark fw-bold">Review Generated Variations</h4>
        <div class="btn-group">
            <a href="{{ route('assets.create') }}" class="btn btn-outline-secondary btn-sm">
                <i class="bi bi-arrow-left me-1"></i> Try Different Query
            </a>
            <a href="{{ route('assets.index') }}" class="btn btn-primary btn-sm">
                <i class="bi bi-collection me-1"></i> Go to Library
            </a>
        </div>
    </div>

    {{-- Container for AJAX cards --}}
    <div class="row g-3" id="variation-container">
        @isset($results)
            @forelse($results as $index => $res)
                <div class="col-md-6 col-lg-4 variation-card-wrapper" id="wrapper-{{ $index }}">
                    <div class="card h-100 border-0 shadow-sm">
                        <div class="card-header bg-light d-flex justify-content-between align-items-center">
                            <span class="fw-bold text-muted">Option #{{ $index + 1 }}</span>
                            <button type="button" class="btn-close small" onclick="dismissCard('wrapper-{{ $index }}')" title="Dismiss"></button>
                        </div>
                        <div class="card-body">
                            <form class="save-asset-form" data-wrapper-id="wrapper-{{ $index }}">
                                @csrf
                                <div class="mb-2">
                                    <label class="small fw-bold text-primary">Title</label>
                                    <input type="text" name="title" value="{{ $res['title'] ?? '' }}" class="form-control form-control-sm" required>
                                </div>
                                <div class="mb-2">
                                    <label class="small fw-bold text-primary">AI Generation Prompt</label>
                                    <textarea name="ai_prompt" class="form-control form-control-sm" rows="5" required>{{ $res['ai_prompt'] ?? '' }}</textarea>
                                </div>
                                <div class="mb-2">
                                    <label class="small fw-bold text-primary">Description</label>
                                    <textarea name="description" class="form-control form-control-sm" rows="2">{{ $res['description'] ?? '' }}</textarea>
                                </div>
                                <div class="mb-3">
                                    <label class="small fw-bold text-primary">Keywords</label>
                                    <input type="text" name="keywords_raw" value="{{ implode(', ', $res['keywords'] ?? []) }}" class="form-control form-control-sm mb-2">
                                    
                                    {{-- Hidden inputs for actual array storage --}}
                                    @foreach($res['keywords'] ?? [] as $kw)
                                        <input type="hidden" name="keywords[]" value="{{ $kw }}">
                                    @endforeach
                                </div>
                                
                                <button type="submit" class="btn btn-success w-100 btn-save">
                                    <i class="bi bi-check-circle me-1"></i> Approve & Save
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center py-5">
                    <div class="alert alert-info">No variations found. Please try generating again.</div>
                </div>
            @endforelse
        @else
            <div class="col-12 text-center py-5">
                <div class="alert alert-warning">
                    <h5><i class="bi bi-exclamation-triangle me-2"></i>Data Missing</h5>
                    <p>It seems the AI results didn't load correctly.</p>
                    <a href="{{ route('assets.create') }}" class="btn btn-primary">Return to Generator</a>
                </div>
            </div>
        @endisset
    </div>
</div>

@push('scripts')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // CSRF Header Setup
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $('.save-asset-form').on('submit', function(e) {
            e.preventDefault();

            const form = $(this);
            const wrapperId = form.data('wrapper-id');
            const submitBtn = form.find('.btn-save');
            const originalContent = submitBtn.html();

            submitBtn.prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Saving...');

            $.ajax({
                url: "{{ route('assets.store') }}",
                method: "POST",
                data: form.serialize(), // This still helps send all form inputs
                dataType: "json",
                success: function(response) {
                    $(`#${wrapperId}`).fadeOut(400, function() {
                        $(this).remove();
                        checkEmptyState();
                    });
                },
                error: function(xhr) {
                    submitBtn.prop('disabled', false).html(originalContent);
                    // Catch-all for CSRF errors
                    if(xhr.status === 419) {
                        alert('Session expired. Please refresh the page.');
                    } else {
                        alert('Error: ' + (xhr.responseJSON?.message || 'Could not save asset.'));
                    }
                }
            });
        });
    });

    function checkEmptyState() {
        if ($('.variation-card-wrapper').length === 0) {
            window.location.href = "{{ route('assets.index') }}";
        }
    }
</script>
@endpush
@endsection