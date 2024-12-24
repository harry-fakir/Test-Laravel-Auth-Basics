<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function show()
    {
        $user = auth()->user();

        return view('auth.profile', [
            'user' => $user
        ]);
    }

    public function update(ProfileUpdateRequest $request)
    {

        if (Auth::check()) {
            $user = Auth::user();
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            if ($request->filled('password')) {
                $user->password = bcrypt($request->input('password'));
            }
            $user->save();
        }

        return redirect()->route('profile.show')->with('success', 'Profile updated.');
    }
}
