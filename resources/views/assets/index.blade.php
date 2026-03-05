@extends('layouts.admin')

@section('title', 'AI Asset Library')

@section('content')
<div class="container-fluid">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="text-dark fw-bold">AI Image Asset Library</h4>
        <a href="{{ route('assets.create') }}" class="btn btn-primary">
            <i class="bi bi-plus-lg me-1"></i> Generate New Prompt
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success border-0 shadow-sm">{{ session('success') }}</div>
    @endif

    <div class="card shadow border-0">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-light">
                        <tr>
                            <th class="ps-4">Image</th>
                            <th>Title & Description</th>
                            <th>Prompt Snippet</th>
                            <th class="text-end pe-4">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($assets as $asset)
                        <tr>
                            <td class="ps-4">
                                @if($asset->image_url)
                                    <img src="{{ asset('storage/' . $asset->image_url) }}" 
                                         class="rounded shadow-sm" style="width: 80px; height: 60px; object-fit: cover;">
                                @else
                                    <div class="bg-light rounded text-center py-3" style="width: 80px;">
                                        <i class="bi bi-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="fw-bold text-dark">{{ $asset->title }}</div>
                                <small class="text-muted">{{ Str::limit($asset->description, 60) }}</small>
                            </td>
                            <td>
                                <code class="small text-primary bg-light p-1 rounded">
                                    {{ Str::limit($asset->ai_prompt, 40) }}
                                </code>
                            </td>
                            <td class="text-end pe-4">
                                <div class="btn-group">
                                    <a href="{{ route('assets.edit', $asset->id) }}" class="btn btn-sm btn-outline-info">
                                        <i class="bi bi-pencil"></i> Edit/Upload
                                    </a>
                                    <form action="{{ route('assets.destroy', $asset->id) }}" method="POST" class="d-inline">
                                        @csrf @method('DELETE')
                                        <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Permanently delete this asset?')">
                                            <i class="bi bi-trash"></i>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="4" class="text-center py-5 text-muted">
                                <i class="bi bi-inbox fs-2 d-block mb-2"></i>
                                No assets found. Start by generating a prompt!
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <div class="mt-3">
        {{ $assets->links() }} {{-- Pagination Links --}}
    </div>
</div>
@endsection