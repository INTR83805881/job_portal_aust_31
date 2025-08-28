<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Applicant;
use App\Models\Organization;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    // Show register form
    public function showRegistrationForm()
    {
        return view('auth.register');
    }

    // Handle registration
    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'role' => ['required', 'in:applicant,organization'],
        ]);

        // Create user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => $request->role,
        ]);

        // Create related empty record
        if ($user->role === 'applicant') {
            Applicant::create([
                'user_id' => $user->id,
                'address' => '',
                'qualification' => '',
                'skills' => json_encode([]),
                'resume' => null,
                'cover_letter' => null,
            ]);
        } elseif ($user->role === 'organization') {
            Organization::create([
                'user_id' => $user->id,
                'company_name' => '',
                'address' => '',
            ]);
        }

        Auth::login($user);

        return redirect('/'); // redirect to home after signup
    }
}
