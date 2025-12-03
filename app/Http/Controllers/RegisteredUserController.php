<?php

namespace App\Http\Controllers;

use Illuminate\Validation\Rules\Password;
use App\Models\User;
use App\Models\employee;
use Illuminate\Support\Facades\Auth;

class RegisteredUserController extends Controller
{
    public function create()
    {
        return view('auth.register');
    }

    public function store()
    {
        //validate
        $attributes = request()->validate(
            [
                'UserName' => ['required'],
                'password' => ['required', Password::default()],
            ]
        );

        // $emp=employee::find(1);
        // //store

        // $attributes['employee_id']=$emp->id;
        $user=User::create($attributes);


        //login
        Auth::login($user);
        //redirect
        return redirect('/');
    }
}
