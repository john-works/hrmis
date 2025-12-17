
 @extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
           <!-- Toast Container -->
    <div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>
    <div id="homePage" class="container-fluid py-5" style="background-color: #f8fafc;">
    <h2 class="text-center mb-5 text-primary fw-bold">Current Job Openings</h2>
    <!-- Main Content -->
    <div class="container my-5">
        <div class="row" id="jobsList">
            <!-- Loading spinner -->
            <div class="col-12 text-center" id="jobsLoading">
                <div class="spinner-border text-primary" role="status">
                    <span class="visually-hidden">Loading jobs...</span>
                </div>
                <p class="mt-2 text-muted">Loading job openings...</p>
            </div>
            <!-- Jobs will be dynamically loaded here -->
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

    <!-- CRUD Modal for Add/Edit Forms -->
    <div class="modal fade" id="crudModal" tabindex="-1" aria-labelledby="crudModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="crudModalLabel">Modal Title</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="crudModalBody">
                    <form id="crudForm">
                        <input type="hidden" id="crudItemId" name="id">
                        <!-- Form content will be loaded here -->
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary" id="crudSaveBtn" form="crudForm">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <!-- Login form will be loaded here -->
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
                <section data-step-content="personalDetails">
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
                <section data-step-content="educationTraining">
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
                            <tbody id="documentsTableBody"></tbody>
                        </table>
                    </div>
                    </section>

                        <!-- Professional Membership Section -->
                <section data-step-content="professionalMembership">
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
                <section data-step-content="employmentHistory">
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
                <section data-step-content="documents">
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
                <section data-step-content="referee">
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
                <section data-step-content="dependants">
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





    <script>
// Generic fetch and render for all main tables
document.addEventListener('DOMContentLoaded', function() {
    const apiUrl = 'http://192.168.32.215:8041/api/v1';
    const tableConfigs = [
        {
            section: 'educationTraining',
            tableBody: 'educationTable',
            endpoint: userId => `${apiUrl}/educations/${userId}`,
            columns: ['start_year', 'end_year', 'qualification', 'course', 'institution', 'degree_class', 'ongoing'],
            noDataMsg: 'No education records found.'
        },
        {
            section: 'professionalMembership',
            tableBody: 'membershipTable',
            endpoint: userId => `${apiUrl}/memberships/${userId}`,
            columns: ['enrollment_year', 'expiry_year', 'membership_number', 'type', 'institute'],
            noDataMsg: 'No membership records found.'
        },
        {
            section: 'employmentHistory',
            tableBody: 'employmentTable',
            endpoint: userId => `${apiUrl}/employments/${userId}`,
            columns: ['start_date', 'end_date', 'employer', 'position', 'duties', 'is_current'],
            noDataMsg: 'No employment records found.'
        },
        {
            section: 'documents',
            tableBody: 'documentsTable',
            endpoint: userId => `${apiUrl}/documents/${userId}`,
            columns: ['document_type', 'title'],
            noDataMsg: 'No documents found.'
        },
        {
            section: 'referee',
            tableBody: 'refereeTable',
            endpoint: userId => `${apiUrl}/referees/${userId}`,
            columns: ['name', 'relationship', 'contact', 'email', 'address', 'position'],
            noDataMsg: 'No referees found.'
        },
        {
            section: 'dependants',
            tableBody: 'dependantsTable',
            endpoint: userId => `${apiUrl}/dependants/${userId}`,
            columns: ['name', 'relationship', 'birth_date'],
            noDataMsg: 'No dependants found.'
        },
        {
            section: 'myApplication',
            tableBody: 'myApplicationsTable',
            endpoint: userId => `${apiUrl}/applications/${userId}`,
            columns: ['interview_id', 'position', 'department', 'application_date', 'status'],
            noDataMsg: 'No applications found.'
        },
        {
            section: 'selectJob',
            tableBody: 'jobTable',
            endpoint: () => `${apiUrl}/positions`,
            columns: ['name', 'location', 'deadline'],
            noDataMsg: 'No jobs listed currently.'
        }
    ];

    function showToast(message, type = 'info') {
        const toastContainer = document.getElementById('toastContainer');
        const toastId = 'toast-' + Date.now();
        const toastHTML = `
            <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header ${type}">
                    <strong class="me-auto">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">${message}</div>
            </div>
        `;
        toastContainer.insertAdjacentHTML('beforeend', toastHTML);
        const toastEl = document.getElementById(toastId);
        const bsToast = new bootstrap.Toast(toastEl, { autohide: true, delay: 4000 });
        bsToast.show();
        toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
    }

    async function fetchAndRender(section) {
        const config = tableConfigs.find(c => c.section === section);
        if (!config) return;
        const table = document.getElementById(config.tableBody);
        if (!table) return;
        const tbody = table.querySelector('tbody');
        if (!tbody) return;
        tbody.innerHTML = `<tr><td colspan="${config.columns.length + 1}" class="text-center text-muted">Loading...</td></tr>`;
        let user = null;
        try { user = JSON.parse(localStorage.getItem('user')); } catch {}
        const userId = user && user.id ? user.id : 1;
        let url = typeof config.endpoint === 'function' ? config.endpoint(userId) : config.endpoint;
        let token = localStorage.getItem('token');
        try {
            const response = await fetch(url, { headers: token ? { 'Authorization': `Bearer ${token}` } : {} });
            let data = await response.json();
            data = data && data.data ? data.data : (Array.isArray(data) ? data : []);
            if (!data || data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="${config.columns.length + 1}" class="text-center text-warning">${config.noDataMsg}</td></tr>`;
                showToast(config.noDataMsg, 'warning');
                return;
            }
            tbody.innerHTML = data.map(item => {
                let tds = config.columns.map(col => {
                    let val = item[col];
                    if (col === 'ongoing' || col === 'is_current') return `<td>${val ? 'Current' : 'Past'}</td>`;
                    return `<td>${val !== undefined && val !== null ? val : ''}</td>`;
                }).join('');
                return `<tr>${tds}<td><button class='btn btn-sm btn-primary me-2'>Edit</button><button class='btn btn-sm btn-danger'>Delete</button></td></tr>`;
            }).join('');
        } catch (err) {
            tbody.innerHTML = `<tr><td colspan="${config.columns.length + 1}" class="text-center text-danger">Failed to load data.</td></tr>`;
            showToast('Failed to load data from server.', 'error');
        }
    }

    // Listen for section show (when user navigates)
    const sidebarNav = document.getElementById('sidebarNav');
    if (sidebarNav) {
        sidebarNav.addEventListener('click', function(e) {
            const a = e.target.closest('a[data-step]');
            if (a) {
                const section = a.getAttribute('data-step');
                setTimeout(() => fetchAndRender(section), 200);
            }
        });
    }
    // Also fetch on page load for visible sections
    tableConfigs.forEach(cfg => {
        const sectionEl = document.querySelector(`section[data-step-content="${cfg.section}"]`);
        if (sectionEl && !sectionEl.classList.contains('d-none')) {
            fetchAndRender(cfg.section);
        }
    });
});
</script>                    
                        
                        
                        
                        
                        <script>
                        // Fetch and render documents from API when the documents section is shown
                        document.addEventListener('DOMContentLoaded', function() {
                            const documentsSection = document.querySelector('section[data-step-content="documents"]');
                            const documentsTableBody = document.getElementById('documentsTableBody');
                            const btnAddDocument = document.getElementById('btnAddDocument');
                            // Helper: show toast
                            function showToast(message, type = 'info') {
                                const toastContainer = document.getElementById('toastContainer');
                                const toastId = 'toast-' + Date.now();
                                const toastHTML = `
                                    <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                                        <div class="toast-header ${type}">
                                            <strong class="me-auto">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                                            <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                                        </div>
                                        <div class="toast-body">${message}</div>
                                    </div>
                                `;
                                toastContainer.insertAdjacentHTML('beforeend', toastHTML);
                                const toastEl = document.getElementById(toastId);
                                const bsToast = new bootstrap.Toast(toastEl, { autohide: true, delay: 4000 });
                                bsToast.show();
                                toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
                            }

                            async function fetchDocuments() {
                                if (!documentsTableBody) return;
                                documentsTableBody.innerHTML = '<tr><td colspan="3" class="text-center text-muted">Loading...</td></tr>';
                                try {
                                    // Use your API base URL and current user ID
                                    const apiUrl = 'http://192.168.32.215:8041/api/v1';
                                    let user = null;
                                    try {
                                        user = JSON.parse(localStorage.getItem('user'));
                                    } catch {}
                                    const userId = user && user.id ? user.id : 1;
                                    const url = `${apiUrl}/documents/${userId}`;
                                    const token = localStorage.getItem('token');
                                    const response = await fetch(url, {
                                        headers: token ? { 'Authorization': `Bearer ${token}` } : {}
                                    });
                                    let data = await response.json();
                                    // Support both {data: [...]} and [...] formats
                                    data = data && data.data ? data.data : (Array.isArray(data) ? data : []);
                                    if (!data || data.length === 0) {
                                        documentsTableBody.innerHTML = '<tr><td colspan="3" class="text-center text-warning">No documents found. Click "Add Document" to upload your first document.</td></tr>';
                                        showToast('No documents found. Please add a document.', 'warning');
                                        return;
                                    }
                                    documentsTableBody.innerHTML = data.map(doc => `
                                        <tr>
                                            <td>${doc.document_type || ''}</td>
                                            <td>${doc.title || ''}</td>
                                            <td>
                                                <button class="btn btn-sm btn-primary me-2">Edit</button>
                                                <button class="btn btn-sm btn-danger">Delete</button>
                                            </td>
                                        </tr>
                                    `).join('');
                                } catch (err) {
                                    documentsTableBody.innerHTML = '<tr><td colspan="3" class="text-center text-danger">Failed to load documents.</td></tr>';
                                    showToast('Failed to load documents from server.', 'error');
                                }
                            }

                            // Listen for section show (when user navigates to documents)
                            const sidebarNav = document.getElementById('sidebarNav');
                            if (sidebarNav) {
                                sidebarNav.addEventListener('click', function(e) {
                                    const a = e.target.closest('a[data-step]');
                                    if (a && a.getAttribute('data-step') === 'documents') {
                                        setTimeout(fetchDocuments, 200); // Delay to allow section to show
                                    }
                                });
                            }
                            // Also fetch on page load if already visible
                            if (documentsSection && !documentsSection.classList.contains('d-none')) {
                                fetchDocuments();
                            }
                        });
                        </script>
                        </table>
                    </div>
                </section>

            

                <!-- Preview Application Section -->
                <section data-step-content="previewApplication">
                    <!-- Content will be loaded here by loadPreview() -->
                </section>

                <!-- Select Job Section -->
                <section data-step-content="selectJob">
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
                <section data-step-content="myApplication">
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
            // Define modal functions if not already defined
            if (typeof window.openEducationModal === 'undefined') {
                window.openEducationModal = function(editItem = null) {
                    const crudModalLabel = document.getElementById('crudModalLabel');
                    const crudForm = document.getElementById('crudForm');
                    const crudModal = new bootstrap.Modal(document.getElementById('crudModal'));
                    const crudItemIdInput = document.getElementById('crudItemId');

                    if (crudModalLabel) {
                        crudModalLabel.innerHTML = `
                            <i class="fas fa-graduation-cap me-2"></i>
                            ${editItem ? 'Edit Education' : 'Add Education'}
                        `;
                    }

                    if (crudForm) {
                        crudForm.innerHTML = `
                            <input type="hidden" id="crudItemId" name="id" value="${editItem ? editItem.id : ''}">
                            <input type="hidden" name="applicant_id" value="${window.currentUser?.id || ''}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">From Year</label>
                                    <select class="form-control" id="start_year" name="start_year" required>
                                        <option value="">Select Year</option>
                                        ${(() => {
                                            let options = '';
                                            const currentYear = new Date().getFullYear();
                                            for (let year = 1990; year <= currentYear; year++) {
                                                options += `<option value="${year}" ${editItem?.start_year == year ? 'selected' : ''}>${year}</option>`;
                                            }
                                            return options;
                                        })()}
                                    </select>
                                </div>

                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">To Year</label>
                                    <select class="form-control" id="end_year" name="end_year">
                                        <option value="">Select Year</option>
                                        ${(() => {
                                            let options = '';
                                            const currentYear = new Date().getFullYear();
                                            for (let year = 1990; year <= currentYear; year++) {
                                                options += `<option value="${year}" ${editItem?.end_year == year ? 'selected' : ''}>${year}</option>`;
                                            }
                                            return options;
                                        })()}
                                    </select>
                                </div>
                            </div>

                            <div class="row">
                            <div class="col-md-8 mb-3">
                                    <label class="form-label fw-bold">Qualification</label>
                                    <select class="form-control" id="qualification" name="qualification" required>
                                        <option value="">Select Qualification</option>
                                        <option value="PhD" ${editItem?.qualification === 'PhD' ? 'selected' : ''}>PhD</option>
                                        <option value="Masters" ${editItem?.qualification === 'Masters' ? 'selected' : ''}>Masters</option>
                                        <option value="Bachelors" ${editItem?.qualification === 'Bachelors' ? 'selected' : ''}>Bachelors</option>
                                        <option value="Diploma" ${editItem?.qualification === 'Diploma' ? 'selected' : ''}>Diploma</option>
                                        <option value="Certificate" ${editItem?.qualification === 'Certificate' ? 'selected' : ''}>Certificate</option>
                                        <option value="Professional Certification" ${editItem?.qualification === 'Professional Certification' ? 'selected' : ''}>Professional Certification</option>

                                    </select>
                                </div>

                                <div class="col-md-4 mb-3" id="classOfDegreeContainer" style="display: none;">
                                    <label class="form-label fw-bold">Class of Degree</label>
                                    <select class="form-control" id="degree_class" name="degree_class">
                                        <option value="">Select Class</option>
                                        <option value="First Class" ${editItem?.degree_class === 'First Class' ? 'selected' : ''}>First Class</option>
                                        <option value="Second Class Upper" ${editItem?.degree_class === 'Second Class Upper' ? 'selected' : ''}>Second Class Upper</option>
                                        <option value="Second Class Lower" ${editItem?.degree_class === 'Second Class Lower' ? 'selected' : ''}>Second Class Lower</option>
                                        <option value="Third Class" ${editItem?.degree_class === 'Third Class' ? 'selected' : ''}>Third Class</option>
                                        <option value="Pass" ${editItem?.degree_class === 'Pass' ? 'selected' : ''}>Pass</option>
                                    </select>
                                </div>

                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Program/Course</label>
                                    <input type="text" class="form-control" id="course" name="course"
                                        required value="${editItem?.course || ''}">
                                </div>
                                <div class="col-md-12 mb-3">
                                    <label class="form-label fw-bold">Institution</label>
                                    <input type="text" class="form-control" id="institution" name="institution"
                                        required value="${editItem?.institution || ''}">
                                </div>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="ongoing" name="ongoing" ${editItem?.ongoing ? 'checked' : ''}>
                                <label class="form-check-label fw-bold" for="ongoing">
                                    Ongoing
                                </label>
                            </div>
                        `;
                    }

                    if (crudModal) {
                        crudModal.show();
                    }

                    // Toggle Class of Degree visibility based on qualification
                    function toggleClassOfDegree() {
                        const qualification = document.getElementById('qualification');
                        const container = document.getElementById('classOfDegreeContainer');
                        if (qualification && container) {
                            if (qualification.value === 'Bachelors') {
                                container.style.display = 'block';
                            } else {
                                container.style.display = 'none';
                            }
                        }
                    }

                    // Add event listener to qualification select
                    const qualificationSelect = document.getElementById('qualification');
                    if (qualificationSelect) {
                        qualificationSelect.addEventListener('change', toggleClassOfDegree);
                    }

                    // Initial toggle for edit mode
                    toggleClassOfDegree();
                };
            }

            if (typeof window.openMembershipModal === 'undefined') {
                window.openMembershipModal = function(editItem = null) {
                    const crudModalLabel = document.getElementById('crudModalLabel');
                    const crudForm = document.getElementById('crudForm');
                    const crudModalBody = document.getElementById('crudModalBody');
                    const crudModal = crudModalBody ? new bootstrap.Modal(document.getElementById('crudModal')) : null;
                    const crudItemIdInput = document.getElementById('crudItemId');

                    if (crudModalLabel) {
                        crudModalLabel.innerHTML = `
                            <i class="fas fa-users me-2"></i>
                            ${editItem ? 'Edit Membership' : 'Add Membership'}
                        `;
                    }

                    if (crudModalBody) {
                        crudModalBody.innerHTML = `
                            <input type="hidden" id="crudItemId" name="id" value="${editItem ? editItem.id : ''}">
                            <input type="hidden" name="applicant_id" value="${window.currentUser?.id || ''}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Enrollment Year</label>
                                    <select class="form-control" id="enrollment_year" name="enrollment_year" required>
                                        <option value="">Select Year</option>
                                        ${(() => {
                                            let options = '';
                                            const currentYear = new Date().getFullYear();
                                            for (let year = 1990; year <= currentYear; year++) {
                                                options += `<option value="${year}" ${editItem?.enrollment_year == year ? 'selected' : ''}>${year}</option>`;
                                            }
                                            return options;
                                        })()}
                                    </select>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Year of Expiry</label>
                                    <select class="form-control" id="expiry_year" name="expiry_year">
                                        <option value="">Select Year</option>
                                        ${(() => {
                                            let options = '';
                                            const currentYear = new Date().getFullYear();
                                            for (let year = 1990; year <= currentYear; year++) {
                                                options += `<option value="${year}" ${editItem?.expiry_year == year ? 'selected' : ''}>${year}</option>`;
                                            }
                                            return options;
                                        })()}
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Institute</label>
                                <input type="text" class="form-control"
                                    id="membershipInstitute"
                                    name="institute"
                                    placeholder="Eg, ISACA, Rotary, Lions Club"
                                    required
                                    value="${editItem?.institute || ''}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Membership Type</label>
                                <input type="text" class="form-control" id="membershipType" name="type" placeholder="Eg, Regular, Life, Honorary" required value="${editItem?.type || ''}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Membership Number</label>
                                <input type="text" class="form-control" id="membershipNumber" name="membership_number" placeholder="Eg, 123456" required value="${editItem?.membership_number || ''}">
                            </div>
                        `;
                    }

                    if (crudModal) {
                        crudModal.show();
                    }
                };
            }

            if (typeof window.openEmploymentModal === 'undefined') {
                window.openEmploymentModal = function(editItem = null) {
                    const crudModalLabel = document.getElementById('crudModalLabel');
                    const crudForm = document.getElementById('crudForm');
                    const crudModalBody = document.getElementById('crudModalBody');
                    const crudModal = crudModalBody ? new bootstrap.Modal(document.getElementById('crudModal')) : null;

                    if (crudModalLabel) {
                        crudModalLabel.innerHTML = `
                            <i class="fas fa-briefcase me-2"></i>
                            ${editItem ? 'Edit Employment' : 'Add Employment'}
                        `;
                    }

                    if (crudModalBody) {
                        crudModalBody.innerHTML = `
                            <input type="hidden" id="crudItemId" name="id" value="${editItem ? editItem.id : ''}">
                            <input type="hidden" name="applicant_id" value="${window.currentUser?.id || ''}">
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">From Date</label>
                                    <input type="date" class="form-control" id="start_date" name="start_date" required value="${editItem?.start_date || ''}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">To Date</label>
                                    <input type="date" class="form-control" id="end_date" name="end_date" value="${editItem?.end_date || ''}">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Employer</label>
                                <input type="text" class="form-control" id="employer" name="employer" required value="${editItem?.employer || ''}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Position</label>
                                <input type="text" class="form-control" id="position" name="position" required value="${editItem?.position || ''}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Duties</label>
                                <textarea class="form-control" id="duties" name="duties" rows="3" required>${editItem?.duties || ''}</textarea>
                            </div>
                            <div class="form-check mb-3">
                                <input class="form-check-input" type="checkbox" value="" id="is_current" name="is_current" ${editItem?.is_current ? 'checked' : ''}>
                                <label class="form-check-label fw-bold" for="is_current">
                                    Current Employment
                                </label>
                            </div>
                        `;
                    }

                    if (crudModal) {
                        crudModal.show();
                    }
                };
            }

            if (typeof window.openDocumentModal === 'undefined') {
                window.openDocumentModal = function(editItem = null) {
                    const crudModalLabel = document.getElementById('crudModalLabel');
                    const crudForm = document.getElementById('crudForm');
                    const crudModalBody = document.getElementById('crudModalBody');
                    const crudModal = crudModalBody ? new bootstrap.Modal(document.getElementById('crudModal')) : null;

                    if (crudModalLabel) {
                        crudModalLabel.innerHTML = `
                            <i class="fas fa-paperclip me-2"></i>
                            ${editItem ? 'Edit Document' : 'Add Document'}
                        `;
                    }

                    if (crudModalBody) {
                        crudModalBody.innerHTML = `
                            <input type="hidden" id="crudItemId" name="id" value="${editItem ? editItem.id : ''}">
                            <input type="hidden" name="applicant_id" value="${window.currentUser?.id || ''}">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Document Type</label>
                                <select class="form-control" id="document_type" name="document_type" required>
                                    <option value="">Select Document Type</option>
                                    <option value="CV" ${editItem?.document_type === 'CV' ? 'selected' : ''}>CV</option>
                                    <option value="Certificate" ${editItem?.document_type === 'Certificate' ? 'selected' : ''}>Certificate</option>
                                    <option value="Diploma" ${editItem?.document_type === 'Diploma' ? 'selected' : ''}>Diploma</option>
                                    <option value="Transcript" ${editItem?.document_type === 'Transcript' ? 'selected' : ''}>Transcript</option>
                                    <option value="ID" ${editItem?.document_type === 'ID' ? 'selected' : ''}>ID</option>
                                    <option value="Passport" ${editItem?.document_type === 'Passport' ? 'selected' : ''}>Passport</option>
                                    <option value="Other" ${editItem?.document_type === 'Other' ? 'selected' : ''}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Title</label>
                                <input type="text" class="form-control" id="title" name="title" required value="${editItem?.title || ''}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">File</label>
                                <input type="file" class="form-control" id="file" name="file" accept=".pdf,.doc,.docx,.jpg,.png" ${editItem ? '' : 'required'}>
                            </div>
                        `;
                    }

                    if (crudModal) {
                        crudModal.show();
                    }
                };
            }

            if (typeof window.openRefereeModal === 'undefined') {
                window.openRefereeModal = function(editItem = null) {
                    const crudModalLabel = document.getElementById('crudModalLabel');
                    const crudForm = document.getElementById('crudForm');
                    const crudModalBody = document.getElementById('crudModalBody');
                    const crudModal = crudModalBody ? new bootstrap.Modal(document.getElementById('crudModal')) : null;

                    if (crudModalLabel) {
                        crudModalLabel.innerHTML = `
                            <i class="fas fa-eye me-2"></i>
                            ${editItem ? 'Edit Referee' : 'Add Referee'}
                        `;
                    }

                    if (crudModalBody) {
                        crudModalBody.innerHTML = `
                            <input type="hidden" id="crudItemId" name="id" value="${editItem ? editItem.id : ''}">
                            <input type="hidden" name="applicant_id" value="${window.currentUser?.id || ''}">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control" id="referee_name" name="name" required value="${editItem?.name || ''}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Relationship</label>
                                <input type="text" class="form-control" id="relationship" name="relationship" required value="${editItem?.relationship || ''}">
                            </div>
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Contact</label>
                                    <input type="text" class="form-control" id="contact" name="contact" required value="${editItem?.contact || ''}">
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" required value="${editItem?.email || ''}">
                                </div>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Address</label>
                                <textarea class="form-control" id="address" name="address" rows="2" required>${editItem?.address || ''}</textarea>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Position</label>
                                <input type="text" class="form-control" id="referee_position" name="position" required value="${editItem?.position || ''}">
                            </div>
                        `;
                    }

                    if (crudModal) {
                        crudModal.show();
                    }
                };
            }

            if (typeof window.openDependantModal === 'undefined') {
                window.openDependantModal = function(editItem = null) {
                    const crudModalLabel = document.getElementById('crudModalLabel');
                    const crudForm = document.getElementById('crudForm');
                    const crudModalBody = document.getElementById('crudModalBody');
                    const crudModal = crudModalBody ? new bootstrap.Modal(document.getElementById('crudModal')) : null;

                    if (crudModalLabel) {
                        crudModalLabel.innerHTML = `
                            <i class="fas fa-users me-2"></i>
                            ${editItem ? 'Edit Dependant' : 'Add Dependant'}
                        `;
                    }

                    if (crudModalBody) {
                        crudModalBody.innerHTML = `
                            <input type="hidden" id="crudItemId" name="id" value="${editItem ? editItem.id : ''}">
                            <input type="hidden" name="applicant_id" value="${window.currentUser?.id || ''}">
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Name</label>
                                <input type="text" class="form-control" id="dependant_name" name="name" required value="${editItem?.name || ''}">
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Relationship</label>
                                <select class="form-control" id="dependant_relationship" name="relationship" required>
                                    <option value="">Select Relationship</option>
                                    <option value="Spouse" ${editItem?.relationship === 'Spouse' ? 'selected' : ''}>Spouse</option>
                                    <option value="Child" ${editItem?.relationship === 'Child' ? 'selected' : ''}>Child</option>
                                    <option value="Parent" ${editItem?.relationship === 'Parent' ? 'selected' : ''}>Parent</option>
                                    <option value="Sibling" ${editItem?.relationship === 'Sibling' ? 'selected' : ''}>Sibling</option>
                                    <option value="Other" ${editItem?.relationship === 'Other' ? 'selected' : ''}>Other</option>
                                </select>
                            </div>
                            <div class="col-md-12 mb-3">
                                <label class="form-label fw-bold">Date of Birth</label>
                                <input type="date" class="form-control" id="birth_date" name="birth_date" required value="${editItem?.birth_date || ''}">
                            </div>
                        `;
                    }

                    if (crudModal) {
                        crudModal.show();
                    }
                };
            }

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

                // Special handling for previewApplication - call loadPreview instead of API fetch
                if (section === 'previewApplication') {
                    if (typeof loadPreview === 'function') {
                        loadPreview();
                    } else {
                        const previewSection = document.querySelector('section[data-step-content="previewApplication"]');
                        if (previewSection) {
                            previewSection.innerHTML = '<div class="alert alert-warning">Preview functionality not loaded. Please refresh the page.</div>';
                        }
                    }
                    return; // Skip API fetch for previewApplication
                }

                // Add event listeners for buttons in the section
                if (section === 'educationTraining') {
                    const btnAddEducation = document.getElementById('btnAddEducation');
                    if (btnAddEducation) {
                        btnAddEducation.addEventListener('click', () => { if (typeof window.openEducationModal === 'function') window.openEducationModal(); });
                    }
                } else if (section === 'professionalMembership') {
                    const btnAddMembership = document.getElementById('btnAddMembership');
                    if (btnAddMembership) {
                        btnAddMembership.addEventListener('click', () => { if (typeof window.openMembershipModal === 'function') window.openMembershipModal(); });
                    }
                } else if (section === 'employmentHistory') {
                    const btnAddEmployment = document.getElementById('btnAddEmployment');
                    if (btnAddEmployment) {
                        btnAddEmployment.addEventListener('click', () => { if (typeof window.openEmploymentModal === 'function') window.openEmploymentModal(); });
                    }
                } else if (section === 'documents') {
                    const btnAddDocument = document.getElementById('btnAddDocument');
                    if (btnAddDocument) {
                        btnAddDocument.addEventListener('click', () => { if (typeof window.openDocumentModal === 'function') window.openDocumentModal(); });
                    }
                } else if (section === 'referee') {
                    const btnAddReferee = document.getElementById('btnAddReferee');
                    if (btnAddReferee) {
                        btnAddReferee.addEventListener('click', () => { if (typeof window.openRefereeModal === 'function') window.openRefereeModal(); });
                    }
                } else if (section === 'dependants') {
                    const btnAddDependant = document.getElementById('btnAddDependant');
                    if (btnAddDependant) {
                        btnAddDependant.addEventListener('click', () => { if (typeof window.openDependantModal === 'function') window.openDependantModal(); });
                    }
                }

                // Load data for the section if API is available
                if (typeof window.API !== 'undefined') {
                    // Map section names to API endpoints
                    const apiUrl = 'http://192.168.32.215:8041/api/v1';
                    let user = null;
                    try { user = JSON.parse(localStorage.getItem('user')); } catch {}
                    const userId = user && user.id ? user.id : 1;
                    const sectionApiMap = {
                        personalDetails: API.personalDetails ? API.personalDetails : null,
                        educationTraining: API.educationTraining,
                        professionalMembership: API.professionalMembership,
                        employmentHistory: API.employmentHistory,
                        documents: API.documents,
                        referee: API.referee,
                        dependants: API.dependants,
                        previewApplication: `${apiUrl}/applications/${userId}`,
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
                                if (res.ok && contentType && contentType.includes('application/json')) {
                                    return res.json();
                                } else if (!res.ok) {
                                    // API error (e.g. 500), try to get text and show a user-friendly error
                                    const text = await res.text();
                                    throw new Error('Server error (' + res.status + '). Please try again later.');
                                } else {
                                    // Not JSON, but not an error code
                                    const text = await res.text();
                                    throw new Error('API did not return JSON.');
                                }
                            })
                            .then(data => {
                                console.log('Loaded data for', section, data);
                                // Populate forms with data if available
                                populateSectionData(section, data);
                            })
                            .catch(err => {
                                // Show error in previewApplication section if that's the section
                                if (section === 'previewApplication') {
                                    const previewSection = document.querySelector('section[data-step-content="previewApplication"]');
                                    if (previewSection) {
                                        previewSection.innerHTML = `<div class='alert alert-danger'>Failed to load application preview.<br>${err.message}</div>`;
                                    }
                                } else {
                                    const mainContent = document.getElementById('mainContent');
                                    if (mainContent) {
                                        mainContent.innerHTML = `<div class='alert alert-danger'>Failed to load data for <b>${section}</b>.<br>${err.message}</div>`;
                                    }
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

            // Load jobs into homepage alert
            if (typeof loadHomepageJobs === 'function') {
                // console.log('Loading homepage jobs...');
                loadHomepageJobs();
            }
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




<script>
document.addEventListener('DOMContentLoaded', async function() {
    // API configuration
    const apiUrl = 'http://192.168.32.215:8041/api/v1';
    let jobsCache = [];

    // Toast notification function
    function showToast(message, type = 'info') {
        const toastContainer = document.getElementById('toastContainer');
        const toastId = 'toast-' + Date.now();
        const toastHTML = `
            <div id="${toastId}" class="toast" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header ${type}">
                    <strong class="me-auto">${type.charAt(0).toUpperCase() + type.slice(1)}</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">${message}</div>
            </div>
        `;
        toastContainer.insertAdjacentHTML('beforeend', toastHTML);
        const toastEl = document.getElementById(toastId);
        const bsToast = new bootstrap.Toast(toastEl, { autohide: true, delay: 4000 });
        bsToast.show();
        toastEl.addEventListener('hidden.bs.toast', () => toastEl.remove());
    }

    // Fetch jobs from API
    async function loadJobs() {
        const jobsListContainer = document.getElementById('jobsList');
        const loadingSpinner = document.getElementById('jobsLoading');

        try {
            const response = await axios.get(`${apiUrl}/positions`);
            
            // Handle response - check if data exists
            let jobs = [];
            if (response.data && Array.isArray(response.data)) {
                jobs = response.data;
            } else if (response.data && response.data.data && Array.isArray(response.data.data)) {
                jobs = response.data.data;
            }

            // Debug: Log the first job to see its structure
            if (jobs.length > 0) {
                console.log('Sample job data:', jobs[0]);
                console.log('Available fields:', Object.keys(jobs[0]));
            }

            // Cache jobs for modal use
            jobsCache = jobs;

            // Hide loading spinner
            if (loadingSpinner) loadingSpinner.style.display = 'none';

            if (jobs.length === 0) {
                jobsListContainer.innerHTML = '<div class="col-12 text-center"><p class="text-muted">No jobs available at the moment.</p></div>';
                return;
            }

            // Clear container and render job cards
            jobsListContainer.innerHTML = '';
            jobs.forEach(job => {
                // Get job title with multiple fallbacks
                const jobTitle = job.title || job.position_title || job.name || job.position_name || job.job_title || 'Untitled Position';
                
                const jobCard = `
                    <div class="col-md-6 col-lg-4 mb-4">
                        <div class="card h-100 shadow-sm border-0">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title text-primary mb-auto">${jobTitle}</h5>
                                <button class="btn btn-primary w-100 mt-3" data-job-id="${job.id}" data-bs-toggle="modal" data-bs-target="#jobDetailsModal">
                                    Apply
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                jobsListContainer.insertAdjacentHTML('beforeend', jobCard);
            });

            // Add click event listeners to all apply buttons
            attachApplyButtonListeners();

        } catch (error) {
            console.error('Error loading jobs:', error);
            if (loadingSpinner) loadingSpinner.style.display = 'none';
            jobsListContainer.innerHTML = '<div class="col-12 text-center"><p class="text-danger">Failed to load job openings. Please try again later.</p></div>';
            showToast('Failed to load job openings from server.', 'error');
        }
    }

    // Attach event listeners to apply buttons
    function attachApplyButtonListeners() {
        document.querySelectorAll('[data-job-id]').forEach(button => {
            button.addEventListener('click', function(e) {
                const jobId = this.getAttribute('data-job-id');
                const job = jobsCache.find(j => j.id == jobId);
                
                if (job) {
                    displayJobDetails(job);
                }
            });
        });
    }

    // Display job details in modal
    function displayJobDetails(job) {
        // Update modal title
        document.getElementById('jobDetailsModalLabel').textContent = job.title || job.position_title || 'Job Details';
        
        // Parse responsibilities and qualifications if they are JSON strings
        let responsibilities = [];
        let qualifications = [];
        
        try {
            if (typeof job.responsibilities === 'string') {
                responsibilities = JSON.parse(job.responsibilities);
            } else if (Array.isArray(job.responsibilities)) {
                responsibilities = job.responsibilities;
            }
        } catch (e) {
            responsibilities = job.responsibilities ? [job.responsibilities] : [];
        }

        try {
            if (typeof job.qualifications === 'string') {
                qualifications = JSON.parse(job.qualifications);
            } else if (Array.isArray(job.qualifications)) {
                qualifications = job.qualifications;
            }
        } catch (e) {
            qualifications = job.qualifications ? [job.qualifications] : [];
        }

        // Format date
        const formatDate = (dateStr) => {
            if (!dateStr) return 'Not specified';
            const date = new Date(dateStr);
            return date.toLocaleDateString('en-US', { year: 'numeric', month: 'long', day: 'numeric' });
        };

        // Build modal body content
        let content = `
            <div class="mb-4">
                <div class="row g-3">
                    <div class="col-md-4">
                        <h6 class="text-primary mb-2"><i class="bi bi-geo-alt-fill me-1"></i> Location</h6>
                        <p class="mb-0">${job.location || job.work_location || 'Not specified'}</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-primary mb-2"><i class="bi bi-clock-fill me-1"></i> Employment Type</h6>
                        <p class="mb-0">${job.employment_type || job.type || 'Full Time'}</p>
                    </div>
                    <div class="col-md-4">
                        <h6 class="text-primary mb-2"><i class="bi bi-calendar-event me-1"></i> Posted Date</h6>
                        <p class="mb-0">${formatDate(job.created_at || job.posted_date)}</p>
                    </div>
                </div>
                ${job.deadline || job.application_deadline ? `
                <div class="alert alert-info mt-3">
                    <i class="bi bi-info-circle me-2"></i>
                    <strong>Application Deadline:</strong> ${formatDate(job.deadline || job.application_deadline)}
                </div>
                ` : ''}
            </div>

            <hr>

            ${job.description ? `
            <div class="mb-4">
                <h6 class="text-primary fw-bold mb-3">
                    <i class="bi bi-file-text me-2"></i>Job Description
                </h6>
                <p>${job.description}</p>
            </div>
            ` : ''}

            ${responsibilities.length > 0 ? `
            <div class="mb-4">
                <h6 class="text-primary fw-bold mb-3">
                    <i class="bi bi-list-check me-2"></i>Key Responsibilities
                </h6>
                <ul class="list-group list-group-flush">
                    ${responsibilities.map(resp => `<li class="list-group-item">${resp}</li>`).join('')}
                </ul>
            </div>
            ` : ''}

            ${qualifications.length > 0 ? `
            <div class="mb-4">
                <h6 class="text-primary fw-bold mb-3">
                    <i class="bi bi-mortarboard me-2"></i>Required Qualifications
                </h6>
                <ul class="list-group list-group-flush">
                    ${qualifications.map(qual => `<li class="list-group-item">${qual}</li>`).join('')}
                </ul>
            </div>
            ` : ''}
        `;
        
        document.getElementById('jobDetailsModalBody').innerHTML = content;

        // Store job ID in apply button for later use
        const applyBtn = document.getElementById('btnApplyFromModal');
        if (applyBtn) {
            applyBtn.setAttribute('data-job-id', job.id);
        }
    }

    // Initialize - Load jobs from API
    await loadJobs();
});
</script>
    </div>
</div>
@endsection