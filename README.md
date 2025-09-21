# 🎯 Job Axis

_Job Axis_ is an intelligent, web-based job portal built with Laravel 10 using the MVC architecture. It bridges the gap between job seekers and employers by streamlining the hiring process and reducing friction using smart features and a user-focused design. Tailored to provide efficient job discovery and posting, Job Axis is built for a seamless recruitment experience.

---

## 📌 Project Overview

Job Axis aims to simplify the job hunting and hiring process by offering a unified platform where:

-   _Employers_ can create detailed job posts, manage listings, and review applicants.
-   _Applicants_ can explore relevant job opportunities, apply, and track their application statuses.

Planned AI integration will bring intelligent job matching and resume filtering, ensuring the right talent meets the right opportunity.

---

## Deployed Site

[JobAxis Website](https://jobportalaust31-production.up.railway.app/)

---


## Repository Link

[https://github.com/INTR83805881/job_portal_aust_31.git](https://github.com/INTR83805881/job_portal_aust_31.git)

---

## 🧩 Core Features

### 🔍 AI-Powered Job Matching (Planned)

Future integration of machine learning models to provide personalized job suggestions based on user behavior, profile data, and historical applications.

### 👤 Role-Based Dashboards

-   _Job Seekers_: Access personalized job recommendations, application status, saved jobs, and manage profile including skillsets and multiple contact infos.
-   _Employers_: Post new jobs, view applicants, manage job listings, and include required skillsets for each job.

### 📝 Job Management System

-   Employers can create, update, and manage job postings.
-   Jobs can be categorized, filtered by skillset, and marked as active/expired.
-   Employers can specify required skillsets for each job.

### 🧑‍💼 Application System

-   Users can apply to jobs directly via their dashboard.
-   Add jobs to a "saved cart" to revisit later.
-   Track application history and status in real-time.

### 📂 Profile & Resume Management

-   Applicants can build and manage detailed profiles.
-   Include multiple emails and phone numbers.
-   Upload resumes and CVs in PDF format (up to 64KB).
-   Uploaded resumes can be viewed and downloaded by applicants and organizations if the applicant applies for a job.
-   Applicants can specify their skillsets.

### 🏗 Job Handover & Feedback

-   Applicants can submit work for appointed jobs via URL.
-   Organizations can provide feedback and ratings.
-   Feedback and ratings are viewable even after job completion.

### 🔒 Secure Authentication & Access Control

-   Role-based login (Applicant/Employer/Admin).
-   Secure session handling and data encryption via Laravel's built-in security tools.

### 🌐 Responsive Design

-   Fully optimized for mobile, tablet, and desktop views.
-   Built using _Laravel Blade_ with _Tailwind CSS_ for a modern and clean interface.

---

## 🧱 System Architecture

_MVC Pattern_  
Laravel 10’s MVC (Model-View-Controller) structure ensures maintainability and scalability.

### Key Database Tables:

-   **users** – Handles authentication and role management.
-   **organizations** – Linked to users via user_id; contains employer-specific data.
-   **applicants** – Linked to users via user_id; stores job seeker profiles.
-   **jobs** – Posted by organizations; includes job details, required skillsets, and deadlines.
-   **applications** – Records job applications made by applicants.
-   **skills** – Contains skillsets for Jobs posted and Applicant users.
-   **work_submits** - URL of submitted work by applicants for jobs they are currently hired for/completed jobs.<br>Also contains feedbacks and ratings given by Organizations

---

## 🛠️ Technologies Used

-   _Backend_: Laravel (PHP Framework)
-   _Database_: phpMyAdmin (MySQL)
-   _Frontend_: Laravel Blade
-   _Authentication_: Laravel Breeze / Sanctum (or Passport)
-   _Styling_: Tailwind CSS / Bootstrap
-   _AI Integration_: (Planned) Machine Learning models for job matching
    <br><br>

---

## 🚀 Features Overview by Role

| Feature                 | Applicants | Organizations |
| ----------------------- | ---------- | ------------- |
| View Job Listings       | ✅         | ✅            |
| Apply to Jobs           | ✅         | ❌            |
| Save Jobs to Cart       | ✅         | ❌            |
| Post New Jobs           | ❌         | ✅            |
| Manage Job Listings     | ❌         | ✅            |
| View Applicant Profiles | ❌         | ✅            |
| Manage Personal Profile | ✅         | ✅            |
| Dashboard with Insights | ✅         | ✅            |

<b>\*Key Note: </b> Applicants can view their own profiles

---

## 📚 Project Structure

```bash
job-axis/
├── app/                  #Backend files
│   ├── Http/
│   │   ├── Controllers/
│   │   └── Middleware/
│   ├── Models/
│   └── Providers/
│
├── bootstrap/
│
├── config/
│
├── database/
│   ├── migrations/
│   ├── factories/
│   └── seeders/
│
├── public/
├── resources/
│   ├── views/            # Blade templates(frontend)
│   └── css/js/
│
├── routes/
│   └── web.php            # Route definitions
│
├── Dockerfile
├── docker-compose.yml
│
├── tests/
└── README.md

```

<br>

---

# Group Members/Collaboratos

**Members:**<br>

-   Jabin Tasnim **(20220204058)**<br> [Jabin's WakaTime](https://wakatime.com/@jabin03/projects/eiguabqmbp?start=2025-07-21&end=2025-07-27)
-   Faiad Nakib **(20220204080)**<br> [Faiad's WakaTime](https://wakatime.com/@7d570a56-773f-4e49-8d78-0b0803fea282/projects/cotjcdyaqo?start=2025-07-20&end=2025-07-26)

-   Sadeed Rahman **(20220204081)**<br> [Sadeed's WakaTime](https://wakatime.com/@3764e15a-69bc-4b7d-ad15-f837a011962c/projects/luymrtwjba?start=2025-09-14&end=2025-09-20)

-   Ariyan Islam Abir **(20220204083)**<br> [Abir's WakaTime](https://wakatime.com/@77b92341-2c76-4833-925d-42b65958bf2f/projects/kgfjntkwgp?start=2025-09-14&end=2025-09-20)

-   Sadia Hossain Sneha **(20220204105)**<br> [Sneha's WakaTime](https://wakatime.com/@e64e0191-1b2e-425f-ba14-2b490a79e474/projects/eqwhnfxilm?start=2025-09-14&end=2025-09-20)

<br><br>

---

## 🎨 UI/UX Concept (Figma Design)

Designed with user accessibility and simplicity in mind, _Job Axis_ follows a clean, modern interface pattern that ensures both employers and applicants can navigate the system effortlessly.

🔗 [View Full Figma Design – Job Portal Application](https://www.figma.com/make/0LyGzxitBmQ9GJ6LV52d8a/Job-Portal-Application?node-id=0-1&p=f&t=AV7PVaUiNfiQpVKw-0)

---

## 🎨 Core Pages

### 🏠 Home Page

The homepage is designed to immediately engage visitors with a filter bars for quick job lookups and a display of _featured job listings_. It provides easy access to login/registration and showcases the platform's purpose clearly through concise CTAs (Call-to-Actions).

### 💼 Available Jobs Page

This page lists all active job openings with smart filters that let users sort by:

-   Job type (full-time, part-time, internship)
-   Job Title
-   Required skills
-   Org Details
-   Location

It allows applicants to save jobs to a cart or apply directly from the listing, providing an intuitive browsing experience.

### 📝 Job Applications Page

Organizations can view all applicants for their posted jobs. Features include:

-   Viewing applicant details and resumes
-   Accepting or rejecting applicants
-   Tracking application statuses in real-time

### 📂 Current Jobs Page

Displays jobs for which applicants have been hired. Organizations can:

-   Monitor ongoing projects
-   Access applicant submissions
-   Track progress of assigned tasks

### ✏️ Edit Jobs Page

Allows organizations to update job details, including:

-   Job description and title
-   Required skills
-   Job type and status (enlisted/in_progress/completed)

### 📤 Work Submission Page

Applicants can submit their completed work for assigned jobs via URL or file upload. Features include:

-   Clear submission interface
-   Guidelines for proper work submission
-   Timestamped submissions for tracking

### ✅ Submitted Work Check Page

Organizations can review submitted works, provide:

-   Feedback
-   Ratings
-   Approval or revision requests

Submitted work history remains accessible even after job completion.

### 👤 Profile Page

Applicants and organizations can fill out or edit their profiles, including:

-   Personal and contact information (multiple emails and phone numbers)
-   Skillsets
-   Uploaded resumes or CVs (PDF, up to 64KB)
-   Profile picture and other relevant details

### 🎉 Finished Works Page

Displays completed jobs with:

-   Applicant submissions
-   Organization feedback and ratings
-   Permanent record for both parties to view past completed projects

### 📬 Contact Page

The contact page enables users to get in touch with the development/admin team. The layout includes:

-   A secure contact form
-   Support-related contact information
-   A simple and clean interface for reporting issues or sending feedback

### 🧑‍💼 About Us Page

This page shares details about the team behind Job Axis, project motivation, and vision for future development. It's aimed at building trust and giving users a behind-the-scenes look at the creators.

### 🔐 Login/Registration Pages

Both login and sign-up pages are cleanly structured to ensure quick access:

-   Minimalist form layout
-   Role-based registration (Applicant or Employer)
-   Secure password fields and validation feedback

---

## Setup Guidelines(For running locally)

```bash
# Clone the repository
git clone <repo-url>

# Install dependencies
composer install
npm install

# Setup environment variables
cp .env.example .env

# Edit .env as needed

# Install vite dependencies(For vite implementation in Blade)
npm run build

#Migrating Database tables
php artisan migrate

# Run backend server
php artisan serve

#Launch site
http://localhost:8000
```

## Deployment Status & Tests

| Component       | Is Deployed? | Is Dockerized? | Unit Tests Added? (Optional) | Is AI feature implemented? (Optional) |
| --------------- | ------------ | -------------- | ---------------------------- | ------------------------------------- |
| Backend         | Yes          | Yes            | No                           | No                                    |
| Frontend(Blade) | Yes          | Yes            | Yes                          | No                                    |
