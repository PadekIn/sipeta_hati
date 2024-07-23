<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

class UserController
{
    public function index()
    {
        return view('pages.admin.users.list');
    }

    public function create()
    {
        return view('pages.admin.users.create');
    }

    public function store(Request $request)
    {
        // store user
    }

    public function edit($id)
    {
        return view('pages.admin.users.edit');
    }

    public function update(Request $request, $id)
    {
        // update user
    }

    public function destroy($id)
    {
        // delete user
    }
}
