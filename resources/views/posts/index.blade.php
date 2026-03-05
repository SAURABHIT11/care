@extends('layouts.admin')

@section('title', 'Upscaled Gallery')

@section('content')
<div class="container-fluid">
    <div class="row mb-4 align-items-center">
        <div class="col-md-6">
            <h4 class="fw-bold"><i class="bi bi-images me-2 text-primary"></i>Upscaled Images</h4>
        </div>
        <div class="col-md-6">
            <form action="{{ route('posts.index') }}" method="GET" class="d-flex">
                <div class="input-group">
                    <input type="text" name="search" class="form-control border-end-0" placeholder="Search by title or tags..." value="{{ request('search') }}">
                    <button class="btn btn-outline-primary border-start-0" type="submit">
                        <i class="bi bi-search"></i>
                    </button>
                </div>
                @if(request('search'))
                    <a href="{{ route('posts.index') }}" class="btn btn-light ms-2 text-nowrap">Clear</a>
                @endif
            </form>
        </div>
    </div>

    <div class="row g-4">
        @forelse($posts as $post)
            <div class="col-sm-6 col-md-4 col-lg-3">
                <div class="card h-100 shadow-sm border-0 overflow-hidden">
                    <a href="{{ asset('storage/' . $post->upscaled_filename) }}" target="_blank">
                        <img src="{{ asset('storage/' . $post->upscaled_filename) }}" 
                             class="card-img-top" 
                             style="height: 200px; object-fit: cover;"
                             alt="{{ $post->title }}"
                             onerror="this.src='https://placehold.co/400x300?text=Processing...'">
                    </a>
                    
                    <div class="card-body">
                        <h6 class="card-title fw-bold text-truncate mb-1">{{ $post->title }}</h6>
                        <p class="card-text small text-muted text-truncate mb-2">
                            {{ $post->description ?? 'No description provided.' }}
                        </p>
                        
                        @if($post->keywords)
                            @foreach(explode(',', $post->keywords) as $tag)
                                <span class="badge bg-light text-dark border p-1 px-2 mb-1" style="font-size: 10px;">
                                    #{{ trim($tag) }}
                                </span>
                            @endforeach
                        @endif
                    </div>
                    
                    <div class="card-footer bg-white border-top-0 d-flex justify-content-between align-items-center">
                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                        <a href="{{ asset('storage/' . $post->upscaled_filename) }}" download class="btn btn-sm btn-outline-success">
                            <i class="bi bi-download"></i>
                        </a>
                    </div>
                </div>
            </div>
        @empty
            <div class="col-12 text-center py-5">
                <i class="bi bi-emoji-frown display-1 text-muted"></i>
                <p class="mt-3 fs-5">No images found. Time to upscale something!</p>
                <a href="{{ route('posts.create') }}" class="btn btn-primary mt-2">Upload Now</a>
            </div>
        @endforelse
    </div>

    <div class="d-flex justify-content-center mt-5">
        {{ $posts->appends(request()->input())->links('pagination::bootstrap-5') }}
    </div>
</div>
@endsection