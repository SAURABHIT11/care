@extends('layouts.guest')

@section('title', $coloring->name . ' - KidsNest')

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
        --radius:22px;
    }

    body{
        font-family: "Nunito", sans-serif;
        background: radial-gradient(1200px 600px at 10% 0%, #e0e7ff 0%, rgba(224,231,255,0) 55%),
        radial-gradient(1200px 600px at 90% 0%, #dbeafe 0%, rgba(219,234,254,0) 55%),
        var(--bg);
        color:var(--text);
    }

    a{ text-decoration:none; color:inherit; }
    .container{ width:min(1250px, 92%); margin:auto; }

    .page{ padding: 22px 0 50px; }

    .bread{
        margin-bottom:14px;
        color:var(--muted);
        font-weight:800;
        font-size:14px;
        display:flex;
        flex-wrap:wrap;
        gap:6px;
        align-items:center;
    }
    .bread a{ color:var(--primary); font-weight:900; }
    .bread span{ opacity:.7; }

    .hero{
        display:flex;
        flex-direction:column;
        gap:8px;
        margin-bottom:18px;
    }
    .hero h1{
        font-size:26px;
        font-weight:1000;
        line-height:1.15;
    }
    .hero p{
        color:var(--muted);
        font-weight:800;
        line-height:1.6;
        max-width: 900px;
    }

    .grid{
        display:grid;
        grid-template-columns: 1.2fr .8fr;
        gap:16px;
        align-items:start;
    }

    .card{
        background: rgba(255,255,255,.92);
        border:1px solid rgba(226,232,240,.95);
        border-radius: var(--radius);
        box-shadow: var(--shadow);
        overflow:hidden;
    }

    .canvas-wrap{
        position:relative;
        padding:14px;
        min-height: 520px;
        display:flex;
        justify-content:center;
        align-items:center;
        background: linear-gradient(135deg, #e0e7ff, #dbeafe);
    }

    #zoomWrapper{
        transform-origin:center center;
        transition:transform .25s;
        width:100%;
        display:flex;
        justify-content:center;
        align-items:center;
    }

    #injectedWrapper canvas{
        display:block;
        max-width: 100%;
        height:auto;
        border-radius: 18px;
        box-shadow: 0 12px 30px rgba(2, 6, 23, .12);
        background:white;
    }

    .loading-overlay{
        position:absolute;
        inset:0;
        background: rgba(255, 255, 255, 0.75);
        display:none;
        justify-content:center;
        align-items:center;
        font-size:18px;
        font-weight:1000;
        z-index:100;
        backdrop-filter: blur(3px);
    }

    .zoom-controls{
        position:absolute;
        top:12px;
        right:12px;
        display:flex;
        flex-direction:column;
        gap:10px;
        z-index:10;
    }
    .zbtn{
        width:46px;
        height:46px;
        border-radius: 14px;
        border:1px solid rgba(226,232,240,.9);
        background: rgba(255,255,255,.95);
        box-shadow: 0 10px 25px rgba(2,6,23,.12);
        cursor:pointer;
        font-size:18px;
        font-weight:1000;
        transition:.15s;
        display:grid;
        place-items:center;
    }
    .zbtn:hover{ transform: translateY(-1px); }

    /* Sidebar */
    .side{
        padding:16px;
    }

    .side h2{
        font-size:16px;
        font-weight:1000;
        margin-bottom:8px;
    }

    .chip-row{
        display:flex;
        flex-wrap:wrap;
        gap:8px;
        margin-bottom:14px;
    }
    .chip{
        font-size:12px;
        font-weight:1000;
        padding:7px 11px;
        border-radius:999px;
        background:#f1f5f9;
        border:1px solid #e2e8f0;
    }

    .current-color{
        display:flex;
        align-items:center;
        gap:12px;
        margin: 10px 0 14px;
    }
    .color-dot{
        width:46px;
        height:46px;
        border-radius: 50%;
        border:5px solid #fff;
        outline: 3px solid #e2e8f0;
        box-shadow: 0 12px 25px rgba(2,6,23,.12);
    }
    .current-color strong{
        font-weight:1000;
    }
    .current-color span{
        color:var(--muted);
        font-weight:900;
        font-size:13px;
        display:block;
    }

    .color-grid{
        display:grid;
        grid-template-columns: repeat(7, 1fr);
        gap:10px;
        margin-bottom: 14px;
    }
    .color-option{
        width:100%;
        aspect-ratio: 1/1;
        border-radius: 999px;
        cursor:pointer;
        border:3px solid rgba(226,232,240,.95);
        transition:.12s;
        box-shadow: 0 8px 18px rgba(2,6,23,.08);
    }
    .color-option.active{
        outline: 3px solid rgba(15,23,42,.9);
        border-color: rgba(255,255,255,.95);
        transform: scale(1.06);
    }

    .btn{
        display:block;
        width:100%;
        text-align:center;
        border:0;
        cursor:pointer;
        padding:12px 14px;
        border-radius:16px;
        font-weight:1000;
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

    .mini-row{
        margin-top:14px;
        border-top:1px solid rgba(226,232,240,.9);
        padding-top:14px;
        display:grid;
        gap:10px;
    }
    .mini{
        display:flex;
        justify-content:space-between;
        gap:12px;
        font-weight:900;
        color:var(--muted);
        font-size:14px;
    }
    .mini strong{ color:var(--text); }

    /* Share buttons */
    .share-row{
        display:flex;
        gap:10px;
        flex-wrap:wrap;
        margin-top:12px;
    }
    .share-btn{
        flex:1;
        min-width: 55px;
        height:48px;
        border-radius: 16px;
        display:flex;
        align-items:center;
        justify-content:center;
        color:white;
        font-weight:1000;
        border:0;
        cursor:pointer;
        transition:.15s;
    }
    .share-btn:hover{ transform: translateY(-1px); }
    .share-btn.whatsapp{ background:#25D366; }
    .share-btn.facebook{ background:#1877F2; }
    .share-btn.pinterest{ background:#E60023; }
    .share-btn.telegram{ background:#0088cc; }
    .share-btn.link{ background:#334155; }

    /* Bottom action bar */
    .bottom-card{
        margin-top:16px;
        padding:16px;
    }
    .bottom-grid{
        display:grid;
        grid-template-columns: 1fr 1fr;
        gap:14px;
        align-items:center;
    }
    .name-input{
        width:100%;
        padding:12px 14px;
        border-radius: 16px;
        border:1px solid rgba(226,232,240,.95);
        font-weight:900;
        outline:none;
        background:white;
    }

    @media(max-width:1050px){
        .grid{ grid-template-columns: 1fr; }
        .canvas-wrap{ min-height: 440px; }
        .bottom-grid{ grid-template-columns: 1fr; }
    }
</style>


<section class="page">
    <div class="container">

        {{-- Breadcrumb --}}
        <div class="bread">
            <a href="{{ route('home') }}">Home</a>
            <span>›</span>
            <a href="{{ route('coloring.index') }}">Coloring Pages</a>
            <span>›</span>
            <span>{{ $coloring->name }}</span>
        </div>

        {{-- Title --}}
        <div class="hero">
            <h1>{{ $coloring->name }}</h1>
            <p>{{ $coloring->description }}</p>
        </div>

        {{-- Main --}}
        <div class="grid">

            {{-- LEFT: Canvas --}}
            <div class="card">
                <div class="canvas-wrap">

                    <div class="zoom-controls">
                        <button class="zbtn" onclick="zoomIn()" title="Zoom In">➕</button>
                        <button class="zbtn" onclick="zoomOut()" title="Zoom Out">➖</button>
                        <button class="zbtn" onclick="resetZoom()" title="Reset Zoom">🔄</button>
                        <button class="zbtn" onclick="undoColor()" title="Undo">↩</button>
                    </div>

                    <div id="zoomWrapper">
                        <div id="injectedWrapper"></div>
                    </div>

                    <div class="loading-overlay" id="loadingOverlay">
                        Processing...
                    </div>

                </div>
            </div>

            {{-- RIGHT: Colors + actions --}}
            <div class="card">
                <div class="side">

                    <h2>🎨 Choose Color</h2>

                    <div class="chip-row">
                        <span class="chip">Tap inside area to fill</span>
                        <span class="chip">Undo supported</span>
                        <span class="chip">Download as PDF</span>
                    </div>

                    <div class="current-color">
                        <div class="color-dot" id="selectedColor"></div>
                        <div>
                            <strong>Current Color</strong>
                            <span>Click any color below</span>
                        </div>
                    </div>

                    <div class="color-grid">
                        @php
                        $colors = [
                            '#FFFFFF', '#C0C0C0', '#808080', '#000000', '#FF0000', '#800000',
                            '#FFFF00', '#808000', '#00FF00', '#008000', '#00FFFF', '#008080',
                            '#0000FF', '#000080', '#FF00FF', '#800080', '#FFE0BD', '#C68642',
                            '#FF1493', '#FF5F1F', '#E91E63', '#DC143C', '#FFD700', '#FFB347',
                            '#F4A460', '#76FF03', '#ADFF2F', '#00FA9A', '#40E0D0', '#1E90FF',
                            '#87CEFA', '#4169E1', '#BA55D3', '#FF69B4', '#FFDAB9', '#FA8072',
                            '#D2691E', '#A0522D', '#A020F0', '#B0E0E6', '#D8BFD8', '#708090',
                        ];
                        @endphp

                        @foreach($colors as $c)
                            <div class="color-option" style="background:{{ $c }}" data-color="{{ $c }}"></div>
                        @endforeach
                    </div>

                    <button class="btn btn-primary" onclick="generatePDF()">
                        ⬇ Download PDF
                    </button>

                    <button class="btn btn-soft" id="shareArtwork">
                        🎉 Share My Artwork
                    </button>

                    <div class="mini-row">
                        <div class="mini">
                            <span>Type</span>
                            <strong>Online Coloring</strong>
                        </div>
                        <div class="mini">
                            <span>Format</span>
                            <strong>PNG / JPG</strong>
                        </div>
                        <div class="mini">
                            <span>Added</span>
                            <strong>{{ $coloring->created_at->format('d M Y') }}</strong>
                        </div>
                    </div>

                    <div style="margin-top:14px;">
                        <div style="font-weight:1000;margin-bottom:8px;">Share this page:</div>

                        <div class="share-row">
                            <a class="share-btn whatsapp" href="https://wa.me/?text={{ urlencode(url()->current()) }}" target="_blank" title="WhatsApp">
                                WA
                            </a>
                            <a class="share-btn facebook" href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank" title="Facebook">
                                FB
                            </a>
                            <a class="share-btn pinterest" href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}&media={{ asset('storage/' . $coloring->image) }}&description={{ urlencode($coloring->name) }}" target="_blank" title="Pinterest">
                                P
                            </a>
                            <a class="share-btn telegram" href="https://t.me/share/url?url={{ urlencode(url()->current()) }}&text={{ urlencode($coloring->name) }}" target="_blank" title="Telegram">
                                TG
                            </a>
                            <button class="share-btn link" onclick="copyLink()" title="Copy Link">
                                🔗
                            </button>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        {{-- Bottom Card --}}
        <div class="card bottom-card">
            <div class="bottom-grid">
                <div>
                    <div style="font-weight:1000;margin-bottom:8px;">Your Name (Watermark)</div>
                    <input type="text" id="name" class="name-input" value="KidsNest.in" required>
                </div>
                <div>
                    <button class="btn btn-primary" onclick="generatePDF()">
                        ✅ Finish & Download
                    </button>
                    <button class="btn btn-soft" onclick="resetZoom()" style="margin-top:10px;">
                        Reset Zoom
                    </button>
                </div>
            </div>
        </div>

        {{-- Adsense (optional) --}}
        <div style="margin-top:16px;" class="card">
            <div style="padding:16px; text-align:center;">
                <script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-9377656827901885"
                    crossorigin="anonymous"></script>
                <ins class="adsbygoogle"
                    style="display:block; text-align:center;"
                    data-ad-layout="in-article"
                    data-ad-format="fluid"
                    data-ad-client="ca-pub-9377656827901885"
                    data-ad-slot="1207206620"></ins>
                <script>
                    (adsbygoogle = window.adsbygoogle || []).push({});
                </script>
            </div>
        </div>

        {{-- Suggestions --}}
        <div style="margin-top:18px;">
           
        </div>

    </div>
</section>


{{-- Hidden canvas for PDF --}}
<canvas id="exportCanvas" style="display:none;"></canvas>

<form id="pdfForm" method="POST" action="#">
    @csrf
    <input type="hidden" name="image" id="imageInput">
    <input type="hidden" name="name" id="nameInput">
</form>


<script>
    let selectedColor = "#000000";
    const undoStack = [];
    const clickSound = new Audio("{{ asset('img/click.wav') }}");

    let activeCanvas = null;
    let floodFillWorker = null;

    function setColor(c) {
        selectedColor = c;
        document.getElementById("selectedColor").style.background = c;
        document.querySelectorAll(".color-option").forEach(o =>
            o.classList.toggle("active", o.dataset.color === c)
        );
    }

    function undoColor() {
        if (undoStack.length && activeCanvas) {
            const last = undoStack.pop();
            const ctx = activeCanvas.getContext("2d");
            ctx.putImageData(last.imageData, 0, 0);
        }
    }

    // Zoom controls
    let zoom = 1;
    const zoomWrapper = document.getElementById("zoomWrapper");

    function zoomIn() {
        const maxZoom = 1.6;
        if (zoom < maxZoom) {
            zoom += 0.2;
            applyZoom();
        }
    }
    function zoomOut() {
        zoom = Math.max(0.5, zoom - 0.2);
        applyZoom();
    }
    function resetZoom() {
        zoom = 1;
        applyZoom();
    }
    function applyZoom() {
        zoomWrapper.style.transform = `scale(${zoom})`;
    }

    function hexToRgba(h) {
        h = h.replace(/^#/, "");
        if (h.length === 3) h = h.split("").map(c => c + c).join("");
        const i = parseInt(h, 16);
        return [ (i >> 16) & 255, (i >> 8) & 255, i & 255, 255 ];
    }

    // Load ONLY image (png/jpg/jpeg)
    function loadImageOnly() {
        @php
    $file = $coloring->files->first(); // eager load files in controller
    $fileUrl = $file ? asset('storage/'.$file->file_path) : null;
@endphp
        const fileUrl = "{{ $fileUrl }}";
        const ext = fileUrl.split('.').pop().toLowerCase();

        if (!["png","jpg","jpeg"].includes(ext)) {
            alert("This coloring page is not an image. Please upload PNG/JPG only for online coloring.");
            return;
        }

        const wrap = document.getElementById("injectedWrapper");
        wrap.innerHTML = "";

        const img = new Image();
        img.src = fileUrl;
        img.crossOrigin = "anonymous";

        img.onload = () => {
            const canvas = document.createElement("canvas");
            wrap.appendChild(canvas);

            activeCanvas = canvas;
            const ctx = canvas.getContext("2d");

            // internal canvas = real image resolution
            canvas.width = img.width;
            canvas.height = img.height;
            ctx.drawImage(img, 0, 0);

            // Responsive sizing
            const setCanvasSize = () => {
                const container = wrap.parentElement;
                const maxWidth = container.clientWidth - 20;
                const maxHeight = container.clientHeight - 20;

                const imageAspect = img.width / img.height;
                const containerAspect = maxWidth / maxHeight;

                let newWidth, newHeight;

                if (imageAspect > containerAspect) {
                    newWidth = maxWidth;
                    newHeight = maxWidth / imageAspect;
                } else {
                    newHeight = maxHeight;
                    newWidth = maxHeight * imageAspect;
                }

                canvas.style.width = newWidth + "px";
                canvas.style.height = newHeight + "px";
            };

            window.addEventListener("resize", setCanvasSize);
            setCanvasSize();

            // Click fill
            canvas.addEventListener("click", e => {
                const rect = canvas.getBoundingClientRect();
                const x = Math.floor((e.clientX - rect.left) * (canvas.width / rect.width));
                const y = Math.floor((e.clientY - rect.top) * (canvas.height / rect.height));

                const ctx = canvas.getContext("2d");

                // save for undo
                const before = ctx.getImageData(0, 0, canvas.width, canvas.height);
                undoStack.push({ imageData: before });

                const imageData = ctx.getImageData(0, 0, canvas.width, canvas.height);
                const fillColor = hexToRgba(selectedColor);

                document.getElementById("loadingOverlay").style.display = "flex";

                floodFillWorker.postMessage({
                    imageData: imageData,
                    x: x,
                    y: y,
                    fillColor: fillColor
                });
            });
        };

        img.onerror = () => {
            alert("Image failed to load. Please check file path.");
        };
    }

    async function generatePDF() {
        const name = document.getElementById("name").value.trim();
        if (!name) return alert("Enter name");

        if (!activeCanvas) {
            alert("Please color something first!");
            return;
        }

        const exportCanvas = document.getElementById("exportCanvas");
        const ctx = exportCanvas.getContext("2d");

        exportCanvas.width = activeCanvas.width;
        exportCanvas.height = activeCanvas.height;

        ctx.drawImage(activeCanvas, 0, 0);

        // Watermark
        drawWatermark(ctx, exportCanvas.width, exportCanvas.height, name);

        document.getElementById("imageInput").value = exportCanvas.toDataURL("image/png");
        document.getElementById("nameInput").value = name;
        document.getElementById("pdfForm").submit();
    }

    // Share Artwork
    document.getElementById('shareArtwork').addEventListener('click', async () => {
        if (!activeCanvas) {
            alert("Please color something first!");
            return;
        }

        const name = document.getElementById("name").value.trim() || "KidsNest.in";

        const canvas = document.createElement("canvas");
        const ctx = canvas.getContext("2d");

        canvas.width = activeCanvas.width;
        canvas.height = activeCanvas.height;

        ctx.drawImage(activeCanvas, 0, 0);
        drawWatermark(ctx, canvas.width, canvas.height, name);

        canvas.toBlob(async (blob) => {
            const file = new File([blob], "my-artwork.png", { type: "image/png" });

            if (navigator.canShare && navigator.canShare({ files: [file] })) {
                try {
                    await navigator.share({
                        title: "My Coloring Artwork 🎨",
                        text: "Check out what I just colored on KidsNest!",
                        files: [file]
                    });
                } catch (err) {
                    console.error("Sharing failed:", err);
                }
            } else {
                const link = document.createElement("a");
                link.href = canvas.toDataURL("image/png");
                link.download = "my-artwork.png";
                link.click();
                alert("Your device doesn’t support direct share. Artwork downloaded!");
            }
        }, "image/png");
    });

    function drawWatermark(ctx, width, height, text) {
        ctx.save();
        ctx.font = "30px Comic Sans MS";
        ctx.textAlign = "center";
        ctx.textBaseline = "bottom";

        const safeText = text || "KidsNest.in";
        const textWidth = ctx.measureText(safeText).width;

        ctx.fillStyle = "rgba(255,255,255,0.35)";
        ctx.fillRect((width - textWidth)/2 - 10, height - 48, textWidth + 20, 38);

        ctx.fillStyle = "rgba(0,0,0,0.85)";
        ctx.fillText(safeText, width / 2, height - 18);
        ctx.restore();
    }

    function copyLink() {
        navigator.clipboard.writeText("{{ url()->current() }}");
        alert("Link copied to clipboard! ✅");
    }

    // Init worker + init UI
    window.addEventListener("load", () => {

        setColor("#000000");

        document.querySelectorAll(".color-option").forEach(o =>
            o.addEventListener("click", () => setColor(o.dataset.color))
        );

        // Worker (fast fill)
        const workerCode = `
            self.onmessage = function(e) {
                const { imageData, x, y, fillColor } = e.data;
                const data = imageData.data;
                const width = imageData.width;
                const height = imageData.height;

                const startPos = (y * width + x) * 4;
                const startColor = [data[startPos], data[startPos + 1], data[startPos + 2], data[startPos + 3]];
                const stack = [[x, y]];
                const tol = 32;

                const match = (a, b) =>
                    Math.abs(a[0] - b[0]) < tol &&
                    Math.abs(a[1] - b[1]) < tol &&
                    Math.abs(a[2] - b[2]) < tol;

                const processed = new Uint8Array(width * height);

                while (stack.length) {
                    const [cx, cy] = stack.pop();
                    if (cx < 0 || cy < 0 || cx >= width || cy >= height) continue;

                    const pos = (cy * width + cx);
                    if (processed[pos]) continue;
                    processed[pos] = 1;

                    const dataPos = pos * 4;
                    const currentColor = [data[dataPos], data[dataPos + 1], data[dataPos + 2], data[dataPos + 3]];

                    if (match(currentColor, startColor)) {
                        data[dataPos] = fillColor[0];
                        data[dataPos + 1] = fillColor[1];
                        data[dataPos + 2] = fillColor[2];
                        data[dataPos + 3] = 255;

                        stack.push([cx + 1, cy], [cx - 1, cy], [cx, cy + 1], [cx, cy - 1]);
                    }
                }

                self.postMessage({ result: imageData }, [imageData.data.buffer]);
            };
        `;
        const workerBlob = new Blob([workerCode], { type: 'application/javascript' });
        const workerUrl = URL.createObjectURL(workerBlob);
        floodFillWorker = new Worker(workerUrl);

        floodFillWorker.onmessage = (e) => {
            const { result: imageData } = e.data;

            if (activeCanvas) {
                activeCanvas.getContext('2d').putImageData(imageData, 0, 0);
                document.getElementById('loadingOverlay').style.display = 'none';
                clickSound.play();
            }
        };

        loadImageOnly();
    });
</script>

@endsection
