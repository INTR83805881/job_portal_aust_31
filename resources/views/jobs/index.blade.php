@extends('layouts.app')

@section('content')
<div class="max-w-6xl mx-auto px-4 py-8">
    <header class="mb-6">
        <h1 class="text-3xl md:text-4xl font-extrabold text-slate-900">Available Jobs</h1>
        <p class="text-sm text-slate-500 mt-1">Find open roles — use the filters to narrow results.</p>
    </header>

    {{-- Filters --}}
    <section class="bg-white border border-slate-100 rounded-lg shadow-sm p-4 mb-6">
        <div class="flex flex-wrap gap-3 items-end">
            <div class="flex-1 min-w-[150px]">
                <label for="jobId" class="block text-xs font-medium text-slate-600 mb-1">Job ID</label>
                <input id="jobId" type="number" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="Job ID">
            </div>

            <div class="flex-[2] min-w-[200px]">
                <label for="title" class="block text-xs font-medium text-slate-600 mb-1">Title</label>
                <input id="title" type="text" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="Job Title">
            </div>

            <div class="min-w-[140px]">
                <label for="jobType" class="block text-xs font-medium text-slate-600 mb-1">Type</label>
                <select id="jobType" class="w-full px-3 py-2 rounded-lg border border-slate-200 bg-white focus:outline-none focus:ring-2 focus:ring-indigo-200">
                    <option value="">All Types</option>
                    <option value="full-time">Full-time</option>
                    <option value="part-time">Part-time</option>
                    <option value="internship">Internship</option>
                </select>
            </div>

            <div class="min-w-[150px]">
                <label for="organizationId" class="block text-xs font-medium text-slate-600 mb-1">Organization ID</label>
                <input id="organizationId" type="number" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="Organization ID">
            </div>

            <div class="flex-1 min-w-[180px]">
                <label for="location" class="block text-xs font-medium text-slate-600 mb-1">Location</label>
                <input id="location" type="text" class="w-full px-3 py-2 rounded-lg border border-slate-200 focus:outline-none focus:ring-2 focus:ring-indigo-200" placeholder="City / Location">
            </div>

            <div class="flex gap-2 w-full sm:w-auto mt-2">
                <button id="applyFilters" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg bg-indigo-600 text-white text-sm font-medium hover:bg-indigo-700 transition">
                    Apply Filters
                </button>

                <button id="resetFilters" class="inline-flex items-center gap-2 px-4 py-2 rounded-lg border border-slate-200 text-sm text-slate-700 hover:bg-slate-50 transition">
                    Reset
                </button>
            </div>
        </div>
    </section>

    {{-- Jobs list --}}
    <section id="job-list" class="grid grid-cols-1 md:grid-cols-2 gap-6"></section>

    {{-- Pagination --}}
    <nav aria-label="Jobs pagination" class="mt-6">
        <ul id="pagination" class="flex flex-wrap justify-center items-center gap-2"></ul>
    </nav>
</div>

<script>
const jobList = document.getElementById('job-list');
const pagination = document.getElementById('pagination');
const applyFiltersBtn = document.getElementById('applyFilters');
const resetFiltersBtn = document.getElementById('resetFilters');
let currentPage = 1;
let perPage = 10;
let filters = {};

function escapeHtml(unsafe) {
    if (unsafe === null || unsafe === undefined) return '';
    return String(unsafe)
        .replaceAll('&', '&amp;')
        .replaceAll('<', '&lt;')
        .replaceAll('>', '&gt;')
        .replaceAll('"', '&quot;')
        .replaceAll("'", '&#039;');
}

async function fetchJobs(page = 1) {
    currentPage = page;
    const params = new URLSearchParams();
    params.set('page', page);
    params.set('per_page', perPage);
    params.set('includeJobSkillsets', 'true');

    for (const [k, v] of Object.entries(filters)) {
        if (v) params.set(k, v);
    }

    jobList.innerHTML = `<div class="col-span-1 md:col-span-2 bg-white p-6 rounded-lg shadow-sm text-center text-slate-500">Loading jobs...</div>`;
    pagination.innerHTML = '';

    try {
        const res = await fetch(`/api/v1/jobs?${params.toString()}`, { headers: { 'Accept': 'application/json' } });
        if (!res.ok) {
            let errText = res.statusText;
            try { const errJson = await res.json(); errText = errJson.message || JSON.stringify(errJson); } catch(e){}
            jobList.innerHTML = `<div class="col-span-1 md:col-span-2 bg-white p-6 rounded-lg shadow-sm text-center text-red-600">Error fetching jobs: ${escapeHtml(errText)}</div>`;
            return;
        }

        const payload = await res.json();
        renderJobs(payload.data || []);
        renderPagination(payload.meta || { total: 0, per_page: perPage, current_page: page, last_page: 1 });
    } catch (error) {
        jobList.innerHTML = `<div class="col-span-1 md:col-span-2 bg-white p-6 rounded-lg shadow-sm text-center text-red-600">Network error: ${escapeHtml(error.message)}</div>`;
    }
}

function renderJobs(jobs) {
    jobList.innerHTML = '';
    if (!jobs || jobs.length === 0) {
        jobList.innerHTML = `<div class="col-span-1 md:col-span-2 bg-white p-6 rounded-lg shadow-sm text-center text-slate-600">No jobs found.</div>`;
        return;
    }

    for (const job of jobs) {
        // Wrap entire card in a clickable link
        const link = document.createElement('a');
        link.href = `/jobs/view/${job.id}`;
        link.className = 'block';

        const col = document.createElement('div');
        col.className = 'bg-white rounded-lg p-5 shadow-sm hover:shadow-lg transition cursor-pointer';

        const company = job.companyName ?? job.organizationId ?? 'N/A';
        const title = job.title ?? '';
        const location = job.location ?? '';
        const type = job.employmentType ?? '';
        const salary = job.salary ?? 'Negotiable';
        const deadline = job.deadline ?? '';

        col.innerHTML = `
            <div class="flex justify-between items-start gap-3">
                <div class="min-w-0">
                    <h3 class="text-lg font-semibold text-slate-900">${escapeHtml(title)}</h3>
                    <p class="text-sm text-slate-500 mt-1">${escapeHtml(company)}</p>
                </div>
                <div class="text-right">
                    <span class="inline-block px-2 py-1 text-xs font-medium rounded bg-indigo-50 text-indigo-700">${escapeHtml(type)}</span>
                </div>
            </div>

            <div class="mt-3 text-sm text-slate-600">
                <p class="mb-1"><svg class="inline-block w-4 h-4 mr-1 -mt-0.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M17.657 16.657L13.414 12.414a4 4 0 10-1.414 1.414l4.243 4.243a8 8 0 111.414-1.414z"/></svg> ${escapeHtml(location || '—')}</p>
                <p class="mb-0"><svg class="inline-block w-4 h-4 mr-1 -mt-0.5 text-slate-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2"/></svg> ${escapeHtml(salary)}</p>
            </div>
        `;

        if (Array.isArray(job.jobSkillsets) && job.jobSkillsets.length > 0) {
            const skillsWrap = document.createElement('div');
            skillsWrap.className = 'mt-3 flex flex-wrap gap-2';
            for (const s of job.jobSkillsets) {
                const chip = document.createElement('span');
                chip.className = 'text-xs px-2 py-1 rounded-full bg-slate-100 text-slate-800';
                chip.textContent = s.skillName ?? 'skill';
                skillsWrap.appendChild(chip);
            }
            col.appendChild(skillsWrap);
        }

        const footer = document.createElement('div');
        footer.className = 'mt-4 flex items-center justify-between text-xs text-slate-400';
        footer.innerHTML = `<div>Job ID: ${escapeHtml(job.id ?? '')}</div><div>Deadline: ${escapeHtml(deadline)}</div>`;
        col.appendChild(footer);

        link.appendChild(col);
        jobList.appendChild(link);
    }
}

function renderPagination(meta) {
    pagination.innerHTML = '';
    const total = Number(meta.total || 0);
    const per = Number(meta.per_page || perPage);
    const current = Number(meta.current_page || currentPage);
    const last = Number(meta.last_page || Math.max(1, Math.ceil(total / per)));

    const createLi = (label, page, disabled=false, active=false) => {
        const li = document.createElement('li');
        const btn = document.createElement('button');
        btn.type = 'button';
        btn.className = 'px-3 py-1 rounded-md text-sm transition';
        if (active) btn.className += ' bg-indigo-600 text-white';
        else btn.className += ' bg-white border border-slate-200 text-slate-700 hover:shadow';
        if (disabled) { btn.className += ' opacity-50 pointer-events-none'; }
        btn.textContent = label;
        btn.addEventListener('click', (e) => { e.preventDefault(); if (!disabled) fetchJobs(page); });
        li.appendChild(btn);
        return li;
    };

    pagination.appendChild(createLi('Prev', Math.max(1, current - 1), current === 1));

    const maxButtons = 7;
    let start = Math.max(1, current - 2);
    let end = Math.min(last, start + maxButtons - 1);
    if (end - start + 1 < maxButtons) start = Math.max(1, end - maxButtons + 1);

    if (start > 1) {
        pagination.appendChild(createLi('1', 1));
        if (start > 2) {
            const gap = document.createElement('li');
            gap.innerHTML = `<span class="px-3 py-1 text-sm text-slate-500">…</span>`;
            pagination.appendChild(gap);
        }
    }

    for (let p = start; p <= end; p++) {
        pagination.appendChild(createLi(String(p), p, false, p === current));
    }

    if (end < last) {
        if (end < last - 1) {
            const gap = document.createElement('li');
            gap.innerHTML = `<span class="px-3 py-1 text-sm text-slate-500">…</span>`;
            pagination.appendChild(gap);
        }
        pagination.appendChild(createLi(String(last), last));
    }

    pagination.appendChild(createLi('Next', Math.min(last, current + 1), current === last));
}

applyFiltersBtn.addEventListener('click', () => {
    filters = {};
    const jobId = document.getElementById('jobId').value.trim();
    const title = document.getElementById('title').value.trim();
    const type = document.getElementById('jobType').value;
    const organizationId = document.getElementById('organizationId').value.trim();
    const location = document.getElementById('location').value.trim();

    if (jobId) filters['id[eq]'] = jobId;
    if (title) filters['jobTitle[like]'] = title;
    if (type) filters['jobType[eq]'] = type;
    if (organizationId) filters['organizationId[eq]'] = organizationId;
    if (location) filters['location[like]'] = location;

    fetchJobs(1);
});

resetFiltersBtn.addEventListener('click', () => {
    document.getElementById('jobId').value = '';
    document.getElementById('title').value = '';
    document.getElementById('jobType').value = '';
    document.getElementById('organizationId').value = '';
    document.getElementById('location').value = '';
    filters = {};
    fetchJobs(1);
});

fetchJobs();
</script>
@endsection
