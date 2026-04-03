<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Guardian;

class GuardianController extends Controller
{
    // Show form to add new guardian
    public function create()
    {
        return view('guardians.create');
    }

    // Store guardian in database
    public function store(Request $request)
    {
        $request->validate([
            'full_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'address' => 'nullable|string|max:255',
        ]);

        Guardian::create($request->all());

        return redirect()->back()->with('success', 'Guardian added successfully!');
    }
}