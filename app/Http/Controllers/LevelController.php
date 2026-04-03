<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Level;

class LevelController extends Controller
{
    // Show form to add new level
    public function create()
    {
        return view('levels.create');
    }

    // Store level in database
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        Level::create($request->all());

        return redirect()->back()->with('success', 'Level added successfully!');
    }
}