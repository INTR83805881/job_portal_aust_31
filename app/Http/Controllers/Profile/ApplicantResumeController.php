<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicants;
use Illuminate\Support\Facades\Auth;

class ApplicantResumeController extends Controller
{
    /**
     * Store or update resume PDF for the logged-in applicant.
     */
    public function update(Request $request)
    {
        $request->validate([
            'resume' => 'nullable|file|mimes:pdf|max:10240', // max 10 MB
        ]);

        $applicant = Applicants::where('user_id', Auth::id())->firstOrFail();

        if ($request->hasFile('resume')) {
            $file = $request->file('resume');

            

        // Check size: 64KB = 65536 bytes
        if ($file->getSize() > 65536) {
            return redirect()->route('profile.page')->with('error', 'Cover letter file too large. Maximum 64 KB allowed.');
        }

            $pdfContent = file_get_contents($request->file('resume')->getRealPath());
            $applicant->resume = $pdfContent;
            $applicant->save();

            return redirect()->route('profile.page')->with('success', 'Resume uploaded/updated successfully.');
        }

        return redirect()->route('profile.page')->with('error', 'No resume file uploaded.');
    }

    /**
     * View resume in browser.
     */
    public function view()
    {
        $applicant = Applicants::where('user_id', Auth::id())->firstOrFail();

        if (!$applicant->resume) {
            return redirect()->route('profile.page')->with('error', 'No resume uploaded.');
        }

        return response($applicant->resume)
            ->header('Content-Type', 'application/pdf');
    }

    /**
     * Download resume PDF.
     */
    public function download()
    {
        $applicant = Applicants::where('user_id', Auth::id())->firstOrFail();

        if (!$applicant->resume) {
            return redirect()->route('profile.page')->with('error', 'No resume uploaded.');
        }

        return response($applicant->resume)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="resume.pdf"');
    }
}
