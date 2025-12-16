@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center align-items-center min-vh-100">
        <div class="col-md-5 col-lg-4">
            <div class="card shadow-lg border-0">
                <div class="card-body p-5">
                    <!-- Header Section -->
                    <div class="text-center mb-4">
                        <div class="mb-3">
                            <i class="bi bi-shield-lock text-primary" style="font-size: 3rem;"></i>
                        </div>
                        <h3 class="fw-bold mb-2">Verify Your Code</h3>
                        <p class="text-muted small mb-0">
                            We've sent a 6-digit verification code to your email address
                        </p>
                        @if(session('email'))
                            <p class="text-primary small fw-medium mt-1">{{ session('email') }}</p>
                        @endif
                    </div>

                    <!-- Alert Messages -->
                    @if (session('status'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="bi bi-check-circle me-2"></i>{{ session('status') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @if (session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>{{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @endif

                    @error('otp')
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="bi bi-exclamation-circle me-2"></i>{{ $message }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        </div>
                    @enderror

                    <!-- OTP Form -->
                    <form id="otpForm" method="POST" action="{{ route('password.otp') }}">
                        @csrf
                        
                        <div class="mb-4">
                            <div class="otp-container">
                                <input type="text" class="otp-input" maxlength="1" data-index="0" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                <input type="text" class="otp-input" maxlength="1" data-index="1" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                <input type="text" class="otp-input" maxlength="1" data-index="2" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                <input type="text" class="otp-input" maxlength="1" data-index="3" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                <input type="text" class="otp-input" maxlength="1" data-index="4" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                                <input type="text" class="otp-input" maxlength="1" data-index="5" autocomplete="off" inputmode="numeric" pattern="[0-9]*">
                            </div>
                            <input type="hidden" id="otpCode" name="otp">
                        </div>

                        <button class="btn btn-primary w-100 mb-3 py-2 fw-medium" type="submit" id="verifyBtn" disabled>
                            <span id="btnText">Verify Code</span>
                            <span id="btnSpinner" class="spinner-border spinner-border-sm d-none ms-2"></span>
                        </button>
                    </form>

                    <!-- Resend Section -->
                    <div class="text-center">
                        <p class="text-muted small mb-2">Didn't receive the code?</p>
                        <button type="button" class="btn btn-link text-decoration-none p-0" id="resendBtn">
                            <span id="resendText">Resend Code</span>
                            <span id="resendTimer" class="d-none">Resend in <span id="countdown">60</span>s</span>
                        </button>
                    </div>

                    <!-- Back Link -->
                    <div class="text-center mt-4">
                        <a href="{{ route('password.request') }}" class="text-muted small text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i> Back to Password Reset
                        </a>
                    </div>
                </div>
            </div>

            <!-- Security Notice -->
            <div class="text-center mt-3">
                <p class="text-muted small">
                    <i class="bi bi-info-circle me-1"></i>
                    For your security, this code will expire in 10 minutes
                </p>
            </div>
        </div>
    </div>
</div>
@endsection