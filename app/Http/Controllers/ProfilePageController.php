<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Applicants;
use App\Models\Organizations;

class ProfilePageController extends Controller
{
    public function index(Request $request)
    {
        $user = $request->user();

        $applicant = null;
        $organization = null;

        if ($user->role === 'applicant') {
            $applicant = Applicants::where('user_id', $user->id)->first();
        }

        if ($user->role === 'organization') {
            $organization = Organizations::where('user_id', $user->id)->first();
        }

        return view('profile_page.index', compact('user', 'applicant', 'organization'));
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

        // Validate dynamically
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