<?php

namespace App\Http\Controllers\Admin;

use App\Models\Aset;
use App\Models\Sporadik;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class SporadikController extends Controller
{
    public function index()
    {
        // Retrieve all Sporadik records from the database
        $sporadiks = Sporadik::all();

        // Return the view with the retrieved Sporadik records
        return view('pages.admin.sporadiks.list', compact('sporadiks'));
    }

    public function detail($id)
    {
        return view('pages.admin.sporadiks.detail');
    }

    // Display a listing of the Sporadik for a specific asset
    public function Sporadik($id_aset)
    {
        $aset = Aset::findOrFail($id_aset);
        $sporadiks = $aset->sporadik; // Assuming you have a relationship defined

        // return view('admin.aset.Sporadik.index', compact('aset', 'Sporadiks'));
    }

    public function create()
    {
        // Return the view for creating a new Sporadik record
        return view('pages.admin.sporadiks.create');
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // Define your validation rules here
        ]);

        // Create a new Sporadik record with the validated data
        Sporadik::create($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('sporadiks.index')->with('success', 'Sporadik record created successfully');
    }

    public function show($id)
    {
        // Retrieve the Sporadik record with the given ID from the database
        $sporadik = Sporadik::findOrFail($id);

        // Return the view with the retrieved Sporadik record
        return view('pages.admin.sporadiks.show', compact('sporadik'));
    }

    public function edit($id)
    {
        return view('pages.admin.sporadik.edit');
    }

    public function update(Request $request, $id)
    {
        // Validate the request data
        $validatedData = $request->validate([
            // Define your validation rules here
        ]);

        // Retrieve the Sporadik record with the given ID from the database
        $sporadik = Sporadik::findOrFail($id);

        // Update the Sporadik record with the validated data
        $sporadik->update($validatedData);

        // Redirect to the index page with a success message
        return redirect()->route('sporadiks.index')->with('success', 'Sporadik record updated successfully');
    }
}
