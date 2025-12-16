@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6 ">
            <div class="card">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}" id="loginForm">
                        @csrf

                        <div class="row mb-3">
                            <label for="loginEmail" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>

                            <div class="col-md-6">
                                <input type="email"  id="loginEmail"  class="form-control @error('loginEmail') is-invalid @enderror"  value="{{ old('email') }}" required >

                                @error('loginEmail')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="loginPassword" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="loginPassword"  type="password" class="form-control @error('loginPassword') is-invalid @enderror" required >

                                @error('loginPassword')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-md-8 offset-md-4">
                                <div class="d-flex justify-content-between align-items-center flex-nowrap">
                                    <div class="form-check text-nowrap me-3">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link p-0 text-nowrap text-end" href="{{ route('password.request') }}" style="white-space: nowrap;">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="row mb-0">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Login') }}
                                </button>

                               
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const apiUrl = 'http://192.168.32.215:8041/api/v1';
    const loginForm = document.getElementById('loginForm');
    const loginBtn = loginForm.querySelector('button[type="submit"]');

    if (loginForm) {
        loginForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const email = document.getElementById('loginEmail').value;
            const password = document.getElementById('loginPassword').value;
            
            if (!email || !password) {
                alert('Please enter both email and password.');
                return;
            }
            
            // Disable submit button
            loginBtn.disabled = true;
            const originalText = loginBtn.textContent;
            loginBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Logging in...';
            
            try {
                const response = await axios.post(`${apiUrl}/login`, {
                    email: email,
                    password: password
                });
                
                console.log('=== LOGIN RESPONSE DEBUG ===');
                console.log('Full Response:', response);
                console.log('Response Data:', response.data);
                console.log('Response Message:', response.data.message);
                console.log('Response Data Object:', response.data.data);
                
                // Check if response is successful
                if (response.status === 200 || response.status === 201) {
                    const message = response.data.message || '';
                    const data = response.data.data || response.data;
                    
                    console.log('Message:', message);
                    console.log('Data:', data);
                    
                    // Store email for OTP verification
                    sessionStorage.setItem('otp_email', email);
                    
                    // Try to extract OTP from multiple possible locations
                    let otpCode = null;
                    
                    // 1. Check if OTP is directly in response.data
                    if (response.data.otp) {
                        otpCode = response.data.otp;
                        console.log('OTP found in response.data.otp:', otpCode);
                    }
                    // 2. Check if OTP is in data.otp
                    else if (data.otp) {
                        otpCode = data.otp;
                        console.log('OTP found in data.otp:', otpCode);
                    }
                    // 3. Check if OTP is in response.data.data.otp
                    else if (response.data.data && response.data.data.otp) {
                        otpCode = response.data.data.otp;
                        console.log('OTP found in response.data.data.otp:', otpCode);
                    }
                    // 4. Extract from message
                    else {
                        const otpMatch = message.match(/\b\d{6}\b/);
                        if (otpMatch) {
                            otpCode = otpMatch[0];
                            console.log('OTP extracted from message:', otpCode);
                        }
                    }
                    
                    if (otpCode) {
                        sessionStorage.setItem('otp_code', otpCode);
                        console.log('✓ OTP Code saved to sessionStorage:', otpCode);
                    } else {
                        console.error('✗ No OTP found in response. Check the console logs above.');
                        console.log('Entire response structure:', JSON.stringify(response.data, null, 2));
                    }
                    
                    // Always redirect to OTP verification for login
                    alert(message + '\nRedirecting to OTP verification...');
                    window.location.href = '{{ route("otp") }}';
                }
            } catch (error) {
                console.error('Login Error:', error);
                
                let errorMessage = 'Login failed. Please check your credentials.';
                if (error.response && error.response.data && error.response.data.message) {
                    errorMessage = error.response.data.message;
                }
                
                alert(errorMessage);
                
                // Re-enable submit button
                loginBtn.disabled = false;
                loginBtn.textContent = originalText;
            }
        });
    }
});
</script>
@endsection
