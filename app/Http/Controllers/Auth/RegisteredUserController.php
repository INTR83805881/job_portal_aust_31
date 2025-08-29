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
use Illuminate\Support\Facades\Log;

use App\Http\Controllers\Api\V1\ApplicantsController;
use App\Http\Controllers\Api\V1\OrganizationsController;
use App\Http\Requests\V1\StoreApplicantsRequest;
use App\Http\Requests\V1\StoreOrganizationsRequest;


class RegisteredUserController extends Controller
{
      protected $applicantsController;
    protected $organizationsController;

    public function __construct(ApplicantsController $applicantsController, OrganizationsController $organizationsController)
    {
        $this->applicantsController = $applicantsController;
        $this->organizationsController = $organizationsController;
    }
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
    $request->validate([
        'name' => ['required', 'string', 'max:255'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'password' => ['required', 'confirmed', Rules\Password::defaults()],
        'role' => ['required', 'in:applicant,organization'],
    ]);

    $user = User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' => Hash::make($request->password),
        'role' => $request->role,
    ]);

    event(new Registered($user));
    Auth::login($user);

    return redirect(RouteServiceProvider::HOME);
}


}
