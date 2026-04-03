<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\School;

class SchoolController extends Controller
{
    public function create()
    {
        return view('schools.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        School::create($request->all());

        return redirect()->back()->with('success', 'School added successfully!');
    }
}
