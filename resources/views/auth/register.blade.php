@extends('layouts.app')

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
                                <button type="submit" class="btn btn-primary">
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
@endsection
