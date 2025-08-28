<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Applicants;
use App\Models\Organizations;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        // Validate common fields
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'role' => ['required', 'in:applicant,organization'],
        ]);

        // Create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Create related record based on role
        if ($user->role === 'applicant') {
            $request->validate([
                'address' => 'nullable|string',
                'qualification' => 'nullable|string',
                'resume' => 'nullable|file|mimes:pdf',
                'cover_letter' => 'nullable|file|mimes:pdf',
            ]);

            Applicants::create([
                'user_id' => $user->id,
                'address' => $request->address ?? '',
                'qualification' => $request->qualification ?? '',
                'resume' => $request->file('resume') ? $request->file('resume')->store('resumes', 'public') : null,
                'cover_letter' => $request->file('cover_letter') ? $request->file('cover_letter')->store('cover_letters', 'public') : null,
            ]);
        } elseif ($user->role === 'organization') {
            $request->validate([
                'company_name' => 'nullable|string',
                'org_address' => 'nullable|string',
            ]);

            Organizations::create([
                'user_id' => $user->id,
                'company_name' => $request->company_name ?? '',
                'address' => $request->org_address ?? '',
            ]);
        }

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
