<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Application;
use Illuminate\Support\Facades\Auth;

class ApplicationController extends Controller
{
    public function apply($id)
    {
        Application::create([
            'skill_id' => $id,
            'applicant_id' => Auth::id(),
            'status' => 'pending'
        ]);

        return redirect()->back()->with('success', 'You have successfully applied for this skill!');
    }
}
