<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Logout;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rules\Password;
use Illuminate\Validation\ValidationException;

use function Ramsey\Uuid\v1;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function create()
    {
        return view('auth.login');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         //validate
        $attributes = request()->validate(
            [
                'UserName' => ['required'],
                'password' => ['required'],
            ]
        );
        //attempt
        if(! Auth::attempt($attributes)){
            throw ValidationException::withMessages(['password'=>'this credidentianls dose not match']);
        }
        

        //regenerate token

        request()->session()->regenerate();
        //redirect
        return redirect('/');
    }

    /**
     * Display the specified resource.
     */
    public function show()
    {
       
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy()
    {
        Auth::logout();
        return redirect('/');
    }
}
