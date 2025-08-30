@extends('layouts.app')

@section('content')
<div class="container">
    <h1 class="mb-4">Available Jobs</h1>

    {{-- Filters --}}
    <div id="filters" class="mb-3 row g-2">
        <div class="col-md-2">
            <input type="number" id="jobId" class="form-control" placeholder="Job ID">
        </div>
        <div class="col-md-2">
            <input type="text" id="title" class="form-control" placeholder="Job Title">
        </div>
       <!-- <div class="col-md-2">
            <input type="text" id="salary" class="form-control" placeholder="Salary">
        </div> -->
        <div class="col-md-2">
            <select id="jobType" class="form-select">
                <option value="">All Types</option>
                <option value="full-time">Full-time</option>
                <option value="part-time">Part-time</option>
                <option value="contract">Contract</option>
                <option value="internship">Internship</option>
            </select>
        </div>
        <div class="col-md-2">
            <input type="number" id="organizationId" class="form-control" placeholder="Organization ID">
        </div>
        <div class="col-md-2">
            <button id="applyFilters" class="btn btn-primary w-100">Apply Filters</button>
        </div>
    </div>

    {{-- Jobs list --}}
    <div id="job-list" class="row"></div>

    {{-- Pagination --}}
    <nav>
        <ul id="pagination" class="pagination mt-3"></ul>
    </nav>
</div>

<script>
const jobList = document.getElementById('job-list');
const pagination = document.getElementById('pagination');
const applyFilters = document.getElementById('applyFilters');

let currentPage = 1;
let filters = {};

function fetchJobs(page = 1) {
    let query = `?page=${page}`;
    for (const key in filters) {
        if (filters[key]) {
            query += `&${encodeURIComponent(key)}=${encodeURIComponent(filters[key])}`;
        }
    }

    fetch(`/api/v1/jobs${query}`)
        .then(res => res.json())
        .then(data => {
            jobList.innerHTML = '';
            data.data.forEach(job => {
                jobList.innerHTML += `
                    <div class="col-md-6 mb-3">
                        <div class="card p-3">
                            <p><strong>Job ID:</strong> ${job.id}</p>
                            <p><strong>Title:</strong> ${job.jobTitle}</p>
                            <p><strong>Company:</strong> ${job.companyName || 'N/A'}</p>
                            <p><strong>Location:</strong> ${job.location || 'N/A'}</p>
                            <p><strong>Type:</strong> ${job.jobType || 'N/A'}</p>
                            <p><strong>Salary:</strong> ${job.salary || 'N/A'}</p>
                        </div>
                    </div>
                `;
            });

            // Pagination
            pagination.innerHTML = '';
            const totalPages = data.meta.last_page;
            for (let i = 1; i <= totalPages; i++) {
                pagination.innerHTML += `
                    <li class="page-item ${i === data.meta.current_page ? 'active' : ''}">
                        <a class="page-link" href="#" onclick="fetchJobs(${i})">${i}</a>
                    </li>
                `;
            }
        });
}

// Apply filters
applyFilters.addEventListener('click', () => {
    filters = {};

    const jobId = document.getElementById('jobId').value;
    const title = document.getElementById('title').value;
    //const salary = document.getElementById('salary').value;
    const type = document.getElementById('jobType').value;
    const organizationId = document.getElementById('organizationId').value;

    if (jobId) filters['id[eq]'] = jobId;
    if (title) filters['jobTitle[like]'] = title;
    //if (salary) filters['salary[like]'] = salary;
    if (type) filters['jobType[eq]'] = type;
    if (organizationId) filters['organizationId[eq]'] = organizationId; // Organization ID filter

    fetchJobs(1);
});

// Initial fetch
fetchJobs(currentPage);
</script>
@endsection
