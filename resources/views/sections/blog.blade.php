<section id="blogs" class="tips-section">
    <div class="container">

        <div class="row align-items-end mb-5">
            <div class="col-md-7">
                <h2 class="section-title">
                    Latest <span>Blogs</span>
                </h2>
            </div>


        </div>

        <div class="row g-4">

            @forelse($blogs as $blog)

                <div class="col-md-6 col-lg-4">
                    <div class="blog-card h-100 shadow-sm border-0 rounded">

                        {{-- Featured Badge --}}
                        @if($blog->is_featured)
                            <span class="badge bg-warning position-absolute m-2">
                                ⭐ Featured
                            </span>
                        @endif

                        {{-- Image --}}
                        <div class="blog-thumb">
                            @if($blog->featured_image)
                                <img src="{{ asset('storage/' . $blog->featured_image) }}"
                                    alt="{{ $blog->featured_image_alt ?? $blog->title }}" class="img-fluid w-100"
                                    style="height:180px; object-fit:cover;">
                            @else
                                <div class="bg-light text-center py-5">
                                    📄 No Image
                                </div>
                            @endif
                        </div>

                        <div class="p-3 d-flex flex-column" style="min-height:260px;">

                            {{-- Category --}}
                            <span class="badge bg-light text-dark mb-2">
                                {{ $blog->category->name ?? 'General' }}
                            </span>

                            {{-- Title --}}
                            <h6 class="fw-bold">
                                {{ \Str::limit($blog->title, 70) }}
                            </h6>

                            {{-- Excerpt --}}
                            <p class="text-muted small flex-grow-1">
                                {{ \Str::limit($blog->excerpt, 120) }}
                            </p>

                            {{-- Meta Info --}}
                            <div class="small text-muted mb-2">

                                {{-- Date --}}
                                <i class="bi bi-calendar"></i>
                                {{ optional($blog->published_at)->format('d M Y') ?? $blog->created_at->format('d M Y') }}

                                <br>

                                {{-- Read Time --}}
                                <i class="bi bi-clock"></i>
                                {{ ceil($blog->word_count / 200) }} min read

                                <br>

                                {{-- Views --}}
                                <i class="bi bi-eye"></i>
                                {{ number_format($blog->views) }} views

                            </div>

                            {{-- Read More --}}
                            <button class="btn btn-sm btn-outline-primary open-blog d-block" style="z-index:999;"
                                data-id="{{ $blog->id }}">
                                Read More →
                            </button>

                        </div>

                    </div>
                </div>

            @empty

                <div class="col-12 text-center text-muted">
                    No blogs available yet.
                </div>

            @endforelse

        </div>
    </div>

    <div class="modal fade" id="blogModal" tabindex="-1">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 class="modal-title" id="blogTitle"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                </div>

                <div class="modal-body">

                    {{-- Image --}}
                    <img id="blogImage" class="img-fluid mb-3" style="display:none;">

                    {{-- Content --}}
                    <div id="blogContent"></div>

                </div>

            </div>
        </div>
    </div>
    <script>
        const blogDataUrl = "{{ route('blog.data', ':id') }}";

        document.addEventListener('click', function (e) {

            if (e.target.classList.contains('open-blog')) {

                let blogId = e.target.dataset.id;

                let url = blogDataUrl.replace(':id', blogId);

                // Loader
                document.getElementById('blogContent').innerHTML = "Loading...";
                document.getElementById('blogTitle').innerText = "";

                fetch(url)
                    .then(res => res.json())
                    .then(data => {

                        document.getElementById('blogTitle').innerText = data.title;
                        document.getElementById('blogContent').innerHTML = data.content;

                        let img = document.getElementById('blogImage');

                        if (data.image) {
                            img.src = data.image;
                            img.style.display = 'block';
                        } else {
                            img.style.display = 'none';
                        }

                        let modal = new bootstrap.Modal(document.getElementById('blogModal'));
                        modal.show();
                    })
                    .catch(err => {
                        console.error(err);
                        document.getElementById('blogContent').innerHTML = "Failed to load blog.";
                    });
            }

        });
    </script>
    <script>
        document.getElementById('blogModal').addEventListener('hidden.bs.modal', function () {
            document.getElementById('blogContent').innerHTML = '';
            document.getElementById('blogTitle').innerText = '';
        });
    </script>
</section>