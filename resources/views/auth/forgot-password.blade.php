@extends('layouts.guest')
@section('title', 'Reset Access')

@section('content')
<section class="auth-section d-flex align-items-center py-5" style="min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-5 col-xl-4">

                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        
                        <div class="text-center mb-4">
                            <h4 class="fw-bold text-dark">Reset Password</h4>
                            <p class="text-muted small">We'll send a reset link to your email.</p>
                        </div>

                        {{-- Session Status (Success Alert) --}}
                        @if (session('status'))
                            <div class="alert alert-success small mb-4" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif

                        <form method="POST" action="{{ route('password.email') }}">
                            @csrf
                            <div class="mb-4">
                                <label class="form-label fw-semibold">Registered Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-envelope-at text-primary"></i></span>
                                    <input type="email" name="email" class="form-control border-start-0 @error('email') is-invalid @enderror" 
                                           placeholder="name@example.com" value="{{ old('email') }}" required autofocus>
                                </div>
                                @error('email') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-pill shadow-sm mb-3">
                                Send Reset Link
                            </button>
                        </form>

                        <hr class="text-muted opacity-25 my-4">
                        
                        <div class="text-center">
                            <a href="{{ route('login') }}" class="small text-decoration-none text-muted fw-semibold">
                                <i class="bi bi-chevron-left"></i> Return to Login
                            </a>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection