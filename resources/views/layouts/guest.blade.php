<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>@yield('title', 'KidsNest - Worksheets, Coloring Pages & Learning Games')</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Fredoka:wght@500;600;700&family=Montserrat:wght@300;400;500;600&display=swap" rel="stylesheet">

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

    @stack('styles')

    <style>
        :root{
            --k-primary:#2563eb;
            --k-secondary:#ff6b35;
            --k-success:#22c55e;
            --k-soft:#f7f9ff;
            --k-dark:#0f172a;
        }

        body{
            font-family: "Montserrat", sans-serif;
            color: #0b1220;
        }

        h1,h2,h3,h4,h5,.brand-title{
            font-family: "Fredoka", sans-serif;
            letter-spacing: .2px;
        }

        /* Spinner */
        #spinner{
            position: fixed;
            inset: 0;
            background: #fff;
            z-index: 9999;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        /* Navbar */
        .navbar{
            backdrop-filter: blur(10px);
        }

        .nav-link{
            font-weight: 600;
            color: #0f172a;
        }
        .nav-link.active {
    color: #2563eb !important; /* Your primary blue */
    font-weight: 700;
    border-bottom: 2px solid #2563eb;
}
        .nav-link:hover{
            color: var(--k-primary);
        }

        /* Buttons */
        .btn-pill{
            border-radius: 999px;
            padding: 12px 22px;
            font-weight: 700;
        }

        .btn-primary{
            background: var(--k-primary);
            border-color: var(--k-primary);
        }
        .btn-primary:hover{
            background: #1d4ed8;
            border-color: #1d4ed8;
        }

        .badge-soft{
            background: rgba(37,99,235,.12);
            color: var(--k-primary);
            border: 1px solid rgba(37,99,235,.15);
            font-weight: 700;
            border-radius: 999px;
            padding: 10px 14px;
        }

        /* Hero */
        .hero{
            background:
                radial-gradient(circle at 10% 20%, rgba(255,107,53,.18), transparent 45%),
                radial-gradient(circle at 90% 10%, rgba(37,99,235,.18), transparent 45%),
                linear-gradient(180deg, #ffffff, var(--k-soft));
            padding: 90px 0 40px;
        }

        .hero-card{
            border-radius: 28px;
            border: 1px solid rgba(15,23,42,.08);
            box-shadow: 0 22px 60px rgba(15,23,42,.08);
            overflow: hidden;
            background: #fff;
        }

     
    .hero-img {
        min-height: 420px;
        background:
            linear-gradient(rgba(15,23,42,.08), rgba(15,23,42,.08)),
            /* Use the asset helper here */
            url("{{ asset('/image/1.jpeg') }}")
            center/cover no-repeat;
    }


        /* Feature cards */
        .feature-card{
            border-radius: 22px;
            border: 1px solid rgba(15,23,42,.08);
            background: #fff;
            transition: .2s ease;
            height: 100%;
        }
        .feature-card:hover{
            transform: translateY(-4px);
            box-shadow: 0 18px 50px rgba(15,23,42,.08);
        }

        .icon-bubble{
            width: 58px;
            height: 58px;
            border-radius: 18px;
            display: grid;
            place-items: center;
            background: rgba(37,99,235,.12);
            color: var(--k-primary);
            font-size: 26px;
        }

        /* Categories */
        .cat-card{
            border-radius: 26px;
            border: 1px solid rgba(15,23,42,.08);
            overflow: hidden;
            transition: .2s ease;
            height: 100%;
            background: #fff;
        }
        .cat-card:hover{
            transform: translateY(-4px);
            box-shadow: 0 18px 55px rgba(15,23,42,.08);
        }
        .cat-img img{
            height: 220px;
            object-fit: cover;
        }

        /* Stats */
        .stats{
            background: var(--k-dark);
            color: #fff;
            border-radius: 28px;
            padding: 34px;
        }

        /* Testimonials */
        .quote-card{
            border-radius: 26px;
            border: 1px solid rgba(15,23,42,.08);
            background: #fff;
            padding: 26px;
        }

        /* Footer */
        .footer{
            background: #0b1220;
            color: rgba(255,255,255,.85);
        }
        .footer a{
            color: rgba(255,255,255,.85);
            text-decoration: none;
        }
        .footer a:hover{
            color: #fff;
        }

        /* Back to top */
  .kids-spinner {
    position: fixed;
    width: 100%;
    height: 100%;
    background: white;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.bounce-container {
    display: flex;
    gap: 15px;
}

.dot {
    width: 25px;
    height: 25px;
    border-radius: 50%;
    animation: kids-bounce 0.6s infinite alternate;
}

.color-1 { background: #FF6B35; animation-delay: 0.1s; }
.color-2 { background: #FFD166; animation-delay: 0.2s; }
.color-3 { background: #06D6A0; animation-delay: 0.3s; }

@keyframes kids-bounce {
    from { transform: translateY(0); }
    to { transform: translateY(-30px); }
}

.loading-text {
    margin-top: 20px;
    font-weight: bold;
    color: #2563EB;
    font-family: 'Comic Sans MS', cursive, sans-serif; /* Friendly font */
}
        .rocket-btn {
    position: fixed;
    bottom: 30px;
    right: 30px;
    width: 60px;
    height: 60px;
    background: #FF6B35; /* Orange/Red like fire */
    color: white;
    border: none;
    border-radius: 50%;
    font-size: 24px;
    box-shadow: 0 4px 15px rgba(255,107,53, 0.4);
    cursor: pointer;
    transition: all 0.3s ease;
    z-index: 1000;
}

.rocket-btn:hover {
    transform: scale(1.1) rotate(-15deg);
    background: #2563EB; /* Changes color when active */
    animation: shake 0.5s infinite;
}

@keyframes shake {
    0% { transform: translate(1px, 1px) rotate(0deg); }
    10% { transform: translate(-1px, -2px) rotate(-1deg); }
    20% { transform: translate(-3px, 0px) rotate(1deg); }
    30% { transform: translate(3px, 2px) rotate(0deg); }
    40% { transform: translate(1px, -1px) rotate(1deg); }
}
    </style>
</head>

<body>



    @include('guest.spinner')

    @include('guest.topbar')

    @include('guest.navbar')

    @include('guest.search-modal')

    <main>
        @yield('content')
    </main>

    @include('guest.footer')

    @include('guest.back-to-top')

 

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

   <script>
    // Spinner with smooth fade-out
    window.addEventListener("load", () => {
        const sp = document.getElementById("spinner");
        sp.style.transition = "opacity 0.5s ease";
        sp.style.opacity = "0";
        setTimeout(() => sp.style.display = "none", 500);
    });

    // Back to top Rocket
    const btn = document.getElementById("backToTop");
    window.addEventListener("scroll", () => {
        // Show button with a pop effect
        if (window.scrollY > 350) {
            btn.style.display = "block";
            btn.classList.add("animate__animated", "animate__backInUp");
        } else {
            btn.style.display = "none";
        }
    });

    btn.addEventListener("click", () => {
        window.scrollTo({ top: 0, behavior: "smooth" });
    });

    // ScrollSpy Logic (Kept your logic as it's solid)
    const sections = document.querySelectorAll("section[id]");
    const navLinks = document.querySelectorAll(".navbar-nav .nav-link");

    window.addEventListener("scroll", () => {
        let current = "";
        sections.forEach((section) => {
            const sectionTop = section.offsetTop;
            if (pageYOffset >= sectionTop - 120) {
                current = section.getAttribute("id");
            }
        });

        navLinks.forEach((link) => {
            link.classList.remove("active");
            if (link.getAttribute("href").includes(current) && current !== "") {
                link.classList.add("active");
            }
        });
    });
</script>

    @stack('scripts')

</body>
</html>
