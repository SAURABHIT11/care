<!DOCTYPE html>
<html lang="en">

    <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TinyBloom – Kids & Pregnancy Care</title>

    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Google Fonts -->
    <link
        href="https://fonts.googleapis.com/css2?family=Fraunces:ital,opsz,wght@0,9..144,300;0,9..144,700;0,9..144,900;1,9..144,400&family=DM+Sans:wght@300;400;500;600&display=swap"
        rel="stylesheet" />
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" />

    <style>
        :root {
            --cream: #fdf6ec;
            --blush: #f8c8c0;
            --sage: #8dbd99;
            --sage-dk: #5a9469;
            --peach: #f5a87b;
            --sky: #a8d8ea;
            --sky-dk: #5badcf;
            --plum: #3d2b56;
            --ink: #1e1a2e;
            --lemon: #f9e784;
            --card-r: 20px;
        }

        *,
        *::before,
        *::after {
            box-sizing: border-box;
        }

        html {
            scroll-behavior: smooth;
        }

        body {
            font-family: 'DM Sans', sans-serif;
            background: var(--cream);
            color: var(--ink);
            overflow-x: hidden;
        }

        h1,
        h2,
        h3,
        .display-font {
            font-family: 'Fraunces', serif;
        }

        /* ─── NOISE TEXTURE OVERLAY ─── */
        body::before {
            content: '';
            position: fixed;
            inset: 0;
            background-image: url("data:image/svg+xml,%3Csvg viewBox='0 0 256 256' xmlns='http://www.w3.org/2000/svg'%3E%3Cfilter id='noise'%3E%3CfeTurbulence type='fractalNoise' baseFrequency='0.9' numOctaves='4' stitchTiles='stitch'/%3E%3C/filter%3E%3Crect width='100%25' height='100%25' filter='url(%23noise)' opacity='0.03'/%3E%3C/svg%3E");
            pointer-events: none;
            z-index: 1000;
            opacity: .4;
        }

        /* ─── NAVBAR ─── */
        .navbar {
            background: rgba(253, 246, 236, .92);
            backdrop-filter: blur(14px);
            border-bottom: 2px solid var(--blush);
            padding: 1rem 0;
        }

        .navbar-brand {
            font-family: 'Fraunces', serif;
            font-size: 1.7rem;
            font-weight: 900;
            color: var(--plum) !important;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .brand-dot {
            width: 12px;
            height: 12px;
            border-radius: 50%;
            background: var(--peach);
            display: inline-block;
            animation: bop 2s ease-in-out infinite;
        }

        @keyframes bop {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-5px)
            }
        }

        .nav-link {
            font-weight: 500;
            color: var(--plum) !important;
            position: relative;
            transition: color .2s;
        }

        .nav-link::after {
            content: '';
            position: absolute;
            left: 0;
            bottom: -3px;
            width: 0;
            height: 2px;
            background: var(--peach);
            transition: width .3s;
        }

        .nav-link:hover::after,
        .nav-link.active::after {
            width: 100%;
        }

        .btn-nav {
            background: var(--plum);
            color: #fff !important;
            border-radius: 50px;
            padding: .45rem 1.4rem;
            font-weight: 600;
            border: none;
            transition: background .2s, transform .2s;
        }

        .btn-nav:hover {
            background: var(--sage-dk);
            transform: translateY(-2px);
        }

        /* ─── HERO ─── */
        .hero {
            min-height: 100vh;
            background: linear-gradient(135deg, #fdf0e4 0%, #fce8f3 50%, #e5f5fd 100%);
            display: flex;
            align-items: center;
            position: relative;
            overflow: hidden;
            padding-top: 90px;
        }

        .hero-blob {
            position: absolute;
            border-radius: 50%;
            filter: blur(60px);
            opacity: .5;
            pointer-events: none;
            animation: drift 8s ease-in-out infinite alternate;
        }

        @keyframes drift {
            from {
                transform: translate(0, 0) scale(1)
            }

            to {
                transform: translate(30px, 20px) scale(1.05)
            }
        }

        .blob1 {
            width: 500px;
            height: 500px;
            background: var(--blush);
            top: -120px;
            left: -150px;
        }

        .blob2 {
            width: 400px;
            height: 400px;
            background: var(--sky);
            bottom: -80px;
            right: -80px;
            animation-delay: 3s;
        }

        .blob3 {
            width: 300px;
            height: 300px;
            background: var(--lemon);
            top: 40%;
            left: 45%;
            animation-delay: 1.5s;
        }

        .hero-title {
            font-size: clamp(3rem, 7vw, 6rem);
            font-weight: 900;
            line-height: 1.05;
            color: var(--plum);
        }

        .hero-title span {
            color: var(--peach);
            font-style: italic;
        }

        .hero-sub {
            font-size: 1.15rem;
            color: #6b5e7e;
            max-width: 500px;
            line-height: 1.7;
            margin-top: 1rem;
        }

        .hero-badges {
            display: flex;
            flex-wrap: wrap;
            gap: .6rem;
            margin-top: 1.5rem;
        }

        .badge-pill {
            background: #fff;
            border: 2px solid var(--blush);
            border-radius: 50px;
            padding: .4rem 1rem;
            font-size: .85rem;
            font-weight: 600;
            color: var(--plum);
            display: flex;
            align-items: center;
            gap: .4rem;
        }

        .btn-hero {
            background: var(--plum);
            color: #fff;
            border-radius: 50px;
            padding: .8rem 2.2rem;
            font-size: 1.05rem;
            font-weight: 700;
            border: none;
            box-shadow: 0 8px 30px rgba(61, 43, 86, .25);
            transition: transform .25s, box-shadow .25s;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .5rem;
        }

        .btn-hero:hover {
            transform: translateY(-4px);
            box-shadow: 0 14px 40px rgba(61, 43, 86, .35);
            color: #fff;
        }

        .btn-hero-outline {
            background: transparent;
            color: var(--plum);
            border: 2.5px solid var(--plum);
            border-radius: 50px;
            padding: .75rem 2rem;
            font-size: 1.05rem;
            font-weight: 700;
            text-decoration: none;
            transition: background .25s, color .25s;
        }

        .btn-hero-outline:hover {
            background: var(--plum);
            color: #fff;
        }

        .hero-img-wrap {
            position: relative;
            z-index: 2;
        }

        .hero-img-card {
            background: #fff;
            border-radius: 36px;
            box-shadow: 0 30px 80px rgba(61, 43, 86, .18);
            overflow: hidden;
            aspect-ratio: 4/5;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .hero-img-card svg {
            width: 100%;
            height: 100%;
        }

        .float-card {
            position: absolute;
            background: #fff;
            border-radius: 16px;
            padding: .8rem 1.1rem;
            box-shadow: 0 10px 40px rgba(0, 0, 0, .12);
            display: flex;
            align-items: center;
            gap: .6rem;
            font-size: .85rem;
            font-weight: 600;
            color: var(--plum);
            animation: floatY 4s ease-in-out infinite;
        }

        @keyframes floatY {

            0%,
            100% {
                transform: translateY(0)
            }

            50% {
                transform: translateY(-8px)
            }
        }

        .float-card.card-a {
            top: 8%;
            left: -12%;
            animation-delay: 0s;
        }

        .float-card.card-b {
            bottom: 12%;
            right: -10%;
            animation-delay: 2s;
        }

        .float-icon {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
        }

        /* ─── SECTION COMMON ─── */
        section {
            padding: 5rem 0;
        }

        .section-tag {
            display: inline-flex;
            align-items: center;
            gap: .5rem;
            background: var(--blush);
            color: var(--plum);
            border-radius: 50px;
            padding: .3rem 1rem;
            font-size: .82rem;
            font-weight: 700;
            letter-spacing: .06em;
            text-transform: uppercase;
            margin-bottom: 1rem;
        }

        .section-title {
            font-size: clamp(2rem, 4vw, 3rem);
            font-weight: 900;
            color: var(--plum);
            line-height: 1.15;
        }

        .section-title span {
            color: var(--peach);
            font-style: italic;
        }

        /* ─── CATEGORIES ─── */
        .cat-section {
            background: var(--plum);
        }

        .cat-card {
            border-radius: var(--card-r);
            padding: 2rem 1.5rem;
            text-align: center;
            transition: transform .3s, box-shadow .3s;
            cursor: pointer;
            height: 100%;
        }

        .cat-card:hover {
            transform: translateY(-8px);
            box-shadow: 0 20px 60px rgba(0, 0, 0, .25);
        }

        .cat-icon {
            width: 72px;
            height: 72px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 2rem;
            margin: 0 auto 1.2rem;
        }

        .cat-title {
            font-family: 'Fraunces', serif;
            font-size: 1.2rem;
            font-weight: 700;
            margin-bottom: .5rem;
        }

        .cat-desc {
            font-size: .88rem;
            opacity: .85;
        }

        .cat-1 {
            background: #f8c8c0;
            color: var(--plum);
        }

        .cat-2 {
            background: #a8d8ea;
            color: var(--plum);
        }

        .cat-3 {
            background: #c8e6c9;
            color: var(--plum);
        }

        .cat-4 {
            background: #f9e784;
            color: var(--plum);
        }

        .cat-5 {
            background: #e1bee7;
            color: var(--plum);
        }

        .cat-6 {
            background: #ffccbc;
            color: var(--plum);
        }

        .cat-icon-1 {
            background: rgba(255, 255, 255, .5);
        }

        /* ─── BLOG CARDS ─── */
        .blog-card {
            background: #fff;
            border-radius: var(--card-r);
            overflow: hidden;
            height: 100%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .07);
            transition: transform .3s, box-shadow .3s;
        }

        .blog-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 50px rgba(0, 0, 0, .13);
        }

        .blog-thumb {
            height: 200px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 4rem;
        }

        .blog-body {
            padding: 1.4rem;
        }

        .blog-tag {
            display: inline-block;
            border-radius: 50px;
            padding: .2rem .8rem;
            font-size: .75rem;
            font-weight: 700;
            text-transform: uppercase;
            letter-spacing: .05em;
            margin-bottom: .7rem;
        }

        .blog-title {
            font-family: 'Fraunces', serif;
            font-size: 1.15rem;
            font-weight: 700;
            color: var(--plum);
            margin-bottom: .5rem;
            line-height: 1.3;
        }

        .blog-excerpt {
            font-size: .88rem;
            color: #666;
            line-height: 1.65;
        }

        .blog-meta {
            font-size: .8rem;
            color: #999;
            margin-top: 1rem;
            display: flex;
            align-items: center;
            gap: .5rem;
        }

        .read-more {
            color: var(--sage-dk);
            font-weight: 700;
            font-size: .88rem;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            margin-top: .8rem;
        }

        .read-more:hover {
            color: var(--plum);
        }

        /* ─── RECIPE SECTION ─── */
        .recipe-section {
            background: linear-gradient(135deg, #e8f5e9, #fff9c4);
        }

        .recipe-card {
            background: #fff;
            border-radius: var(--card-r);
            padding: 1.5rem;
            height: 100%;
            box-shadow: 0 4px 20px rgba(0, 0, 0, .07);
            transition: transform .3s, box-shadow .3s;
        }

        .recipe-card:hover {
            transform: translateY(-6px);
            box-shadow: 0 16px 50px rgba(0, 0, 0, .12);
        }

        .recipe-emoji {
            font-size: 3.5rem;
            line-height: 1;
            margin-bottom: 1rem;
        }

        .recipe-title {
            font-family: 'Fraunces', serif;
            font-size: 1.1rem;
            font-weight: 700;
            color: var(--plum);
        }

        .recipe-info {
            display: flex;
            gap: 1rem;
            margin-top: .8rem;
        }

        .rinfo {
            font-size: .8rem;
            color: #888;
            display: flex;
            align-items: center;
            gap: .25rem;
        }

        .nutrition-badge {
            display: inline-flex;
            align-items: center;
            gap: .3rem;
            background: var(--sage);
            color: #fff;
            border-radius: 50px;
            padding: .25rem .8rem;
            font-size: .75rem;
            font-weight: 700;
            margin-top: .8rem;
        }

        /* ─── TIPS SECTION ─── */
        .tips-section {
            background: #fff;
        }

        .tip-item {
            display: flex;
            gap: 1.2rem;
            padding: 1.5rem;
            background: #fdf6ec;
            border-radius: 16px;
            border-left: 5px solid var(--peach);
            transition: transform .25s;
        }

        .tip-item:hover {
            transform: translateX(6px);
        }

        .tip-num {
            width: 44px;
            height: 44px;
            border-radius: 50%;
            background: var(--plum);
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Fraunces', serif;
            font-size: 1.1rem;
            font-weight: 900;
            flex-shrink: 0;
        }

        .tip-text h5 {
            font-family: 'Fraunces', serif;
            color: var(--plum);
            margin-bottom: .3rem;
        }

        .tip-text p {
            font-size: .88rem;
            color: #666;
            margin: 0;
        }

        /* ─── PREGNANCY TIMELINE ─── */
        .pregnancy-section {
            background: linear-gradient(160deg, var(--plum) 0%, #5a3d7a 100%);
        }

        .trimester-card {
            background: rgba(255, 255, 255, .1);
            border: 2px solid rgba(255, 255, 255, .2);
            border-radius: 24px;
            padding: 2rem;
            backdrop-filter: blur(10px);
            transition: background .3s, transform .3s;
        }

        .trimester-card:hover {
            background: rgba(255, 255, 255, .18);
            transform: translateY(-4px);
        }

        .trimester-num {
            font-size: 3rem;
            font-weight: 900;
            color: var(--lemon);
            font-family: 'Fraunces', serif;
            line-height: 1;
        }

        .trimester-label {
            color: rgba(255, 255, 255, .7);
            font-size: .85rem;
            font-weight: 600;
            text-transform: uppercase;
            letter-spacing: .08em;
        }

        .trimester-title {
            color: #fff;
            font-family: 'Fraunces', serif;
            font-size: 1.3rem;
            font-weight: 700;
            margin: 1rem 0 .7rem;
        }

        .trimester-list {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .trimester-list li {
            color: rgba(255, 255, 255, .85);
            font-size: .88rem;
            padding: .35rem 0;
            display: flex;
            gap: .5rem;
        }

        .trimester-list li::before {
            content: '✦';
            color: var(--lemon);
            flex-shrink: 0;
        }

        /* ─── NEWSLETTER ─── */
        .newsletter-section {
            background: var(--cream);
        }

        .newsletter-box {
            background: linear-gradient(135deg, var(--peach), var(--blush));
            border-radius: 32px;
            padding: 4rem 3rem;
            text-align: center;
            position: relative;
            overflow: hidden;
        }

        .newsletter-box::before {
            content: '✿';
            font-size: 8rem;
            position: absolute;
            top: -20px;
            left: -20px;
            opacity: .1;
            color: var(--plum);
        }

        .newsletter-box::after {
            content: '✿';
            font-size: 8rem;
            position: absolute;
            bottom: -20px;
            right: -20px;
            opacity: .1;
            color: var(--plum);
        }

        .newsletter-title {
            font-family: 'Fraunces', serif;
            font-size: 2.2rem;
            font-weight: 900;
            color: var(--plum);
        }

        .newsletter-sub {
            color: rgba(61, 43, 86, .75);
            margin: .5rem 0 2rem;
            font-size: 1rem;
        }

        .newsletter-form {
            display: flex;
            gap: .75rem;
            max-width: 480px;
            margin: 0 auto;
            flex-wrap: wrap;
            justify-content: center;
        }

        .newsletter-input {
            flex: 1;
            min-width: 220px;
            padding: .8rem 1.3rem;
            border: 2.5px solid rgba(61, 43, 86, .2);
            border-radius: 50px;
            background: #fff;
            font-size: .95rem;
            font-family: 'DM Sans', sans-serif;
            outline: none;
            transition: border-color .2s;
        }

        .newsletter-input:focus {
            border-color: var(--plum);
        }

        .btn-subscribe {
            background: var(--plum);
            color: #fff;
            border: none;
            border-radius: 50px;
            padding: .8rem 1.8rem;
            font-weight: 700;
            font-size: .95rem;
            cursor: pointer;
            transition: background .2s, transform .2s;
        }

        .btn-subscribe:hover {
            background: #2a1d3a;
            transform: translateY(-2px);
        }

        /* ─── FOOTER ─── */
        footer {
            background: var(--plum);
            color: rgba(255, 255, 255, .8);
        }

        .footer-brand {
            font-family: 'Fraunces', serif;
            font-size: 1.8rem;
            font-weight: 900;
            color: #fff;
        }

        .footer-tagline {
            font-size: .88rem;
            opacity: .65;
            margin-top: .3rem;
        }

        .footer-heading {
            font-family: 'Fraunces', serif;
            color: #fff;
            font-size: 1rem;
            margin-bottom: 1rem;
        }

        .footer-links {
            list-style: none;
            padding: 0;
        }

        .footer-links li {
            margin-bottom: .5rem;
        }

        .footer-links a {
            color: rgba(255, 255, 255, .65);
            text-decoration: none;
            font-size: .88rem;
            transition: color .2s;
        }

        .footer-links a:hover {
            color: var(--peach);
        }

        .social-btn {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background: rgba(255, 255, 255, .12);
            border: none;
            display: flex;
            align-items: center;
            justify-content: center;
            color: #fff;
            font-size: 1rem;
            cursor: pointer;
            transition: background .2s, transform .2s;
            text-decoration: none;
        }

        .social-btn:hover {
            background: var(--peach);
            transform: translateY(-3px);
            color: var(--plum);
        }

        .footer-divider {
            border-color: rgba(255, 255, 255, .12);
        }

        .footer-bottom {
            font-size: .82rem;
            opacity: .55;
        }

        /* ─── ANIMATIONS ─── */
        .fade-up {
            opacity: 0;
            transform: translateY(30px);
            animation: fadeUp .7s ease forwards;
        }

        @keyframes fadeUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .delay-1 {
            animation-delay: .1s;
        }

        .delay-2 {
            animation-delay: .2s;
        }

        .delay-3 {
            animation-delay: .3s;
        }

        .delay-4 {
            animation-delay: .4s;
        }

        .delay-5 {
            animation-delay: .5s;
        }

        /* ─── SCROLL ANIMATION ─── */
        .scroll-reveal {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity .7s ease, transform .7s ease;
        }

        .scroll-reveal.visible {
            opacity: 1;
            transform: translateY(0);
        }

        /* ─── WAVE DIVIDER ─── */
        .wave-top svg,
        .wave-bottom svg {
            display: block;
        }

        /* ─── MOBILE ─── */
        @media(max-width:768px) {
            .hero {
                padding-top: 80px;
                padding-bottom: 3rem;
            }

            .hero-title {
                font-size: 2.8rem;
            }

            .hero-img-wrap {
                margin-top: 2rem;
            }

            .float-card.card-a {
                top: 2%;
                left: 0;
            }

            .float-card.card-b {
                bottom: 2%;
                right: 0;
            }

            .newsletter-box {
                padding: 2.5rem 1.5rem;
            }
        }
    </style>
</head>

<body>
    @include('partials.navbar')

    @yield('content')

    @include('partials.footer')


    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    @stack('scripts')


</body>

</html>