@extends('layouts.guest')

@section('title', 'Books - KidsNest')

@section('content')

<style>
  :root{
    --bg:#f6f8ff;
    --card:#ffffff;
    --text:#0f172a;
    --muted:#64748b;
    --primary:#2563eb;
    --primary2:#1d4ed8;
    --soft:#eef2ff;
    --border:#e2e8f0;
    --shadow: 0 12px 35px rgba(2, 6, 23, .08);
    --radius:18px;
  }

  *{ box-sizing:border-box; margin:0; padding:0; }
  body{
    font-family: "Nunito", sans-serif;
    background: radial-gradient(1200px 600px at 10% 0%, #e0e7ff 0%, rgba(224,231,255,0) 55%),
                radial-gradient(1200px 600px at 90% 0%, #dbeafe 0%, rgba(219,234,254,0) 55%),
                var(--bg);
    color:var(--text);
  }

  a{ text-decoration:none; color:inherit; }
  .container{ width:min(1200px, 92%); margin:auto; }

  .hero{ padding: 28px 0 14px; }
  .hero-grid{
    display:grid;
    grid-template-columns: 1.2fr .8fr;
    gap:20px;
    align-items:stretch;
  }
  .hero-card{
    background: rgba(255,255,255,.85);
    border:1px solid rgba(226,232,240,.9);
    border-radius: var(--radius);
    padding:22px;
    box-shadow: var(--shadow);
  }
  .hero h1{
    font-size:30px;
    line-height:1.15;
    margin-bottom:8px;
    font-weight:900;
  }
  .hero p{
    color:var(--muted);
    font-size:15px;
    line-height:1.55;
    margin-bottom:16px;
    font-weight:700;
  }

  .searchbar{
    display:flex;
    gap:10px;
    flex-wrap:wrap;
  }
  .input{
    flex:1;
    min-width:220px;
    padding:12px 14px;
    border-radius:14px;
    border:1px solid var(--border);
    outline:none;
    font-weight:700;
    background:#fff;
  }
  .select{
    padding:12px 14px;
    border-radius:14px;
    border:1px solid var(--border);
    outline:none;
    font-weight:800;
    background:#fff;
    min-width:160px;
  }

  .stats{ display:grid; gap:12px; height:100%; }
  .stat{
    background: rgba(255,255,255,.85);
    border:1px solid rgba(226,232,240,.9);
    border-radius: var(--radius);
    padding:16px;
    box-shadow: var(--shadow);
    display:flex;
    align-items:center;
    justify-content:space-between;
    gap:12px;
  }
  .stat h3{
    font-size:14px;
    color:var(--muted);
    font-weight:900;
    margin-bottom:6px;
  }
  .stat strong{
    font-size:22px;
    font-weight:900;
  }
  .pill{
    font-size:12px;
    font-weight:900;
    padding:7px 10px;
    border-radius:999px;
    background: #ecfeff;
    border:1px solid #a5f3fc;
    color:#0e7490;
    white-space:nowrap;
  }

  .section{ padding: 18px 0 45px; }
  .section-title{
    display:flex;
    align-items:flex-end;
    justify-content:space-between;
    gap:14px;
    margin-bottom:16px;
  }
  .section-title h2{ font-size:20px; font-weight:900; }
  .section-title span{ color:var(--muted); font-weight:800; font-size:14px; }

  .grid{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:16px;
  }

  .card{
    background: rgba(255,255,255,.92);
    border:1px solid rgba(226,232,240,.95);
    border-radius: 22px;
    overflow:hidden;
    box-shadow: var(--shadow);
    transition:.18s;
    display:flex;
    flex-direction:column;
    min-height: 370px;
  }
  .card:hover{ transform: translateY(-3px); }

  .thumb{
    position:relative;
    height: 170px;
    background: linear-gradient(135deg, #e0e7ff, #dbeafe);
  }
  .thumb img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
  }
  .badge{
    position:absolute;
    top:12px;
    left:12px;
    background: rgba(255,255,255,.92);
    border:1px solid rgba(226,232,240,.95);
    padding:7px 10px;
    border-radius:999px;
    font-size:12px;
    font-weight:900;
    color: var(--primary);
    text-transform: uppercase;
  }

  .card-body{
    padding:14px 14px 12px;
    display:flex;
    flex-direction:column;
    gap:10px;
    flex:1;
  }
  .card h3{
    font-size:16px;
    font-weight:900;
    line-height:1.25;
  }
  .meta{
    display:flex;
    flex-wrap:wrap;
    gap:8px;
    margin-top:-2px;
  }
  .chip{
    font-size:12px;
    font-weight:900;
    padding:6px 10px;
    border-radius:999px;
    background:#f1f5f9;
    color:#0f172a;
    border:1px solid #e2e8f0;
  }

  .desc{
    color:var(--muted);
    font-size:13px;
    line-height:1.5;
    font-weight:700;
  }

  .card-footer{
    padding: 12px 14px 14px;
    display:flex;
    gap:10px;
  }
  .btn-card{
    flex:1;
    padding:11px 12px;
    border-radius:14px;
    font-weight:900;
    font-size:14px;
    border:1px solid var(--border);
    background:#fff;
    cursor:pointer;
    transition:.18s;
    text-align:center;
    display:inline-block;
  }
  .btn-card:hover{ transform: translateY(-1px); }
  .btn-download{
    background: linear-gradient(135deg, var(--primary), var(--primary2));
    border:0;
    color:#fff;
  }

  .pagination-wrap{ display:flex; justify-content:center; margin-top:22px; }

  @media(max-width:1100px){ .grid{ grid-template-columns: repeat(3, 1fr); } }
  @media(max-width:850px){
    .hero-grid{ grid-template-columns: 1fr; }
    .grid{ grid-template-columns: repeat(2, 1fr); }
  }
  @media(max-width:520px){
    .grid{ grid-template-columns: 1fr; }
    .hero h1{ font-size:24px; }
  }
</style>

<section class="hero">
  <div class="container">
    <div class="hero-grid">

      <div class="hero-card">
        <h1>Kids Story Books & Learning PDFs 📖✨</h1>
        <p>
          Explore story books, learning packs, activity books and printable PDFs for kids.
        </p>

        <form method="GET" action="{{ route('books.index') }}">
          <div class="searchbar">

            <input class="input"
                   type="text"
                   name="q"
                   value="{{ request('q') }}"
                   placeholder="Search books (ex: Moral stories, Animals, ABC...)">

            <select class="select" name="category">
              <option value="">Category</option>
              @foreach($categories as $cat)
                <option value="{{ $cat->id }}" @selected(request('category') == $cat->id)>
                  {{ $cat->name }}
                </option>
              @endforeach
            </select>

            <select class="select" name="age">
              <option value="">Age</option>
              @foreach($ageGroups as $age)
                <option value="{{ $age->id }}" @selected(request('age') == $age->id)>
                  {{ $age->name }}
                </option>
              @endforeach
            </select>

            <select class="select" name="sort">
              <option value="newest" @selected(request('sort','newest') == 'newest')>Sort: Newest</option>
              <option value="popular" @selected(request('sort') == 'popular')>Sort: Popular</option>
            </select>

            <button class="btn btn-primary" type="submit">Search</button>

          </div>
        </form>
      </div>

      <div class="stats">
        <div class="stat">
          <div>
            <h3>Total Books</h3>
            <strong>{{ number_format($stats['total']) }}</strong>
          </div>
          <span class="pill">Story + Learning</span>
        </div>

        <div class="stat">
          <div>
            <h3>Free Books</h3>
            <strong>{{ number_format($stats['free']) }}</strong>
          </div>
          <span class="pill" style="background:#f0fdf4;border-color:#86efac;color:#166534;">Printable</span>
        </div>

        <div class="stat">
          <div>
            <h3>Premium Packs</h3>
            <strong>{{ number_format($stats['premium']) }}</strong>
          </div>
          <span class="pill" style="background:#fff7ed;border-color:#fdba74;color:#9a3412;">HD + Bundle</span>
        </div>
      </div>

    </div>
  </div>
</section>

<section class="section">
  <div class="container">

    <div class="section-title">
      <div>
        <h2>Latest Books</h2>
        <span>Showing {{ $contents->count() }} of {{ $contents->total() }} books</span>
      </div>

      <a href="{{ route('books.index') }}" class="btn btn-soft">Reset Filters</a>
    </div>

    <div class="grid">
      @forelse($contents as $content)

        <div class="card">
          <div class="thumb">
            <span class="badge">
              {{ $content->is_premium ? 'PREMIUM' : 'FREE' }}
            </span>

            <img
              src="{{ $content->thumbnail ? asset('storage/'.$content->thumbnail) : 'https://via.placeholder.com/1200x800?text=Book' }}"
              alt="{{ $content->title }}">
          </div>

          <div class="card-body">
            <h3>{{ $content->title }}</h3>

            <div class="meta">
              @if($content->category)
                <span class="chip">{{ $content->category->name }}</span>
              @endif

              @if($content->ageGroup)
                <span class="chip">{{ $content->ageGroup->name }}</span>
              @endif

              @if($content->difficulty)
                <span class="chip">{{ ucfirst($content->difficulty) }}</span>
              @endif
            </div>

            <p class="desc">
              {{ \Illuminate\Support\Str::limit($content->description, 110) }}
            </p>
          </div>

          <div class="card-footer">
            <a href="{{ route('content.show', $content->slug) }}" class="btn-card">
              Preview
            </a>

            <a href="{{ route('content.show', $content->slug) }}" class="btn-card btn-download">
              Download
            </a>
          </div>
        </div>

      @empty
        <div style="grid-column: 1 / -1; padding:20px;">
          <div class="hero-card">
            <h3 style="font-weight:900;font-size:18px;margin-bottom:6px;">No books found 😢</h3>
            <p style="color:var(--muted);font-weight:800;">
              Try removing filters or searching with another keyword.
            </p>
          </div>
        </div>
      @endforelse
    </div>

    <div class="pagination-wrap">
      {{ $contents->links() }}
    </div>

  </div>
</section>

@endsection
