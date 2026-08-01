<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        return view('admin.profile');
    }

    public function edit()
    {
        return view('admin.profile.edit');
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
        ]);

        return redirect('/admin/profile');
    }

    public function destroy()
    {
        auth()->user()->delete();

        return redirect('/login');
    }
}
