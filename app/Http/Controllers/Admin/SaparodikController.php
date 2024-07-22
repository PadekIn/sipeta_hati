<?php

namespace App\Http\Controllers\Admin;

use App\Models\Saparodik;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SaparodikController extends Controller
{
    public function index()
    {
        // Retrieve all Saparodik records from the database
        $saparodiks = Saparodik::all();

        // Return the view with the retrieved Saparodik records
        return view('pages.admin.saparodiks.list', compact('saparodiks'));
    }

    public function create()
    {
        // Return the view for creating a new Saparodik record
        return view('pages.admin.saparodiks.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // Define your validation rules here
        ]);

        // Create a new Saparodik record with the validated data
        Saparodik::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('saparodiks.index')->with('success', 'Saparodik record created successfully');
    }

    public function show($id)
    {
        // Retrieve the Saparodik record with the given ID from the database
        $saparodik = Saparodik::findOrFail($id);

        // Return the view with the retrieved Saparodik record
        return view('pages.admin.saparodiks.show', compact('saparodik'));
    }

    public function edit($id)
    {
        // Retrieve the Saparodik record with the given ID from the database
        $saparodik = Saparodik::findOrFail($id);

        // Return the view for editing the Saparodik record
        return view('pages.admin.saparodiks.edit', compact('saparodik'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // Define your validation rules here
        ]);

        // Retrieve the Saparodik record with the given ID from the database
        $saparodik = Saparodik::findOrFail($id);

        // Update the Saparodik record with the validated data
        $saparodik->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('saparodiks.index')->with('success', 'Saparodik record updated successfully');
    }
}
