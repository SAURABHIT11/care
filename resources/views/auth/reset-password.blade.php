@extends('layouts.guest')
@section('title', 'Password Setup')

@section('content')
<section class="auth-section d-flex align-items-center py-5" style="min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-6 col-lg-4">
                <div class="card border-0 shadow-lg rounded-4">
                    <div class="card-body p-4 p-md-5">
                        <div class="mb-4 text-center">
                            <h5 class="fw-bold text-dark mb-1">Set New Password</h5>
                            <p class="text-muted small">Enter your new secure credentials below.</p>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">
                            
                            <div class="mb-3">
                                <label class="form-label fw-semibold small">Account Email</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-person-fill text-primary"></i></span>
                                    <input type="email" name="email" class="form-control border-start-0" value="{{ $email ?? old('email') }}" readonly>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label class="form-label fw-semibold small">New Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-lock-fill text-primary"></i></span>
                                    <input type="password" name="password" class="form-control border-start-0 @error('password') is-invalid @enderror" placeholder="New password" required autofocus>
                                </div>
                                @error('password') <div class="text-danger small mt-1">{{ $message }}</div> @enderror
                            </div>

                            <div class="mb-4">
                                <label class="form-label fw-semibold small">Confirm Password</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light border-end-0"><i class="bi bi-shield-check text-primary"></i></span>
                                    <input type="password" name="password_confirmation" class="form-control border-start-0" placeholder="Confirm password" required>
                                </div>
                            </div>

                            <button type="submit" class="btn btn-primary w-100 btn-pill shadow-sm">
                                Update Password
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection