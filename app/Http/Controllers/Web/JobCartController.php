<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\JobCart;
use App\Models\Applicants;

class JobCartController extends Controller
{
    // Show jobs in cart
    public function index()
    {
        $user = Auth::user();

        $applicant = Applicants::where('user_id', $user->id)->first();

        if (!$applicant) {
            return redirect()->route('profile.page')->with('error', 'Applicant profile not found.');
        }

        $jobsInCart = JobCart::where('applicant_id', $applicant->id)
            ->with('job')
            ->get()
            ->filter(fn($cartItem) => $cartItem->job !== null);

        return view('job-cart.index', compact('jobsInCart'));
    }

    // Remove a job from cart
    public function remove($cartId)
    {
        $cartItem = JobCart::find($cartId);

        if (!$cartItem) {
            return back()->with('error', 'Job not found in your cart.');
        }

        $cartItem->delete();

        return back()->with('success', 'Job removed from your cart.');
    }
}
