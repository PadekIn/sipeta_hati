<?php

namespace App\Http\Controllers;

use App\Models\Pbb;
use Illuminate\Http\Request;

class PbbController
{
    public function index()
    {
        // Retrieve all PBB records from the database
        $pbbs = Pbb::all();

        // Return the view with the retrieved PBB records
        return view('pages.admin.pbbs.list', compact('pbbs'));
    }

    public function create()
    {
        // Return the view for creating a new PBB record
        return view('pages.admin.pbbs.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // Define your validation rules here
        ]);

        // Create a new PBB record with the validated data
        Pbb::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('pbbs.index')->with('success', 'PBB record created successfully');
    }

    public function show($id)
    {
        // Retrieve the PBB record with the given ID from the database
        $pbb = Pbb::findOrFail($id);

        // Return the view with the retrieved PBB record
        return view('pages.admin.pbbs.show', compact('pbb'));
    }

    public function edit($id)
    {
        // Retrieve the PBB record with the given ID from the database
        $pbb = Pbb::findOrFail($id);

        // Return the view for editing the PBB record
        return view('pages.admin.pbbs.edit', compact('pbb'));
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // Define your validation rules here
        ]);

        // Retrieve the PBB record with the given ID from the database
        $pbb = Pbb::findOrFail($id);

        // Update the PBB record with the validated data
        $pbb->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('pbbs.index')->with('success', 'PBB record updated successfully');
    }

    public function destroy($id)
    {
        // Retrieve the PBB record with the given ID from the database
        $pbb = Pbb::findOrFail($id);

        // Delete the PBB record
        $pbb->delete();

        // Redirect to the index page with a success message
        return redirect()->route('pbbs.index')->with('success', 'PBB record deleted successfully');
    }
}
