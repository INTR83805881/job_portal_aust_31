<?php

namespace App\Http\Controllers;

use App\Models\Mind;
use Illuminate\Http\Request;

class MindController extends Controller
{
    // Show all minds
    public function index() {
        $minds = Mind::all();
        return view('minds.index', compact('minds'));
    }

    // Show create form
    public function create() {
        return view('minds.create');
    }

    // Store new mind
    public function store(Request $request) {
        $request->validate([
            'name' => 'required|string|max:255',
            'about' => 'nullable|string',
            'photo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $photoPath = null;
        if ($request->hasFile('photo')) {
            $photoPath = $request->file('photo')->store('minds', 'public');
        }

        Mind::create([
            'name' => $request->name,
            'about' => $request->about,
            'photo' => $photoPath,
        ]);

        return redirect()->route('minds.index')->with('success', 'Mind created!');
    }
}
