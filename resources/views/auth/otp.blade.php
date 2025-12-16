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
                        @if(session('otp_email'))
                            <p class="text-primary small fw-medium mt-1">{{ session('otp_email') }}</p>
                        @endif
                        @if(session('otp_code'))
                            <div class="alert alert-info mt-2">
                                <strong>Your OTP Code (for testing):</strong> {{ session('otp_code') }}
                            </div>
                        @endif
                        <p class="text-primary small fw-medium mt-1" id="displayEmail"></p>
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
                    <form id="otpForm">
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
                            <input type="hidden" id="emailInput" name="email">
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
                        <br>
                        <button type="button" class="btn btn-link text-decoration-none p-0 mt-2 text-warning" id="backToLoginBtn">
                            <i class="bi bi-arrow-left me-1"></i> Back to Login (Get Fresh OTP)
                        </button>
                    </div>

                    <!-- Back Link -->
                    <div class="text-center mt-4">
                        <a href="{{ route('register') }}" class="text-muted small text-decoration-none">
                            <i class="bi bi-arrow-left me-1"></i> Back to Registration
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const otpInputs = document.querySelectorAll('.otp-input');
    const otpCodeInput = document.getElementById('otpCode');
    const emailInput = document.getElementById('emailInput');
    const verifyBtn = document.getElementById('verifyBtn');
    const resendBtn = document.getElementById('resendBtn');
    const resendText = document.getElementById('resendText');
    const resendTimer = document.getElementById('resendTimer');
    const countdown = document.getElementById('countdown');
    
    // Get email from sessionStorage and set it in the hidden field
    const email = sessionStorage.getItem('otp_email');
    if (email) {
        emailInput.value = email;
        // Display the email on the page
        const displayEmail = document.getElementById('displayEmail');
        if (displayEmail) {
            displayEmail.textContent = email;
        }
    } else {
        console.error('No email found in sessionStorage');
        alert('Session expired. Please register again.');
    }
    
    // Display OTP code from sessionStorage if available (for testing)
    const otpCode = sessionStorage.getItem('otp_code');
    if (otpCode) {
        console.log('OTP Code from API:', otpCode);
        
        // Create and display alert with OTP
        const otpAlert = document.createElement('div');
        otpAlert.className = 'alert alert-info mt-2';
        otpAlert.innerHTML = `<strong>Your OTP Code (from API):</strong> ${otpCode}`;
        
        // Insert after the email display
        const headerSection = document.querySelector('.text-center.mb-4');
        if (headerSection) {
            headerSection.appendChild(otpAlert);
        }
    }
    
    let timeLeft = 60;
    let timerInterval;

    // OTP Input handling
    otpInputs.forEach((input, index) => {
        input.addEventListener('input', function(e) {
            const value = e.target.value;
            
            // Only allow numbers
            if (!/^\d*$/.test(value)) {
                e.target.value = '';
                return;
            }

            if (value.length === 1 && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }

            updateOtpCode();
        });

        input.addEventListener('keydown', function(e) {
            if (e.key === 'Backspace' && !e.target.value && index > 0) {
                otpInputs[index - 1].focus();
            }
        });

        input.addEventListener('paste', function(e) {
            e.preventDefault();
            const pastedData = e.clipboardData.getData('text').replace(/\D/g, '');
            
            for (let i = 0; i < pastedData.length && index + i < otpInputs.length; i++) {
                otpInputs[index + i].value = pastedData[i];
            }
            
            updateOtpCode();
            
            const lastFilledIndex = Math.min(index + pastedData.length, otpInputs.length - 1);
            otpInputs[lastFilledIndex].focus();
        });
    });

    function updateOtpCode() {
        const code = Array.from(otpInputs).map(input => input.value).join('');
        otpCodeInput.value = code;
        verifyBtn.disabled = code.length !== 6;
    }

    // Form submission - verify OTP via API
    const otpForm = document.getElementById('otpForm');
    if (otpForm) {
        otpForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const code = otpCodeInput.value;
            const email = emailInput.value;
            
            if (!email) {
                alert('Session expired. Please register again.');
                return;
            }
            
            // Disable button and show loading
            verifyBtn.disabled = true;
            document.getElementById('btnText').textContent = 'Verifying...';
            document.getElementById('btnSpinner').classList.remove('d-none');
            
            try {
                const apiUrl = 'http://192.168.32.215:8041/api/v1';
                
                // Try both field names - 'code' and 'otp'
                const requestData = {
                    code: code,
                    otp: code,
                    email: email
                };
                
                console.log('Sending OTP verification request:', requestData);
                
                const response = await axios.post(`${apiUrl}/validate_code`, requestData);
                
                console.log('OTP Verification Response:', response.data);
                
                // Check if verification was successful
                if (response.status === 200 || response.status === 201) {
                    // Store user and token if provided
                    if (response.data.user) {
                        localStorage.setItem('user', JSON.stringify(response.data.user));
                    }
                    if (response.data.token) {
                        localStorage.setItem('token', response.data.token);
                    }
                    
                    console.log('✓✓✓ OTP VERIFICATION SUCCESSFUL! ✓✓✓');
                    console.log('User:', response.data.user);
                    console.log('Token:', response.data.token);
                    
                    // Now log the user into Laravel's session
                    console.log('Logging user into Laravel session...');
                    
                    // Create a form and submit it to Laravel's session login endpoint
                    const form = document.createElement('form');
                    form.method = 'POST';
                    form.action = '{{ route("otp.session.login") }}';
                    
                    // Add CSRF token
                    const csrfInput = document.createElement('input');
                    csrfInput.type = 'hidden';
                    csrfInput.name = '_token';
                    csrfInput.value = '{{ csrf_token() }}';
                    form.appendChild(csrfInput);
                    
                    // Add email
                    const emailInput = document.createElement('input');
                    emailInput.type = 'hidden';
                    emailInput.name = 'email';
                    emailInput.value = email;
                    form.appendChild(emailInput);
                    
                    // Add form to body and submit
                    document.body.appendChild(form);
                    
                    // Clear sessionStorage before redirect
                    sessionStorage.removeItem('otp_email');
                    sessionStorage.removeItem('otp_code');
                    
                    form.submit();
                } else {
                    throw new Error('Verification failed');
                }
            } catch (error) {
                console.error('OTP Verification Error:', error);
                console.error('Error Response:', error.response);
                console.error('Error Data:', error.response?.data);
                
                let errorMessage = 'Invalid OTP code. Please try again.';
                if (error.response && error.response.data) {
                    if (error.response.data.message) {
                        errorMessage = error.response.data.message;
                    } else if (error.response.data.error) {
                        errorMessage = error.response.data.error;
                    }
                    console.log('API Error Message:', errorMessage);
                }
                
                alert(errorMessage);
                
                // Clear OTP inputs
                otpInputs.forEach(input => {
                    input.value = '';
                    input.classList.remove('filled');
                });
                otpCodeInput.value = '';
                verifyBtn.disabled = true;
                otpInputs[0].focus();
            } finally {
                // Re-enable button
                document.getElementById('btnText').textContent = 'Verify Code';
                document.getElementById('btnSpinner').classList.add('d-none');
            }
        });
    }

    // Resend OTP
    resendBtn.addEventListener('click', async function() {
        if (resendBtn.disabled) return;
        
        resendBtn.disabled = true;
        resendText.classList.add('d-none');
        resendTimer.classList.remove('d-none');
        
        // Get email from sessionStorage
        const email = sessionStorage.getItem('otp_email');
        
        if (!email) {
            showAlert('danger', 'Session expired. Please login again.');
            return;
        }
        
        try {
            const apiUrl = 'http://192.168.32.215:8041/api/v1';
            
            // Try resend_otp endpoint first
            let response;
            try {
                response = await axios.post(`${apiUrl}/resend_otp`, {
                    email: email
                });
            } catch (e) {
                // If resend_otp doesn't exist, try resend-otp
                try {
                    response = await axios.post(`${apiUrl}/resend-otp`, {
                        email: email
                    });
                } catch (e2) {
                    // If neither works, inform user to login again
                    throw new Error('Please login again to receive a new OTP');
                }
            }
            
            const message = response.data.message || '';
            
            // Extract new OTP code from message
            const otpMatch = message.match(/\b\d{6}\b/);
            if (otpMatch) {
                sessionStorage.setItem('otp_code', otpMatch[0]);
                console.log('New OTP Code:', otpMatch[0]);
                
                // Update the displayed OTP if element exists
                const otpAlert = document.querySelector('.alert-info');
                if (otpAlert) {
                    otpAlert.innerHTML = `<strong>Your OTP Code (from API):</strong> ${otpMatch[0]}`;
                }
                
                showAlert('success', 'New OTP sent successfully! Code: ' + otpMatch[0]);
            } else {
                showAlert('info', message || 'OTP sent. Please check your email.');
            }
        } catch (error) {
            console.error('Error:', error);
            const errorMsg = error.message || 'Failed to resend OTP. Please login again.';
            showAlert('danger', errorMsg);
        }
        
        // Start countdown
        timeLeft = 60;
        countdown.textContent = timeLeft;
        
        timerInterval = setInterval(() => {
            timeLeft--;
            countdown.textContent = timeLeft;
            
            if (timeLeft <= 0) {
                clearInterval(timerInterval);
                resendBtn.disabled = false;
                resendText.classList.remove('d-none');
                resendTimer.classList.add('d-none');
            }
        }, 1000);
    });

    function showAlert(type, message) {
        const alertDiv = document.createElement('div');
        alertDiv.className = `alert alert-${type} alert-dismissible fade show`;
        alertDiv.innerHTML = `
            <i class="bi bi-${type === 'success' ? 'check-circle' : 'exclamation-circle'} me-2"></i>${message}
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        `;
        
        const form = document.getElementById('otpForm');
        form.parentNode.insertBefore(alertDiv, form);
        
        setTimeout(() => alertDiv.remove(), 5000);
    }

    // Back to login button
    const backToLoginBtn = document.getElementById('backToLoginBtn');
    if (backToLoginBtn) {
        backToLoginBtn.addEventListener('click', function() {
            // Clear sessionStorage
            sessionStorage.removeItem('otp_email');
            sessionStorage.removeItem('otp_code');
            
            // Redirect to login
            window.location.href = '{{ route("login") }}';
        });
    }

    // Focus first input on load
    otpInputs[0].focus();
});
</script>
@endsection