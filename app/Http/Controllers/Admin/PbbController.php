<?php

namespace App\Http\Controllers\Admin;

use App\Models\Pbb;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PbbController extends Controller
{
    public function index()
    {
        try {
            $pbbs = Pbb::with('aset', 'user')->get();
            return view('pages.admin.pbb.list', compact('pbbs'));
        } catch (\Throwable $th) {
            return redirect()->route('admin.dashboard')->with('error', 'Server Error');
        }
    }

    public function create()
    {
        // Return the view for creating a new PBB record
        return view('pages.admin.pbb.create');
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
        return redirect()->route('pbb.index')->with('success', 'PBB record created successfully');
    }

    public function show($id)
    {
        // Retrieve the PBB record with the given ID from the database
        $pbb = Pbb::findOrFail($id);

        // Return the view with the retrieved PBB record
        return view('pages.admin.pbb.show', compact('pbb'));
    }

    public function edit($id)
    {
        // Retrieve the PBB record with the given ID from the database
        // $pbb = Pbb::findOrFail($id);

        // Return the view for editing the PBB record
        return view('pages.admin.pbb.edit');
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
        return redirect()->route('pbb.index')->with('success', 'PBB record updated successfully');
    }

    public function destroy($id)
    {
        // Retrieve the PBB record with the given ID from the database
        $pbb = Pbb::findOrFail($id);

        // Delete the PBB record
        $pbb->delete();

        // Redirect to the index page with a success message
        return redirect()->route('pbb.index')->with('success', 'PBB record deleted successfully');
    }
}
