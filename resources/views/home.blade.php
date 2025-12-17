@extends('layouts.public')

@section('content')
<div class="container">
    <div class="row justify-content-center">
     

           <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>
   





        <!-- Home Page with Job Listings -->
    <div class="container-xxl py-4" id="homePage" style="display:block;">
        <div class="row justify-content-center">
            <div class="col-12">
                <h2 class="text-center mb-4">Available Job Openings</h2>
                <div id="jobsLoading" class="text-center">
                    <div class="spinner-border text-primary" role="status">
                        <span class="visually-hidden">Loading...</span>
                    </div>
                </div>
                <div class="row" id="jobsList"></div>
            </div>
        </div>
    </div>

    <!-- Job Details Modal -->
    <div class="modal fade" id="jobDetailsModal" tabindex="-1" aria-labelledby="jobDetailsModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="jobDetailsModalLabel">Job Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="jobDetailsModalBody">
                    <!-- Content loaded here -->
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="btnApplyFromModal">Apply Now</button>
                </div>
            </div>
        </div>
    </div>

        <!-- Application Area -->
    <div class="container-xxl py-4" id="applicationDashboard" style="display:none;">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3 sidebar d-none d-md-block">
                <h5 class="sidebar-title">Application Steps</h5>
                <p class="sidebar-subtitle">Complete all sections</p>
                <nav class="nav flex-column" id="sidebarNav">
                    <a href="#" class="nav-link" data-step="personalDetails" onclick="loadSection('personalDetails')"><i class="fa fa-user"></i> Personal Details</a>
                    <a href="#" class="nav-link" data-step="educationTraining" onclick="loadSection('educationTraining')"><i class="fa fa-graduation-cap"></i> Education and Training</a>
                    <a href="#" class="nav-link" data-step="professionalMembership" onclick="loadSection('professionalMembership')"><i class="fa fa-file-alt"></i> Professional Membership</a>
                    <a href="#" class="nav-link" data-step="employmentHistory" onclick="loadSection('employmentHistory')"><i class="fa fa-briefcase"></i> Employment History</a>
                    <a href="#" class="nav-link" data-step="documents" onclick="loadSection('documents')"><i class="fa fa-paperclip"></i> Documents</a>
                    <a href="#" class="nav-link" data-step="referee" onclick="loadSection('referee')"><i class="fa fa-eye"></i> Referee</a>
                    <a href="#" class="nav-link" data-step="dependants" onclick="loadSection('dependants')"><i class="fa fa-users"></i> Dependants</a>
                    <a href="#" class="nav-link" data-step="previewApplication" onclick="loadSection('previewApplication')"><i class="fa fa-id-card"></i> Preview Application</a>
                    <a href="#" class="nav-link active" data-step="selectJob" onclick="loadSection('selectJob')"><i class="fa fa-tasks"></i> Select a Job</a>
               
                </nav>
            </aside>

            <!-- Main Content Area -->
            <main class="col-md-9 main-panel" id="mainPanel">
                <!-- Personal Details Section -->
                <section data-step-content="personalDetails" class="d-none">
                    <h4 class="mb-4"><i class="fas fa-user me-2"></i>Personal Details</h4>
                    <form id="formPersonalDetails">
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="firstName" class="form-label fw-bold">First Name</label>
                                <input type="text" class="form-control" id="firstName" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="middleName" class="form-label fw-bold">Middle Name</label>
                                <input type="text" class="form-control" id="middleName">
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="lastName" class="form-label fw-bold">Last Name</label>
                                <input type="text" class="form-control" id="lastName" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="emailDetail" class="form-label fw-bold">Email</label>
                                <input type="email" class="form-control" id="emailDetail" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="contact" class="form-label fw-bold">Contact</label>
                                <input type="text" class="form-control" id="contact" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-4 mb-3">
                                <label for="ninDetail" class="form-label fw-bold">NIN</label>
                                <input type="text" class="form-control" id="ninDetail" required>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="genderDetail" class="form-label fw-bold">Gender</label>
                                <select class="form-control" id="genderDetail" required>
                                    <option value="">Select Gender</option>
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                            <div class="col-md-4 mb-3">
                                <label for="dobDetail" class="form-label fw-bold">Date of Birth</label>
                                <input type="date" class="form-control" id="dobDetail" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="statusDetail" class="form-label fw-bold">Marital Status</label>
                                <select class="form-control" id="statusDetail" required>
                                    <option value="">Select Status</option>
                                    <option value="Single">Single</option>
                                    <option value="Married">Married</option>
                                    <option value="Divorced">Divorced</option>
                                    <option value="Widowed">Widowed</option>
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-save me-2"></i>Save Personal Details
                        </button>
                    </form>
                </section>

                <!-- Education and Training Section -->
                <section data-step-content="educationTraining" class="d-none">
                    <h4 class="mb-4"><i class="fas fa-graduation-cap me-2"></i>Education and Training</h4>
                    <button class="btn btn-primary mb-3" id="btnAddEducation">
                        <i class="fas fa-plus me-2"></i>Add Education
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped" id="educationTable">
                            <thead>
                                <tr>
                                    <th>From Year</th>
                                    <th>To Year</th>
                                    <th>Qualification</th>
                                    <th>Course</th>
                                    <th>Institution</th>
                                    <th>Class</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </section>

                <!-- Professional Membership Section -->
                <section data-step-content="professionalMembership" class="d-none">
                    <h4 class="mb-4"><i class="fas fa-users me-2"></i>Professional Membership</h4>
                    <button class="btn btn-primary mb-3" id="btnAddMembership">
                        <i class="fas fa-plus me-2"></i>Add Membership
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped" id="membershipTable">
                            <thead>
                                <tr>
                                    <th>Enrollment Year</th>
                                    <th>Expiry Year</th>
                                    <th>Membership Number</th>
                                    <th>Type</th>
                                    <th>Institute</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </section>

                <!-- Employment History Section -->
                <section data-step-content="employmentHistory" class="d-none">
                    <h4 class="mb-4"><i class="fas fa-briefcase me-2"></i>Employment History</h4>
                    <button class="btn btn-primary mb-3" id="btnAddEmployment">
                        <i class="fas fa-plus me-2"></i>Add Employment
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped" id="employmentTable">
                            <thead>
                                <tr>
                                    <th>From Date</th>
                                    <th>To Date</th>
                                    <th>Employer</th>
                                    <th>Position</th>
                                    <th>Duties</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </section>

                <!-- Documents Section -->
                <section data-step-content="documents" class="d-none">
                    <h4 class="mb-4"><i class="fas fa-paperclip me-2"></i>Documents</h4>
                    <button class="btn btn-primary mb-3" id="btnAddDocument">
                        <i class="fas fa-plus me-2"></i>Add Document
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped" id="documentsTable">
                            <thead>
                                <tr>
                                    <th>Document Type</th>
                                    <th>Title</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </section>

                <!-- Referee Section -->
                <section data-step-content="referee" class="d-none">
                    <h4 class="mb-4"><i class="fas fa-eye me-2"></i>Referee</h4>
                    <button class="btn btn-primary mb-3" id="btnAddReferee">
                        <i class="fas fa-plus me-2"></i>Add Referee
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped" id="refereeTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Relationship</th>
                                    <th>Contact</th>
                                    <th>Email</th>
                                    <th>Address</th>
                                    <th>Position</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </section>

                <!-- Dependants Section -->
                <section data-step-content="dependants" class="d-none">
                    <h4 class="mb-4"><i class="fas fa-users me-2"></i>Dependants</h4>
                    <button class="btn btn-primary mb-3" id="btnAddDependant">
                        <i class="fas fa-plus me-2"></i>Add Dependant
                    </button>
                    <div class="table-responsive">
                        <table class="table table-striped" id="dependantsTable">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Relationship</th>
                                    <th>Date of Birth</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </section>

                <!-- Preview Application Section -->
                <section data-step-content="previewApplication" class="d-none">
                    <!-- Content will be loaded here by loadPreview() -->
                </section>

                <!-- Select Job Section -->
                <section data-step-content="selectJob" class="d-none">
                    <h4 class="mb-4"><i class="fas fa-tasks me-2"></i>Select a Job</h4>
                    <div class="table-responsive">
                        <table class="table table-striped" id="jobTable">
                            <thead>
                                <tr>
                                    <th>Position</th>
                                    <th>Location</th>
                                    <th>Deadline</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </section>

                <!-- My Applications Section -->
                <section data-step-content="myApplication" class="d-none">
                    <h4 class="mb-4"><i class="fas fa-list me-2"></i>My Applications</h4>
                    <div class="table-responsive">
                        <table class="table table-striped" id="myApplicationsTable">
                            <thead>
                                <tr>
                                    <th>Interview ID</th>
                                    <th>Position</th>
                                    <th>Department</th>
                                    <th>Application Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody></tbody>
                        </table>
                    </div>
                </section>
            </main>

            <!-- Bootstrap JS (must be before app.js) -->
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
            <!-- Axios for API calls -->
            <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
            <!-- app.js is loaded in the layout -->
            <script>
            // Global loadSection function - defined immediately
            window.loadSection = function(section) {
                // Hide all sections first
                const allSections = document.querySelectorAll('[data-step-content]');
                allSections.forEach(sec => sec.classList.add('d-none'));

                // Show the selected section
                const targetSection = document.querySelector(`[data-step-content="${section}"]`);
                if (targetSection) {
                    targetSection.classList.remove('d-none');
                }

                // Load data for the section if API is available
                if (typeof window.API !== 'undefined') {
                    // Map section names to API endpoints
                    const sectionApiMap = {
                        personalDetails: API.personalDetails ? API.personalDetails : null,
                        educationTraining: API.educationTraining,
                        professionalMembership: API.professionalMembership,
                        employmentHistory: API.employmentHistory,
                        documents: API.documents,
                        referee: API.referee,
                        dependants: API.dependants,
                        previewApplication: API.getMyApplications,
                        selectJob: API.selectJob
                    };

                    const endpoint = sectionApiMap[section];
                    if (endpoint) {
                        let url = endpoint;
                        if (typeof endpoint === 'function') {
                            url = endpoint(1);
                        }
                            fetch(url)
                                .then(async res => {
                                    const contentType = res.headers.get('content-type');
                                    if (contentType && contentType.includes('application/json')) {
                                        return res.json();
                                    } else {
                                        // Try to get text and show a user-friendly error
                                        const text = await res.text();
                                        throw new Error('API did not return JSON.\nStatus: ' + res.status + '\n' + text.substring(0, 200));
                                    }
                                })
                                .then(data => {
                                    console.log('Loaded data for', section, data);
                                    // Populate forms with data if available
                                    populateSectionData(section, data);
                                })
                                .catch(err => {
                                    const mainContent = document.getElementById('mainContent');
                                    if (mainContent) {
                                        mainContent.innerHTML = `<div class='alert alert-danger'>Failed to load data for <b>${section}</b>.<br>${err.message}</div>`;
                                    }
                                    console.error('API error for', section, err);
                                });
                    }
                }
            };

            // Function to populate form data
            function populateSectionData(section, data) {
                switch(section) {
                    case 'personalDetails':
                        if (data && typeof data === 'object') {
                            document.getElementById('firstName').value = data.first_name || '';
                            document.getElementById('middleName').value = data.middle_name || '';
                            document.getElementById('lastName').value = data.last_name || '';
                            document.getElementById('emailDetail').value = data.email || '';
                            document.getElementById('contact').value = data.contact || '';
                            document.getElementById('ninDetail').value = data.nin || '';
                            document.getElementById('genderDetail').value = data.gender || '';
                            document.getElementById('dobDetail').value = data.date_of_birth || '';
                            document.getElementById('statusDetail').value = data.marital_status || '';
                        }
                        break;
                    case 'selectJob':
                        populateJobTable(data);
                        break;
                    case 'previewApplication':
                        populateMyApplications(data);
                        break;
                    // Add other sections as needed
                }
            }

            function populateJobTable(data) {
                const tableBody = document.querySelector('#jobTable tbody');
                // Handle the API response structure: {statusCode: 0, data: [...]}
                const jobs = data && data.data ? data.data : (Array.isArray(data) ? data : []);
                // Store jobs globally for applyForJob function
                window.jobs = jobs;
                if (tableBody && Array.isArray(jobs)) {
                    if (jobs.length === 0) {
                        tableBody.innerHTML = '<tr><td colspan="4" class="text-center text-muted">No jobs listed currently.</td></tr>';
                        return;
                    }
                    tableBody.innerHTML = jobs.map(job => `
                        <tr>
                            <td>${job.name || ''}</td>
                            <td>${job.location || ''}</td>
                            <td>${job.deadline || ''}</td>
                            <td>
                                <button class="btn btn-sm btn-primary" onclick="applyForJob('${job.id}')">Apply</button>
                            </td>
                        </tr>
                    `).join('');
                }
            }

            // Define applyForJob function globally
            window.applyForJob = function(jobId) {
                const job = window.jobs.find(j => j.id == jobId);
                if (job && typeof showJobDetailsModal === 'function') {
                    showJobDetailsModal(job);
                }
            };

            function populateMyApplications(data) {
                const tableBody = document.querySelector('#myApplicationsTable tbody');
                if (tableBody && Array.isArray(data)) {
                    tableBody.innerHTML = data.map(app => `
                        <tr>
                            <td>${app.interview_id || ''}</td>
                            <td>${app.position || ''}</td>
                            <td>${app.department || ''}</td>
                            <td>${app.application_date || ''}</td>
                            <td>${app.status || ''}</td>
                        </tr>
                    `).join('');
                }
            }

            // Initialize by loading jobs on the home page
            document.addEventListener('DOMContentLoaded', function() {
                if (window.WelcomePageJobs) {
                    window.WelcomePageJobs.loadJobs();
                }
            });
            </script>


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
