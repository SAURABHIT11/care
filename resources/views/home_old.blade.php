@extends('layouts.guest')

@section('title', 'KidsNest - Worksheets, Coloring Pages & Learning Games')

@section('content')

<!-- HERO -->
<section class="hero">
    <div class="container">
        <div class="row g-4 align-items-center">
            <div class="col-lg-7">
                <div class="badge-soft d-inline-flex align-items-center mb-3">
                    <i class="bi bi-stars me-2"></i> Learning made fun for kids (Age 3–10)
                </div>

                <h1 class="display-4 fw-bold mb-3">
                    Printable Worksheets, Coloring Pages & Fun Learning Games
                </h1>

                <p class="lead text-muted mb-4">
                    Explore high-quality educational resources for <b>KG to Class 2</b>.
                    Perfect for home learning, tuition, and classroom activities.
                </p>

                <div class="d-flex flex-wrap gap-3">
                    <a href="#categories" class="btn btn-primary btn-pill">
                        Explore Categories <i class="bi bi-arrow-right ms-2"></i>
                    </a>
                    <a href="#worksheets" class="btn btn-outline-primary btn-pill">
                        Free Worksheets <i class="bi bi-file-earmark-text ms-2"></i>
                    </a>
                </div>

                <div class="row g-3 mt-4">
                    <div class="col-6 col-md-3">
                        <div class="p-3 bg-white rounded-4 border">
                            <div class="fw-bold text-primary fs-5">1000+</div>
                            <div class="text-muted small">Worksheets</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 bg-white rounded-4 border">
                            <div class="fw-bold text-warning fs-5">500+</div>
                            <div class="text-muted small">Coloring Pages</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 bg-white rounded-4 border">
                            <div class="fw-bold text-success fs-5">50+</div>
                            <div class="text-muted small">Learning Games</div>
                        </div>
                    </div>
                    <div class="col-6 col-md-3">
                        <div class="p-3 bg-white rounded-4 border">
                            <div class="fw-bold text-danger fs-5">KG–2</div>
                            <div class="text-muted small">Target Grades</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="hero-card">
                    <div class="hero-img"></div>
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between gap-3 flex-wrap">
                            <div>
                                <div class="fw-bold fs-5">Start with Free Packs</div>
                                <div class="text-muted small">Alphabet • Numbers • Shapes • Colors</div>
                            </div>
                            <a href="#worksheets" class="btn btn-primary btn-pill">
                                Download <i class="bi bi-download ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- FEATURES -->
<section class="py-5">
    <div class="container py-2">
        <div class="text-center mx-auto mb-5" style="max-width:820px;">
            <div class="badge-soft d-inline-flex mb-3">Why Parents Love Us</div>
            <h2 class="display-6 fw-bold">Everything Kids Need to Learn & Create</h2>
            <p class="text-muted mb-0">
                Designed to be printable, screen-friendly, and easy to use at home.
            </p>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-xl-3">
                <div class="feature-card p-4">
                    <div class="icon-bubble mb-3"><i class="bi bi-printer"></i></div>
                    <h5 class="fw-bold">Print-Ready PDFs</h5>
                    <p class="text-muted mb-0">Perfect A4 worksheets & coloring pages with clean outlines.</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="feature-card p-4">
                    <div class="icon-bubble mb-3"><i class="bi bi-pencil"></i></div>
                    <h5 class="fw-bold">Tracing & Writing</h5>
                    <p class="text-muted mb-0">Alphabet, numbers, words, and handwriting practice for kids.</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="feature-card p-4">
                    <div class="icon-bubble mb-3"><i class="bi bi-palette"></i></div>
                    <h5 class="fw-bold">Coloring Books</h5>
                    <p class="text-muted mb-0">Animals, cartoons, festivals, and simple toddler-friendly art.</p>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="feature-card p-4">
                    <div class="icon-bubble mb-3"><i class="bi bi-controller"></i></div>
                    <h5 class="fw-bold">Learning Games</h5>
                    <p class="text-muted mb-0">Math & English mini games to boost focus and speed.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- CATEGORIES -->
<section id="categories" class="py-5" style="background:var(--k-soft);">
    <div class="container py-2">
        <div class="d-flex align-items-end justify-content-between flex-wrap gap-3 mb-4">
            <div>
                <div class="badge-soft d-inline-flex mb-2">Popular Categories</div>
                <h2 class="fw-bold mb-0">Explore by Topic</h2>
            </div>
            <a href="#worksheets" class="btn btn-outline-primary btn-pill">
                View All <i class="bi bi-grid ms-2"></i>
            </a>
        </div>

        <div class="row g-4">
            <div class="col-md-6 col-xl-3">
                <div class="cat-card">
                    <div class="cat-img">
                        <img class="img-fluid w-100" src="https://images.unsplash.com/photo-1503676260728-1c00da094a0b?q=80&w=1400&auto=format&fit=crop" alt="">
                    </div>
                    <div class="p-4">
                        <h5 class="fw-bold">Alphabet & Phonics</h5>
                        <p class="text-muted mb-3">A–Z tracing, letter sounds, and reading basics.</p>
                        <a href="#" class="fw-bold text-primary text-decoration-none">Explore <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="cat-card">
                    <div class="cat-img">
                        <img class="img-fluid w-100" src="https://images.unsplash.com/photo-1526634332515-d56c9a5a4b6b?q=80&w=1400&auto=format&fit=crop" alt="">
                    </div>
                    <div class="p-4">
                        <h5 class="fw-bold">Numbers & Math</h5>
                        <p class="text-muted mb-3">Counting, addition, subtraction, and comparisons.</p>
                        <a href="#" class="fw-bold text-primary text-decoration-none">Explore <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="cat-card">
                    <div class="cat-img">
                        <img class="img-fluid w-100" src="https://images.unsplash.com/photo-1542810634-71277d95dcbb?q=80&w=1400&auto=format&fit=crop" alt="">
                    </div>
                    <div class="p-4">
                        <h5 class="fw-bold">Coloring Pages</h5>
                        <p class="text-muted mb-3">Simple outlines for toddlers + fun pages for kids.</p>
                        <a href="#" class="fw-bold text-primary text-decoration-none">Explore <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-3">
                <div class="cat-card">
                    <div class="cat-img">
                        <img class="img-fluid w-100" src="https://images.unsplash.com/photo-1516979187457-637abb4f9353?q=80&w=1400&auto=format&fit=crop" alt="">
                    </div>
                    <div class="p-4">
                        <h5 class="fw-bold">Learning Games</h5>
                        <p class="text-muted mb-3">Interactive games that make learning exciting.</p>
                        <a href="#" class="fw-bold text-primary text-decoration-none">Explore <i class="bi bi-arrow-right"></i></a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Stats strip -->
        <div class="stats mt-5">
            <div class="row g-4 text-center">
                <div class="col-6 col-lg-3">
                    <div class="fw-bold fs-3">10k+</div>
                    <div class="small text-white-50">Happy Parents</div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="fw-bold fs-3">2M+</div>
                    <div class="small text-white-50">Downloads</div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="fw-bold fs-3">3–10</div>
                    <div class="small text-white-50">Age Group</div>
                </div>
                <div class="col-6 col-lg-3">
                    <div class="fw-bold fs-3">A4</div>
                    <div class="small text-white-50">Perfect Printable</div>
                </div>
            </div>
        </div>

    </div>
</section>

<!-- WORKSHEETS -->
<section id="worksheets" class="py-5">
    <div class="container py-2">
        <div class="text-center mx-auto mb-5" style="max-width:820px;">
            <div class="badge-soft d-inline-flex mb-3">Worksheets & Books</div>
            <h2 class="display-6 fw-bold">Latest Worksheets & Printable Packs</h2>
            <p class="text-muted mb-0">
                Download worksheets for KG, Nursery, LKG, UKG, Class 1 and Class 2.
            </p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-md-6 col-xl-4">
                <div class="cat-card">
                    <div class="cat-img">
                        <img class="img-fluid w-100" src="https://images.unsplash.com/photo-1455885666463-76cc7a17f46a?q=80&w=1400&auto=format&fit=crop" alt="">
                    </div>
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge text-bg-primary rounded-pill">Free</span>
                            <span class="small text-muted"><i class="bi bi-filetype-pdf me-1"></i> PDF</span>
                        </div>
                        <h5 class="fw-bold">Alphabet Tracing (A–Z)</h5>
                        <p class="text-muted mb-3">Letter tracing worksheets with fun pictures.</p>
                        <a class="btn btn-primary btn-pill w-100" href="#">
                            Download Now <i class="bi bi-download ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="cat-card">
                    <div class="cat-img">
                        <img class="img-fluid w-100" src="https://images.unsplash.com/photo-1604881990409-b9f246db39da?q=80&w=1400&auto=format&fit=crop" alt="">
                    </div>
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge text-bg-warning rounded-pill">Popular</span>
                            <span class="small text-muted"><i class="bi bi-printer me-1"></i> Printable</span>
                        </div>
                        <h5 class="fw-bold">Numbers 1–50 Practice</h5>
                        <p class="text-muted mb-3">Counting, tracing, and number recognition.</p>
                        <a class="btn btn-primary btn-pill w-100" href="#">
                            Download Now <i class="bi bi-download ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-md-6 col-xl-4">
                <div class="cat-card">
                    <div class="cat-img">
                        <img class="img-fluid w-100" src="https://images.unsplash.com/photo-1516627145497-ae6968895b74?q=80&w=1400&auto=format&fit=crop" alt="">
                    </div>
                    <div class="p-4">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="badge text-bg-success rounded-pill">New</span>
                            <span class="small text-muted"><i class="bi bi-palette me-1"></i> Coloring</span>
                        </div>
                        <h5 class="fw-bold">Animals Coloring Book Pack</h5>
                        <p class="text-muted mb-3">Clean black outlines for easy coloring.</p>
                        <a class="btn btn-primary btn-pill w-100" href="#">
                            Download Now <i class="bi bi-download ms-2"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="text-center mt-4">
                <a class="btn btn-outline-primary btn-pill" href="#">
                    View All Worksheets <i class="bi bi-arrow-right ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- GAMES -->
<section id="games" class="py-5" style="background:var(--k-soft);">
    <div class="container py-2">
        <div class="row g-5 align-items-center">
            <div class="col-lg-6">
                <div class="badge-soft d-inline-flex mb-3">Interactive Learning</div>
                <h2 class="display-6 fw-bold mb-3">Educational Games for Kids</h2>
                <p class="text-muted mb-4">
                    Kids learn faster when they play. Try our fun games for math, spelling,
                    memory, and quick thinking.
                </p>

                <div class="row g-3">
                    <div class="col-12">
                        <div class="feature-card p-4">
                            <div class="d-flex gap-3">
                                <div class="icon-bubble"><i class="bi bi-balloon"></i></div>
                                <div>
                                    <div class="fw-bold">Balloon Pop Math</div>
                                    <div class="text-muted small">Addition & subtraction practice with fun pop animation.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="feature-card p-4">
                            <div class="d-flex gap-3">
                                <div class="icon-bubble"><i class="bi bi-spellcheck"></i></div>
                                <div>
                                    <div class="fw-bold">Spelling Builder</div>
                                    <div class="text-muted small">Word building for KG & Class 1.</div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="feature-card p-4">
                            <div class="d-flex gap-3">
                                <div class="icon-bubble"><i class="bi bi-grid-3x3-gap"></i></div>
                                <div>
                                    <div class="fw-bold">Memory Matching</div>
                                    <div class="text-muted small">Boost focus and observation skills.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-4">
                    <a href="#" class="btn btn-primary btn-pill">
                        Play Games <i class="bi bi-controller ms-2"></i>
                    </a>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="hero-card">
                    <div style="min-height:420px;background:
                        linear-gradient(rgba(37,99,235,.18), rgba(255,107,53,.12)),
                        url('https://images.unsplash.com/photo-1544776193-32d404ae608a?q=80&w=1600&auto=format&fit=crop')
                        center/cover no-repeat;">
                    </div>
                    <div class="p-4">
                        <div class="d-flex align-items-center justify-content-between flex-wrap gap-3">
                            <div>
                                <div class="fw-bold fs-5">Try Free Games Today</div>
                                <div class="text-muted small">No install • Works on mobile & desktop</div>
                            </div>
                            <a href="#" class="btn btn-outline-primary btn-pill">
                                Start <i class="bi bi-arrow-right ms-2"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- ABOUT -->
<section id="about" class="py-5">
    <div class="container py-2">
        <div class="row g-5 align-items-center">
            <div class="col-lg-5">
                <div class="hero-card">
                    <div style="min-height:420px;background:
                        linear-gradient(rgba(15,23,42,.18), rgba(15,23,42,.18)),
                        url('https://images.unsplash.com/photo-1526634332515-d56c9a5a4b6b?q=80&w=1600&auto=format&fit=crop')
                        center/cover no-repeat;">
                    </div>
                </div>
            </div>
            <div class="col-lg-7">
                <div class="badge-soft d-inline-flex mb-3">About KidsNest</div>
                <h2 class="display-6 fw-bold mb-3">
                    Building Strong Basics for Kids — One Worksheet at a Time
                </h2>
                <p class="text-muted mb-4">
                    KidsNest is designed for parents and teachers who want simple, clean,
                    and effective learning materials. Our goal is to help kids learn faster,
                    write better, and enjoy learning.
                </p>

                <div class="row g-2 mb-4">
                    <div class="col-md-6">
                        <div class="fw-semibold"><i class="bi bi-check-circle-fill text-success me-2"></i> Kid-safe content</div>
                        <div class="fw-semibold"><i class="bi bi-check-circle-fill text-success me-2"></i> Printable A4 format</div>
                        <div class="fw-semibold"><i class="bi bi-check-circle-fill text-success me-2"></i> Easy for teachers</div>
                    </div>
                    <div class="col-md-6">
                        <div class="fw-semibold"><i class="bi bi-check-circle-fill text-success me-2"></i> Works on mobile</div>
                        <div class="fw-semibold"><i class="bi bi-check-circle-fill text-success me-2"></i> Clean worksheet design</div>
                        <div class="fw-semibold"><i class="bi bi-check-circle-fill text-success me-2"></i> New uploads weekly</div>
                    </div>
                </div>

                <a href="#footer" class="btn btn-primary btn-pill">
                    Contact Us <i class="bi bi-envelope ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</section>

<!-- TESTIMONIALS -->
<section class="py-5" style="background:var(--k-soft);">
    <div class="container py-2">
        <div class="text-center mx-auto mb-5" style="max-width:820px;">
            <div class="badge-soft d-inline-flex mb-3">Testimonials</div>
            <h2 class="display-6 fw-bold">Parents & Teachers Love KidsNest</h2>
        </div>

        <div id="testiCarousel" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">

                <div class="carousel-item active">
                    <div class="quote-card mx-auto" style="max-width:920px;">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="https://i.pravatar.cc/120?img=12" class="rounded-circle border p-1" style="width:80px;height:80px;">
                            <div>
                                <h5 class="mb-0 fw-bold">Neha Sharma</h5>
                                <div class="text-muted small">Parent (UKG)</div>
                                <div class="text-warning">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                            <div class="ms-auto text-primary fs-2"><i class="bi bi-quote"></i></div>
                        </div>
                        <hr>
                        <p class="text-muted mb-0">
                            The worksheets are clean and very easy for my child. Printing quality is perfect and the games are fun too.
                        </p>
                    </div>
                </div>

                <div class="carousel-item">
                    <div class="quote-card mx-auto" style="max-width:920px;">
                        <div class="d-flex gap-3 align-items-center">
                            <img src="https://i.pravatar.cc/120?img=33" class="rounded-circle border p-1" style="width:80px;height:80px;">
                            <div>
                                <h5 class="mb-0 fw-bold">Rohit Verma</h5>
                                <div class="text-muted small">Teacher (Class 1)</div>
                                <div class="text-warning">
                                    <i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i><i class="bi bi-star-fill"></i>
                                </div>
                            </div>
                            <div class="ms-auto text-primary fs-2"><i class="bi bi-quote"></i></div>
                        </div>
                        <hr>
                        <p class="text-muted mb-0">
                            Great collection for kids. Saves a lot of time for teachers. The content is modern and easy to use.
                        </p>
                    </div>
                </div>

            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#testiCarousel" data-bs-slide="prev">
                <span class="carousel-control-prev-icon"></span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#testiCarousel" data-bs-slide="next">
                <span class="carousel-control-next-icon"></span>
            </button>
        </div>
    </div>
</section>

@endsection
