@extends('layouts.guest')

@section('title', $content->title . ' - KidsNest')

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

  .page{
    padding: 28px 0 50px;
  }

  .top-grid{
    display:grid;
    grid-template-columns: 1.35fr .65fr;
    gap:18px;
    align-items:start;
  }

  .card{
    background: rgba(255,255,255,.92);
    border:1px solid rgba(226,232,240,.95);
    border-radius: 22px;
    box-shadow: var(--shadow);
    overflow:hidden;
  }

  .preview{
    height: 520px;
    background: linear-gradient(135deg, #e0e7ff, #dbeafe);
    display:grid;
    place-items:center;
    position:relative;
  }
  .preview img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
  }
  .badge{
    position:absolute;
    top:14px;
    left:14px;
    padding:8px 12px;
    border-radius:999px;
    font-weight:900;
    font-size:12px;
    background: rgba(255,255,255,.9);
    border:1px solid rgba(226,232,240,.95);
    color: var(--primary);
    text-transform:uppercase;
  }

  .content-body{
    padding: 18px;
  }

  .title{
    font-size:26px;
    font-weight:900;
    line-height:1.2;
    margin-bottom:10px;
  }
  .desc{
    color:var(--muted);
    font-weight:700;
    line-height:1.55;
    font-size:14px;
    margin-bottom:16px;
  }

  .meta{
    display:flex;
    flex-wrap:wrap;
    gap:8px;
    margin-bottom:14px;
  }
  .chip{
    font-size:12px;
    font-weight:900;
    padding:7px 11px;
    border-radius:999px;
    background:#f1f5f9;
    border:1px solid #e2e8f0;
  }

  .side{
    padding:18px;
  }

  .btn{
    display:block;
    width:100%;
    text-align:center;
    border:0;
    cursor:pointer;
    padding:12px 14px;
    border-radius:14px;
    font-weight:900;
    font-size:14px;
    transition:.2s;
  }
  .btn-primary{
    background: linear-gradient(135deg, var(--primary), var(--primary2));
    color:white;
    box-shadow: 0 14px 30px rgba(37,99,235,.25);
  }
  .btn-primary:hover{ transform: translateY(-1px); }

  .btn-soft{
    margin-top:10px;
    background: var(--soft);
    color: var(--primary);
    border:1px solid #dbeafe;
  }

  .info{
    margin-top:14px;
    border-top:1px solid rgba(226,232,240,.9);
    padding-top:14px;
    display:grid;
    gap:10px;
  }

  .row{
    display:flex;
    justify-content:space-between;
    gap:10px;
    font-weight:800;
    color:var(--muted);
    font-size:14px;
  }
  .row strong{ color:var(--text); }

  /* Suggestions */
  .section-title{
    margin:26px 0 14px;
    display:flex;
    justify-content:space-between;
    align-items:flex-end;
    gap:12px;
  }
  .section-title h2{
    font-size:18px;
    font-weight:900;
  }
  .grid{
    display:grid;
    grid-template-columns: repeat(4, 1fr);
    gap:14px;
  }
  .s-card{
    background: rgba(255,255,255,.92);
    border:1px solid rgba(226,232,240,.95);
    border-radius: 20px;
    overflow:hidden;
    box-shadow: var(--shadow);
    transition:.18s;
  }
  .s-card:hover{ transform: translateY(-3px); }
  .s-thumb{
    height:140px;
    background: linear-gradient(135deg, #e0e7ff, #dbeafe);
  }
  .s-thumb img{
    width:100%;
    height:100%;
    object-fit:cover;
    display:block;
  }
  .s-body{ padding:12px; }
  .s-body h3{
    font-size:14px;
    font-weight:900;
    line-height:1.3;
    margin-bottom:6px;
  }
  .s-body p{
    color:var(--muted);
    font-weight:800;
    font-size:12px;
  }

  @media(max-width:1000px){
    .top-grid{ grid-template-columns: 1fr; }
    .grid{ grid-template-columns: repeat(3, 1fr); }
  }
  @media(max-width:700px){
    .grid{ grid-template-columns: repeat(2, 1fr); }
    .preview{ height:380px; }
  }
  @media(max-width:520px){
    .grid{ grid-template-columns: 1fr; }
  }
</style>

<section class="page">
  <div class="container">

    <div class="top-grid">

      {{-- LEFT: Preview + details --}}
      <div class="card">
        <div class="preview">
          <span class="badge">{{ $content->is_premium ? 'PREMIUM' : 'FREE' }}</span>

          <img
            src="{{ $content->thumbnail ? asset('storage/'.$content->thumbnail) : 'https://via.placeholder.com/1200x800?text=Worksheet' }}"
            alt="{{ $content->title }}">
        </div>

        <div class="content-body">
          <h1 class="title">{{ $content->title }}</h1>

          <div class="meta">
            @if($content->category) <span class="chip">{{ $content->category->name }}</span> @endif
            @if($content->subCategory) <span class="chip">{{ $content->subCategory->name }}</span> @endif
            @if($content->difficulty) <span class="chip">{{ ucfirst($content->difficulty) }}</span> @endif
            @if($content->language) <span class="chip">{{ ucfirst($content->language) }}</span> @endif

            @foreach($content->ageGroups as $age)
              <span class="chip">{{ $age->name }}</span>
            @endforeach
          </div>

          <p class="desc">
            {{ $content->description ?? 'This worksheet is designed for kids learning in a fun and simple way.' }}
          </p>

          @if($content->tags->count())
            <div class="meta">
              @foreach($content->tags as $tag)
                <span class="chip">#{{ $tag->name }}</span>
              @endforeach
            </div>
          @endif
        </div>
      </div>

      {{-- RIGHT: Download box --}}
      <div class="card">
        <div class="side">

          @if($content->is_premium)
            <a href="{{ route('pricing') }}" class="btn btn-primary">
              Unlock Premium to Download
            </a>
            <a href="{{ route('login') }}" class="btn btn-soft">
              Already Premium? Login
            </a>
          @else
            <a href="{{ route('download.content', $content->id) }}" class="btn btn-primary">
              Download PDF
            </a>
            <a href="{{ route('worksheets.index') }}" class="btn btn-soft">
              Browse More Worksheets
            </a>
          @endif

          <div class="info">
            <div class="row">
              <span>Type</span>
              <strong>Worksheet</strong>
            </div>
            <div class="row">
              <span>Access</span>
              <strong>{{ $content->is_premium ? 'Premium' : 'Free' }}</strong>
            </div>
            <div class="row">
              <span>Downloads</span>
              <strong>{{ number_format($content->downloads ?? 0) }}</strong>
            </div>
            <div class="row">
              <span>Added</span>
              <strong>{{ $content->created_at->format('d M Y') }}</strong>
            </div>
          </div>

        </div>
      </div>

    </div>

    {{-- Suggestions --}}
    <div class="section-title">
      <h2>You may also like ✨</h2>
      <span style="color:var(--muted);font-weight:800;">More from same category</span>
    </div>

    <div class="grid">
      @forelse($suggestions as $item)
        <a class="s-card" href="{{ route('worksheets.show', $item->slug) }}">
          <div class="s-thumb">
            <img
              src="{{ $item->thumbnail ? asset('storage/'.$item->thumbnail) : 'https://via.placeholder.com/1200x800?text=Worksheet' }}"
              alt="{{ $item->title }}">
          </div>
          <div class="s-body">
            <h3>{{ \Illuminate\Support\Str::limit($item->title, 45) }}</h3>
            <p>{{ $item->is_premium ? 'Premium' : 'Free' }} • {{ $item->created_at->format('M Y') }}</p>
          </div>
        </a>
      @empty
        <div style="grid-column: 1 / -1;">
          <div class="card" style="padding:18px;">
            <strong>No suggestions yet.</strong>
          </div>
        </div>
      @endforelse
    </div>

  </div>
</section>

@endsection
