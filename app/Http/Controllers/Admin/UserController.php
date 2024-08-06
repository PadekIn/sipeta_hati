<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;

class UserController
{
    public function index()
    {
        $admin = User::where('role', 'admin')->get();
        return view('pages.admin.users.list', compact('admin'));
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
