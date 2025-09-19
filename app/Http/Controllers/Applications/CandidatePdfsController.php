<?php

namespace App\Http\Controllers\Applications;

use App\Http\Controllers\Controller;
use App\Models\Applicants;
use Illuminate\Support\Facades\Response;

class CandidatePdfsController extends Controller
{
    public function viewResume($applicantId)
    {
        $applicant = Applicants::findOrFail($applicantId);

        if (!$applicant->resume) {
            return back()->with('error', 'Resume not found.');
        }

        return Response::make($applicant->resume, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="resume.pdf"'
        ]);
    }

    public function downloadResume($applicantId)
    {
        $applicant = Applicants::findOrFail($applicantId);

        if (!$applicant->resume) {
            return back()->with('error', 'Resume not found.');
        }

        return Response::make($applicant->resume, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="resume.pdf"'
        ]);
    }

    public function viewCoverLetter($applicantId)
    {
        $applicant = Applicants::findOrFail($applicantId);

        if (!$applicant->cover_letter) {
            return back()->with('error', 'Cover letter not found.');
        }

        return Response::make($applicant->cover_letter, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="cover_letter.pdf"'
        ]);
    }

    public function downloadCoverLetter($applicantId)
    {
        $applicant = Applicants::findOrFail($applicantId);

        if (!$applicant->cover_letter) {
            return back()->with('error', 'Cover letter not found.');
        }

        return Response::make($applicant->cover_letter, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'attachment; filename="cover_letter.pdf"'
        ]);
    }
}
