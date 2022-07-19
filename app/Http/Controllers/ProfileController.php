<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function index()
    {
        $profile = User::find(auth()->id());
        // dd($profile);
        return view('profile', compact('profile'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->id(),
        ]);
        $user = User::find(auth()->id());
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return redirect()->route('profile')->with('success', 'Data berhasil diubah');
    }
}
