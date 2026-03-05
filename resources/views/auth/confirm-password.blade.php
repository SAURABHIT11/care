@extends('layouts.guest')
@section('title', 'Confirm Password')

@section('content')
<section class="auth-section d-flex align-items-center py-5" style="min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-5 col-xl-4">
                
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5">
                        
                        <div class="text-center mb-4">
                            <div class="bg-primary bg-opacity-10 text-primary d-inline-block p-3 rounded-circle mb-3">
                                <i class="bi bi-shield-lock fs-2"></i>
                            </div>
                            <h4 class="fw-bold">{{ __('Secure Area') }}</h4>
                            <p class="text-muted small">
                                {{ __('Please confirm your password before continuing.') }}
                            </p>
                        </div>

                        <form method="POST" action="{{ route('password.confirm') }}">
                            @csrf

                            <div class="mb-4">
                                <label for="password" class="form-label fw-semibold">{{ __('Password') }}</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-key text-primary"></i></span>
                                    <input id="password" type="password" name="password" 
                                           class="form-control border-start-0 @error('password') is-invalid @enderror" 
                                           required autocomplete="current-password" placeholder="Enter your password">
                                </div>
                                @error('password')
                                    <div class="text-danger small mt-1">{{ $message }}</div>
                                @enderror
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-pill shadow-sm">
                                {{ __('Confirm Password') }}
                            </button>
                        </form>
                    </div>
                </div>

                <div class="text-center mt-4">
                    <a href="{{ route('dashboard') }}" class="text-decoration-none small text-muted">
                        <i class="bi bi-arrow-left"></i> Back to Safety
                    </a>
                </div>

            </div>
        </div>
    </div>
</section>
@endsection