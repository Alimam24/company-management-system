<?php

namespace App\Http\Controllers;

use App\Models\PasswordResetRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class PasswordResetRequestController extends Controller
{

    public function index()
    {
        $requests = PasswordResetRequest::with('user.employee.person')
            ->where('status', 'pending')
            ->with('user.employee.person')
            ->latest()
            ->get();

        return view('password_reset_requests.index', ['requests'=>$requests]);
    }


    public function create()
    {
        return view('password_reset_requests.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'UserName' => 'required|string|max:255|exists:users,UserName',
        ]);

        $user= User::where('UserName', $request->UserName)->first();

        PasswordResetRequest::firstOrCreate([
            'user_id' => $user->id,
            'status'=>'pending'
        ]);

        return back()->with('success','Your request has been sent to HR employee. They will contact you soon.');
    }

    public function approve(PasswordResetRequest $PasswordResetRequest)
    {
        $PasswordResetRequest->status = 'completed';
        $PasswordResetRequest->save();
        
        $newPassword = \Illuminate\Support\Str::random(12);
        $PasswordResetRequest->user->password = Hash::make($newPassword);
        $PasswordResetRequest->user->save();

        Mail::to($PasswordResetRequest->user->employee->person->email)->send(new \App\Mail\PasswordReseted($newPassword));

        return back()->with('success','Password reset request approved.');
    }

    public function deny(PasswordResetRequest $PasswordResetRequest)
    {
        $PasswordResetRequest->delete();

        return back()->with('success','Password reset request denied.');
    }
}
