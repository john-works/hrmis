@extends('layouts.public')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header "> 
                  
                    <h5 class="mb-0">{{ __('Register') }}</h5>
                </div>

                <div class="card-body">
                    <form method="POST" id="registerForm" action="{{ route('register') }}">
                        @csrf

                        <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input type="text" class="form-control" id="first_name" name="first_name" required />
                                    </div>

                                    <div class="col-md-6 mb-3">
                                        <label for="middle_name" class="form-label">Middle Name</label>
                                        <input type="text" class="form-control" id="middle_name" name="middle_name" />
                                     </div>
    
                        </div>

                        <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="last_name" class="form-label">Last Name</label>
                                        <input type="text" class="form-control" id="last_name" name="last_name" required />
                                    </div>


                                    <div class="col-md-6 mb-3">
                                        <label for="gender" class="form-label">Gender</label>
                                        <select class="form-control" id="gender" name="gender" required>
                                            <option value="">Select Gender</option>
                                            <option value="male">Male</option>
                                            <option value="female">Female</option>
                                        </select>
                                    </div>
                                
                        </div>

                        <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" class="form-control" id="email" name="email" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="phone_number" class="form-label">Contact</label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number" required />
                                    </div>
                         </div>


                         <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="dob" class="form-label">Date of Birth</label>
                                        <input type="date" class="form-control" id="dob" name="dob" required />
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <label for="marital_status" class="form-label">Marital Status</label>
                                        <select class="form-control" id="marital_status" name="marital_status" required>
                                            <option value="">Select Status</option>
                                            <option value="single">Single</option>
                                            <option value="married">Married</option>
                                            <option value="divorced">Divorced</option>
                                            <option value="widowed">Widowed</option>
                                        </select>
                                    </div>
                        </div>

                        <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label for="nin" class="form-label">National ID</label>
                                        <input type="text" class="form-control" id="nin" name="nin" maxlength="15" required />
                                    </div>
                                    
                        </div>

                        <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" required autocomplete="new-password" />
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword">
                                                <i class="fas fa-eye" id="eyeIcon"></i>
                                            </button>
                                        </div>
                        </div>
                        <div class="col-md-6 mb-3">
                                        <label for="password_confirmation" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required />
                                            <button class="btn btn-outline-secondary" type="button" id="togglePassword2">
                                                <i class="fas fa-eye" id="eyeIcon2"></i>
                                            </button>
                                        </div>
                                    </div>
                        </div>


                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary" id="registerBtn">
                                    {{ __('Register') }}
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
    const registerForm = document.getElementById('registerForm');
    const registerBtn = document.getElementById('registerBtn');

    if (registerForm) {
        registerForm.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            // Disable submit button
            registerBtn.disabled = true;
            registerBtn.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span>Registering...';

            // Get form data
            const formData = {
                first_name: document.getElementById('first_name').value,
                middle_name: document.getElementById('middle_name').value,
                last_name: document.getElementById('last_name').value,
                gender: document.getElementById('gender').value,
                email: document.getElementById('email').value,
                phone_number: document.getElementById('phone_number').value,
                dob: document.getElementById('dob').value,
                marital_status: document.getElementById('marital_status').value,
                nin: document.getElementById('nin').value,
                password: document.getElementById('password').value,
                password_confirmation: document.getElementById('password_confirmation').value
            };

            try {
                const response = await axios.post(`${apiUrl}/register`, formData);
                
                console.log('API Response:', response.data);
                
                // Check if response is successful (status 200 or 201)
                if (response.status === 200 || response.status === 201) {
                    // Store user data if provided
                    if (response.data.data && response.data.data.user) {
                        localStorage.setItem('user', JSON.stringify(response.data.data.user));
                    }
                    if (response.data.data && response.data.data.token) {
                        localStorage.setItem('token', response.data.data.token);
                    }
                    
                    // Store email for OTP verification
                    if (formData.email) {
                        sessionStorage.setItem('otp_email', formData.email);
                    }
                    
                    // Extract OTP code from message if present
                    const message = response.data.message || 'Registration successful!';
                    let otpCode = null;
                    
                    // Try to extract 6-digit OTP from message
                    const otpMatch = message.match(/\b\d{6}\b/);
                    if (otpMatch) {
                        otpCode = otpMatch[0];
                        sessionStorage.setItem('otp_code', otpCode);
                        console.log('OTP Code extracted:', otpCode);
                    }
                    
                    // Show success message with OTP code
                    alert(message + '\nRedirecting to OTP verification...');
                    
                    // Redirect to OTP page
                    window.location.href = '{{ route("otp") }}';
                }
            } catch (error) {
                console.error('Registration error:', error);
                
                let errorMessage = 'Registration failed. Please try again.';
                
                if (error.response) {
                    if (error.response.data.message) {
                        errorMessage = error.response.data.message;
                    } else if (error.response.data.errors) {
                        // Handle validation errors
                        const errors = error.response.data.errors;
                        errorMessage = Object.values(errors).flat().join('\n');
                    }
                } else if (error.message) {
                    errorMessage = error.message;
                }
                
                alert(errorMessage);
                
                // Re-enable submit button
                registerBtn.disabled = false;
                registerBtn.innerHTML = '{{ __("Register") }}';
            }
        });
    }
});
</script>
@endsection
