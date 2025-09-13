<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicants;
use App\Models\Organizations;

// Import sub-controllers
use App\Http\Controllers\Profile\ApplicantResumeController;
use App\Http\Controllers\Profile\ApplicantCoverLetterController;

class ProfileController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $applicant = null;
        $organization = null;
        $contacts = collect();

        if ($user->role === 'applicant') {
            $applicant = Applicants::where('user_id', $user->id)->first();
            if ($applicant) {
                $contacts = $applicant->contacts;
            }
        }

        if ($user->role === 'organization') {
            $organization = Organizations::where('user_id', $user->id)->first();
            if ($organization) {
                $contacts = $organization->contacts;
            }
        }

        return view('profile_page.index', compact('user', 'applicant', 'organization', 'contacts'));
    }

    public function storeApplicant(Request $request)
    {
        $validated = $request->validate([
            'address' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();

        Applicants::create($validated);

        return redirect()->route('profile.page')->with('success', 'Applicant profile created!');
    }

    public function storeOrganization(Request $request)
    {
        $validated = $request->validate([
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ]);

        $validated['user_id'] = auth()->id();

        Organizations::create($validated);

        return redirect()->route('profile.page')->with('success', 'Organization profile created!');
    }

    public function updateApplicant(Request $request)
    {
        $applicant = Applicants::where('user_id', auth()->id())->firstOrFail();

        $field = $request->input('field');

        // Delegate resume or cover letter to sub-controllers
        if ($field === 'resume') {
            $controller = new ApplicantResumeController();
            return $controller->update($request);
        }

        if ($field === 'cover_letter') {
            $controller = new ApplicantCoverLetterController();
            return $controller->update($request);
        }

        // Normal field updates
        $value = $request->input('value');
        $rules = [
            'address' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
        ];

        if (!array_key_exists($field, $rules)) {
            return back()->with('error', 'Invalid field.');
        }

        $request->validate(['value' => $rules[$field]]);
        $applicant->update([$field => $value]);

        return redirect()->route('profile.page')->with('success', ucfirst(str_replace('_',' ',$field)) . ' updated!');
    }

    public function updateOrganization(Request $request)
    {
        $organization = Organizations::where('user_id', auth()->id())->firstOrFail();

        $field = $request->input('field');
        $value = $request->input('value');

        $rules = [
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ];

        if (!array_key_exists($field, $rules)) {
            return back()->with('error', 'Invalid field.');
        }

        $request->validate(['value' => $rules[$field]]);
        $organization->update([$field => $value]);

        return redirect()->route('profile.page')->with('success', ucfirst(str_replace('_',' ',$field)) . ' updated!');
    }

    // Optional: view/download shortcuts via ProfileController
    public function viewResume()
    {
        $controller = new ApplicantResumeController();
        return $controller->view();
    }

    public function downloadResume()
    {
        $controller = new ApplicantResumeController();
        return $controller->download();
    }

    public function viewCoverLetter()
    {
        $controller = new ApplicantCoverLetterController();
        return $controller->view();
    }

    public function downloadCoverLetter()
    {
        $controller = new ApplicantCoverLetterController();
        return $controller->download();
    }
}
