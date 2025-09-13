<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicants;
use Illuminate\Support\Facades\Auth;

class ApplicantCoverLetterController extends Controller
{
    /**
     * Store or update cover letter PDF for the logged-in applicant.
     */
    public function update(Request $request)
    {
        $request->validate([
            'cover_letter' => 'nullable|file|mimes:pdf|max:10240', // max 10 MB
        ]);

        $applicant = Applicants::where('user_id', Auth::id())->firstOrFail();

        if ($request->hasFile('cover_letter')) {
            $file = $request->file('cover_letter');

        // Check size: 64KB = 65536 bytes
        if ($file->getSize() > 65536) {
            return redirect()->route('profile.page')->with('error', 'Cover letter file too large. Maximum 64 KB allowed.');
        }
        
            $pdfContent = file_get_contents($request->file('cover_letter')->getRealPath());
            $applicant->cover_letter = $pdfContent;
            $applicant->save();

            return redirect()->route('profile.page')->with('success', 'Cover letter uploaded/updated successfully.');
        }

        return redirect()->route('profile.page')->with('error', 'No cover letter file uploaded.');
    }

    /**
     * View cover letter in browser.
     */
    public function view()
    {
        $applicant = Applicants::where('user_id', Auth::id())->firstOrFail();

        if (!$applicant->cover_letter) {
            return redirect()->route('profile.page')->with('error', 'No cover letter uploaded.');
        }

        return response($applicant->cover_letter)
            ->header('Content-Type', 'application/pdf');
    }

    /**
     * Download cover letter PDF.
     */
    public function download()
    {
        $applicant = Applicants::where('user_id', Auth::id())->firstOrFail();

        if (!$applicant->cover_letter) {
            return redirect()->route('profile.page')->with('error', 'No cover letter uploaded.');
        }

        return response($applicant->cover_letter)
            ->header('Content-Type', 'application/pdf')
            ->header('Content-Disposition', 'attachment; filename="cover_letter.pdf"');
    }
}
