@extends('layouts.app_new')

@section('content')

  {{-- HERO SECTION --}}
  @include('sections.hero')

  {{-- CATEGORIES --}}
  @include('sections.categories')

  {{-- BLOG --}}
  @include('sections.blog')

  {{--recipes --}}
  @include('sections.recipes')

  {{-- tips --}}
  @include('sections.tips')

  {{-- pregnancy --}}
  @include('sections.pregnancy')

  {{-- stats --}}
  @include('sections.stats')

  <!-- ══════════ NEWSLETTER ══════════ -->
  <section id="newsletter" class="newsletter-section">
    <div class="container">
      <div class="newsletter-box scroll-reveal">
        <div class="section-tag" style="background:rgba(61,43,86,.12);color:var(--plum);">
          <i class="bi bi-envelope-heart-fill"></i> Stay Connected
        </div>
        <div class="newsletter-title mt-2">Get Weekly Parenting Tips<br>Delivered to Your Inbox 💌</div>
        <div class="newsletter-sub">Join 50,000+ parents who trust TinyBloom for expert guidance, seasonal recipes, and
          milestone reminders.</div>
        <div class="newsletter-form">
          <input type="email" class="newsletter-input" placeholder="Your email address..." />
          <button class="btn-subscribe">Subscribe Free</button>
        </div>
        <p style="font-size:.78rem;color:rgba(61,43,86,.55);margin-top:1rem;">No spam, ever. Unsubscribe anytime. 💛</p>
      </div>
    </div>
  </section>

@endsection


@push('scripts')

  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    // ── Scroll Reveal ──
    const observer = new IntersectionObserver((entries) => {
      entries.forEach((entry, i) => {
        if (entry.isIntersecting) {
          entry.target.classList.add('visible');
          observer.unobserve(entry.target);
        }
      });
    }, { threshold: 0.12 });

    document.querySelectorAll('.scroll-reveal').forEach(el => observer.observe(el));

    // ── Staggered delay for grid children ──
    document.querySelectorAll('.row .scroll-reveal').forEach((el, i) => {
      if (!el.style.transitionDelay) {
        el.style.transitionDelay = (i % 4) * 0.1 + 's';
      }
    });
  </script>
@endpush