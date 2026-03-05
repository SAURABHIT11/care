@extends('layouts.admin')

@section('title', 'AI Prompt Generator')

@section('content')
<div class="container-fluid">
    <div class="card shadow border-0">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0 text-primary"><i class="bi bi-magic me-2"></i>Generate AI Image Metadata</h5>
        </div>
        <div class="card-body">
            <form action="{{ route('assets.generate') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="form-label fw-bold">What kind of image assets do you need?</label>
                    <textarea name="user_query" class="form-control form-control-lg" rows="3" 
                        placeholder="Ex: 3D isometric icons for a coffee shop app, pastel colors, high detail..." required></textarea>
                    <div class="form-text">Gemini will generate 3 creative variations for your review.</div>
                </div>
                <div class="row mb-4">
    <div class="col-md-6">
        <label class="form-label fw-bold">Resolution (Image Size)</label>
        <select name="resolution" class="form-select form-select-lg">
            <option value="1K" selected>1K (Standard)</option>
            <option value="2K">2K (High Def)</option>
        </select>
        <div class="form-text">Higher resolution may take longer to generate.</div>
    </div>
    <div class="col-md-6">
        <label class="form-label fw-bold">Aspect Ratio</label>
        <select name="aspect_ratio" class="form-select form-select-lg">
            <option value="1:1" selected>1:1 (Square)</option>
            <option value="16:9">16:9 (Widescreen)</option>
            <option value="9:16">9:16 (Portrait)</option>
            <option value="4:3">4:3 (Classic)</option>
        </select>
    </div>
</div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary btn-lg px-5">
                        <i class="bi bi-cpu me-2"></i> Consult Gemini AI
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection