<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Applicants;
use App\Models\Organizations;
use App\Models\Applicant_contacts;
use App\Models\Organization_contacts;

class ContactController extends Controller
{
    public function storeApplicantContact(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:phone,email',
            'value' => 'required|string|max:255',
        ]);

        $applicant = Applicants::where('user_id', auth()->id())->firstOrFail();
        $applicant->contacts()->create($validated);

        return redirect()->route('profile.page')->with('success', 'Contact added!');
    }

    public function updateApplicantContact(Request $request, $id)
    {
        $contact = Applicant_contacts::findOrFail($id);
        $applicant = Applicants::where('user_id', auth()->id())->firstOrFail();

        if ($contact->applicant_id !== $applicant->id) {
            return back()->with('error', 'Unauthorized action.');
        }

        $field = $request->input('field');
        $value = $request->input('value');

        $rules = [
            'type' => 'required|in:phone,email',
            'value' => 'required|string|max:255',
        ];

        if (!array_key_exists($field, $rules)) {
            return back()->with('error', 'Invalid field.');
        }

        $request->validate([
            'value' => $rules[$field]
        ]);

        $contact->update([$field => $value]);

        return redirect()->route('profile.page')->with('success', ucfirst(str_replace('_', ' ', $field)) . ' updated!');
    }

    public function storeOrganizationContact(Request $request)
    {
        $validated = $request->validate([
            'type' => 'required|in:phone,email',
            'value' => 'required|string|max:255',
        ]);

        $organization = Organizations::where('user_id', auth()->id())->firstOrFail();
        $organization->contacts()->create($validated);

        return redirect()->route('profile.page')->with('success', 'Contact added!');
    }

    public function updateOrganizationContact(Request $request, $id)
    {
        $contact = Organization_contacts::findOrFail($id);
        $organization = Organizations::where('user_id', auth()->id())->firstOrFail();

        if ($contact->organization_id !== $organization->id) {
            return back()->with('error', 'Unauthorized action.');
        }

        $field = $request->input('field');
        $value = $request->input('value');

        $rules = [
            'type' => 'required|in:phone,email',
            'value' => 'required|string|max:255',
        ];

        if (!array_key_exists($field, $rules)) {
            return back()->with('error', 'Invalid field.');
        }

        $request->validate([
            'value' => $rules[$field]
        ]);

        $contact->update([$field => $value]);

        return redirect()->route('profile.page')->with('success', ucfirst(str_replace('_', ' ', $field)) . ' updated!');
    }
}
