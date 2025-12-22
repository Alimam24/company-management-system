<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
         $user = Auth::user();

        // Load the user's employee and that employee's person relation
        $user->load('employee.person');

        // Get the related employee model (may be null if user has no employee)
        $employee = $user->employee;

        return view('profile.index', ['employee' => $employee]);
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit()
    {
         $user = Auth::user();
         
        // Load the user's employee and that employee's person relation
        $user->load('employee.person');

        // Get the related employee model (may be null if user has no employee)
        $employee = $user->employee;

        return view('profile.edit', ['employee' => $employee]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $user = Auth::user();
         
        // Load the user's employee and that employee's person relation
        $user->load('employee.person');

         // validation
        request()->validate(
            [
                'FirstName' => ['required', 'min:5'],
                'LastName' => ['required', 'min:5'],
                'NationalId' => ['required', 'size:10'],
                'email' => ['required', 'email'],
                'phone_num' => ['required', 'size:10'],
                'BirthDate' => ['required', 'date', Rule::date()->beforeOrEqual(today()->subYears(18))],
                'avatar' => ['nullable', 'image'], // max 2MB:  'max:2048'
            ],
            [
                'BirthDate.before_or_equal' => 'You should be above 18 years old.',
            ]
        );

         // Only store a new avatar if the user uploaded one
        if ($request->hasFile('avatar')) {
            // Optionally delete old avatar if it exists
            if ($user->employee->person->avatar_url) {
                Storage::disk('public')->delete($user->employee->person->avatar_url);
            }

            // Store new avatar
                $avarar_url=request('avatar')->store('avatars','public');

        } else {
            // Keep the existing avatar URL if no new file is uploaded
            $avarar_url = $user->employee->person->avatar_url;

        }

        // db record updating
        $user->employee->person->update([
            'FirstName' => request('FirstName'),
            'LastName' => request('LastName'),
            'NationalId' => request('NationalId'),
            'email' => request('email'),
            'phone_num' => request('phone_num'),
            'BirthDate' => request('BirthDate'),
            'avatar_url' => $avarar_url,

        ]);
        // redirect
        return redirect("/profile");
    }

    public function showChangePasswordForm()
    {
        return view('profile.change-password');
    }
    

    public function changePassword(Request $request)
    {
        // Validate the passwords
        $request->validate([
            'current_password' => 'required|string',
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        // Check if the current password matches
        $user = Auth::user();
        if (!Hash::check($request->input('current_password'), $user->password)) {
            return back()->withErrors(['current_password' => 'The current password is incorrect.']);
        }

        // Update the user's password
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        // Redirect back with a success message
        return redirect()->route('profile.index')->with('success', 'Password changed successfully.');
    }
}