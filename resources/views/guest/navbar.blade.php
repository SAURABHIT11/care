<nav class="navbar navbar-expand-xl bg-white sticky-top border-bottom">
    <div class="container py-2">
        <a class="navbar-brand fw-bold" href="{{ url('/') }}">
            <span class="brand-title text-primary fs-3">Kids</span><span class="brand-title text-warning fs-3">Nest</span>
            <div class="small text-muted fw-semibold" style="margin-top:-4px;">Worksheets • Coloring • Games</div>
        </a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarCollapse">
            <ul class="navbar-nav mx-auto gap-xl-2">
              <li class="nav-item">
    <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="{{ url('/') }}">Home</a>
</li>
                <li class="nav-item"><a class="nav-link" href="#categories">Categories</a></li>
                <li class="nav-item"><a class="nav-link" href="#worksheets">Worksheets</a></li>
                <li class="nav-item"><a class="nav-link" href="#games">Games</a></li>
                <li class="nav-item"><a class="nav-link" href="#about">About</a></li>
                <li class="nav-item"><a class="nav-link" href="#footer">Contact</a></li>
            </ul>

            <div class="d-flex align-items-center gap-2">
                <button class="btn btn-outline-primary rounded-circle" style="width:44px;height:44px;"
                        data-bs-toggle="modal" data-bs-target="#searchModal">
                    <i class="bi bi-search"></i>
                </button>

                <a href="#worksheets" class="btn btn-primary btn-pill d-none d-lg-inline-flex">
                    Download Free
                    <i class="bi bi-download ms-2"></i>
                </a>
            </div>
        </div>
    </div>
</nav>
