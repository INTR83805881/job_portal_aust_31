<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\OrganizationCourse;
use App\Models\Organizations;
use App\Models\Applicants;

class OrganizationCourseController extends Controller
{
    /**
     * Display a listing of the courses.
     */
    public function index()
    {
        $courses = OrganizationCourse::with('organization', 'applicant')->get();
        return view('organization_courses.index', compact('courses'));
    }

    /**
     * Show the form for creating a new course.
     */
    public function create()
    {
        $organizations = Organizations::all();
        $applicants = Applicants::all();
        return view('organization_courses.create', compact('organizations', 'applicants'));
    }

    /**
     * Store a newly created course in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'applicant_id' => 'required|exists:applicants,id',
            'organization_id' => 'required|exists:organizations,id',
            'course_name' => 'required|string|max:255',
            'course_title' => 'required|string|max:255',
            'course_description' => 'required|string',
        ]);

        OrganizationCourse::create($request->all());

        return redirect()->route('organization_courses.index')
                         ->with('success', 'Course added successfully!');
    }

    /**
     * Handle course application.
     */
    public function apply(int $id)
    {
        $course = OrganizationCourse::findOrFail($id);

        // Example: mark as applied (make sure you have a column for this in your table)
        // $course->applied = true;
        // $course->save();

        return redirect()->back()->with('success', 'You applied for the course successfully!');
    }
}
