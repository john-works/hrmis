@extends('layouts.public')

@section('content')

<!-- Toast Container -->
<div class="toast-container position-fixed top-0 end-0 p-3" id="toastContainer"></div>

<!-- Homepage Area -->
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
            <div class="modal-header bg-primary text-white">
                <h5 class="modal-title" id="jobDetailsModalLabel">Job Details</h5>
                <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="jobDetailsModalBody">
                <!-- Job details will be populated here -->
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-success" id="btnApplyFromModal">Apply for Job</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
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
                jobsListContainer.innerHTML = '<div class="col-12 text-center"><p class="text-muted">No job openings available at the moment.</p></div>';
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

@endsection
