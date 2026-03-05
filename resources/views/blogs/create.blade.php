@extends('layouts.admin')
@section('title', 'AI Blog Generator')

@section('content')

    <div class="container-fluid">

        {{-- Success Message --}}
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show shadow-sm">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- Error Messages --}}
        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show shadow-sm">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
        @endif

        {{-- ===============================
        STEP 1: Generate Prompt
        ================================ --}}

        <div class="card shadow border-0 mb-4">
            <div class="card-header bg-white">
                <h5 class="mb-0">AI Blog Generator</h5>
            </div>

            <div class="card-body">

                <form method="POST">
                    @csrf

                    <div class="mb-3">
                        <label class="fw-bold">Blog Topic</label>
                        <textarea name="user_prompt" class="form-control" rows="3"
                            required>{{ session('ai_user_prompt') }}</textarea>
                    </div>

                    <div class="row">

                        <div class="col-md-3">
                            <label class="fw-bold">Tone</label>
                            <select name="tone" class="form-control">
                                <option value="professional">Professional</option>
                                <option value="seo">SEO Optimized</option>
                                <option value="technical">Technical</option>
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="fw-bold">Word Count</label>
                            <input type="number" name="word_count" value="{{ session('ai_word_count', 250) }}"
                                class="form-control">
                        </div>

                        <div class="col-md-3">
                            <label class="fw-bold">Category</label>
                            <select name="category_id" class="form-control">
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}">
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-3">
                            <label class="fw-bold">Status</label>
                            <select name="status" class="form-control">
                                <option value="draft">Draft</option>
                                <option value="published">Publish</option>
                            </select>
                        </div>

                    </div>

                    <div class="mt-4 d-flex gap-2">

                        {{-- Step-by-step Prompt Generation --}}
                        <button type="submit" formaction="{{ route('admin.blogs.generatePrompt') }}"
                            class="btn btn-primary w-50">
                            Generate Refined Prompt
                        </button>

                        {{-- Direct Blog Generation --}}
                        <button type="submit" formaction="{{ route('admin.blogs.generate') }}" class="btn btn-success w-50">
                            Generate Blog Directly
                        </button>

                    </div>

                </form>

            </div>
        </div>


        {{-- ===============================
        STEP 2: Show Refined Prompt
        ================================ --}}

        @if(session('ai_refined_prompt'))

            <div class="card shadow border-0 mb-4">
                <div class="card-header bg-white">
                    <h5 class="mb-0">Refined Prompt (Editable)</h5>
                </div>
                <div class="card-body">

                    <form action="{{ route('admin.blogs.generateBlog') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <textarea name="refined_prompt" rows="8"
                                class="form-control">{{ session('ai_refined_prompt') }}</textarea>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <label>Category</label>
                                <select name="category_id" class="form-control">
                                    @foreach($categories as $category)
                                        <option value="{{ $category->id }}">
                                            {{ $category->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4">
                                <label>Status</label>
                                <select name="status" class="form-control">
                                    <option value="draft">Draft</option>
                                    <option value="published">Publish</option>
                                </select>
                            </div>

                            <div class="col-md-4 d-flex align-items-end gap-2">
                                <button class="btn btn-success w-100">
                                    Generate Full Blog
                                </button>

                                <a href="{{ route('admin.blogs.create') }}" class="btn btn-warning w-100">
                                    Regenerate
                                </a>
                            </div>
                        </div>

                    </form>

                </div>
            </div>

        @endif


        {{-- ===============================
        RECENT BLOGS
        ================================ --}}

        <div class="card shadow border-0">
            <div class="card-header bg-white">
                <h5 class="mb-0">Recently Generated Blogs</h5>
            </div>

            <div class="card-body p-0">

                @if($recentBlogs->count())

                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="bg-light">
                                <tr>
                                    <th>Title</th>
                                    <th>Excerpt</th>
                                    <th>blog</th>
                                    <th>Category</th>
                                    <th>Status</th>
                                    <th>Created</th>
                                    <th class="text-end">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentBlogs as $blog)
                                    <tr>
                                        <td class="fw-bold">
                                            {{ ($blog->title) }}
                                        </td>

                                        <td>
                                            {{ ($blog->excerpt) }}
                                        </td>
                                        <td>
                                            {!! $blog->content !!}
                                        </td>

                                        <td>
                                            {{ $blog->category->name ?? '—' }}
                                        </td>

                                        <td>
                                            <span class="badge bg-{{ $blog->status == 'published' ? 'success' : 'secondary' }}">
                                                {{ ucfirst($blog->status) }}
                                            </span>
                                        </td>

                                        <td>
                                            {{ $blog->created_at->format('d M Y') }}
                                        </td>

                                        <td class="text-end">

                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                @else
                    <div class="p-4 text-muted">
                        No blogs created yet.
                    </div>
                @endif

            </div>
        </div>

    </div>

@endsection