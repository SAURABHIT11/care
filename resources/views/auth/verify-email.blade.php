@extends('layouts.guest')
@section('title', 'Verify Email')

@section('content')
<section class="auth-section d-flex align-items-center py-5" style="min-height: 80vh;">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 col-md-7 col-lg-5">
                <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                    <div class="card-body p-4 p-md-5 text-center">
                        
                        <div class="bg-primary bg-opacity-10 text-primary d-inline-block p-4 rounded-circle mb-4">
                            <i class="bi bi-envelope-check fs-1"></i>
                        </div>
                        
                        <h4 class="fw-bold mb-3">Check your inbox</h4>
                        <p class="text-muted mb-4">
                            {{ __('Thanks for signing up! Please verify your email address by clicking on the link we just emailed to you. Didn\'t receive it?') }}
                        </p>

                        @if (session('status') == 'verification-link-sent')
                            <div class="alert alert-success small mb-4" role="alert">
                                {{ __('A new verification link has been sent to your email address.') }}
                            </div>
                        @endif

                        <div class="d-grid gap-2">
                            <form method="POST" action="{{ route('verification.send') }}">
                                @csrf
                                <button type="submit" class="btn btn-primary btn-pill w-100 shadow-sm">
                                    {{ __('Resend Verification Email') }}
                                </button>
                            </form>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-link text-muted small mt-2">
                                    {{ __('Log Out') }}
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection