@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        {{-- <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Dashboard') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}
                </div>
            </div>
        </div> --}}



           <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>
    <!-- Main Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary shadow-sm" id="mainNavbar">
        <div class="container-fluid">
            <img src="img/logo.png" alt="PPDA Logo" style="display: block; margin: 0; max-width: 60px; height: auto; border-radius: 2px; box-shadow: 0 8px 20px rgba(0,0,0,0.1);" class="navbar-brand">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbarCollapse" aria-controls="mainNavbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="mainNavbarCollapse">
                <ul class="navbar-nav mx-auto mb-2 mb-lg-0">

           
                    {{-- <li class="nav-item" id="homeNavItem"><a class="nav-link" href="#" onclick="showHomePage()">Home</a></li> --}}

                    {{-- <div id="loggedInNav" style="display:none;"> --}}
                        <li class="nav-item" id="homeNavItem"><a class="nav-link" href="#" onclick="showHomePage()">Home</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('selectJob')">Jobs</a></li>
                        <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('personalDetails')">My Profile</a></li>
                        <li class="nav-link" href="#" onclick="showSection('myApplication')">My Applications</a></li>
                        <!-- <li class="nav-item"><a class="nav-link" href="#" onclick="showSection('documents')">Documents</a></li> -->
                    </div>
                </ul>
            </div>
            <div class="d-flex align-items-center gap-3">
                <div class="dropdown" id="userDropdownContainer" style="display:none;">
                    <button type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false" aria-label="User menu" style="cursor: pointer; color: white; background: none; border: none;"><i class="fas fa-user"></i> User <i class="fas fa-caret-down"></i></button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown" id="userDropdownMenu">
                        <li><h6 class="dropdown-header" id="navbarUserName"><i class="fas fa-user me-2"></i>User</h6><span class="dropdown-item-text text-muted" id="navbarUserRole"><i class="fas fa-id-badge me-2"></i>Applicant</span></li>
                        
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#" onclick="showSection('personalDetails')"><i class="fas fa-user me-2"></i>Profile</a></li>
                        <li><button class="dropdown-item" id="btnLogout" type="button"><i class="fas fa-sign-out-alt me-2"></i>Logout</button></li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>





        <!-- Application Area -->
    <div class="container-xxl py-4" id="applicationDashboard" style="display:block;">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3 sidebar d-none d-md-block">
                <h5 class="sidebar-title">Application Steps</h5>
                <p class="sidebar-subtitle">Complete all sections</p>
                <nav class="nav flex-column" id="sidebarNav">
                    <a href="#" class="nav-link" data-step="personalDetails"><i class="fa fa-user"></i> Personal Details</a>
                    <a href="#" class="nav-link" data-step="educationTraining"><i class="fa fa-graduation-cap"></i> Education and Training</a>
                    <a href="#" class="nav-link" data-step="professionalMembership"><i class="fa fa-file-alt"></i> Professional Membership</a>
                    <a href="#" class="nav-link" data-step="employmentHistory"><i class="fa fa-briefcase"></i> Employment History</a>
                    <a href="#" class="nav-link" data-step="documents"><i class="fa fa-paperclip"></i> Documents</a>
                    <a href="#" class="nav-link" data-step="referee"><i class="fa fa-eye"></i> Referee</a>
                    <a href="#" class="nav-link" data-step="dependants"><i class="fa fa-users"></i> Dependants</a>
                    <a href="#" class="nav-link" data-step="previewApplication"><i class="fa fa-id-card"></i> Preview Application</a>
                    <a href="#" class="nav-link active" data-step="selectJob"><i class="fa fa-tasks"></i> Select a Job</a>
               
                </nav>
            </aside>


            <script>
        // Global functions for navigation
        function showHomePage() {
            document.getElementById('homePage').style.display = 'block';
            document.getElementById('applicationDashboard').style.display = 'none';
        }

        function showSection(sectionName) {
            document.getElementById('homePage').style.display = 'none';
            document.getElementById('applicationDashboard').style.display = 'block';

            // Use the existing showStep function from app.js
            if (window.showStep) {
                window.showStep(sectionName);
            }
        }

       
    </script>

    </div>
</div>
@endsection
