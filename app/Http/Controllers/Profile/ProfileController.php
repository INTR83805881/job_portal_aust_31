<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicants;
use App\Models\Organizations;

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
            'resume' => 'nullable|string|max:255',
            'cover_letter' => 'nullable|string|max:255',
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
        $applicant = Applicants::where('user_id', $request->user()->id)->firstOrFail();

        $field = $request->input('field');
        $value = $request->input('value');

        $rules = [
            'address' => 'required|string|max:255',
            'qualification' => 'required|string|max:255',
            'resume' => 'nullable|string|max:255',
            'cover_letter' => 'nullable|string|max:255',
        ];

        if (!array_key_exists($field, $rules)) {
            return back()->with('error', 'Invalid field.');
        }

        $request->validate([
            'value' => $rules[$field]
        ]);

        $applicant->update([$field => $value]);

        return redirect()->route('profile.page')->with('success', ucfirst(str_replace('_',' ',$field)) . ' updated!');
    }

    public function updateOrganization(Request $request)
    {
        $organization = Organizations::where('user_id', $request->user()->id)->firstOrFail();

        $field = $request->input('field');
        $value = $request->input('value');

        $rules = [
            'company_name' => 'required|string|max:255',
            'address' => 'required|string|max:255',
        ];

        if (!array_key_exists($field, $rules)) {
            return back()->with('error', 'Invalid field.');
        }

        $request->validate([
            'value' => $rules[$field]
        ]);

        $organization->update([$field => $value]);

        return redirect()->route('profile.page')->with('success', ucfirst(str_replace('_',' ',$field)) . ' updated!');
    }
}
