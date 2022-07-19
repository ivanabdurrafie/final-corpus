<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function index()
    {
        return view('admin.changePassword');
    }

    public function store(Request $request){
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'string', 'min:8'],
            'new_confirm_password' => ['required', 'string', 'min:8', 'same:new_password'],
        ]);
        $user = User::find(auth()->user()->id);
        $user->password = Hash::make($request->new_password);
        $user->save();
        return redirect()->route('change-password')->with('success', 'Password berhasil diubah');
    }
}
