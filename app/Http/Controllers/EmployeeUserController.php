<?php

namespace App\Http\Controllers;

use App\Models\employee;
use Illuminate\Http\Request;
use App\Services\UserService;       

class EmployeeUserController extends Controller
{
    public function __construct(protected UserService $userService)
    {
    }   

    /*
     * Show the form for creating a new user account for the employee.
     */
    public function createAccount(employee $employee)
    {
        return view('employees.create-account', ['employee' => $employee]);
    }

    /*
     * Store a newly created user account for the employee.
     */
    public function storeAccount(Request $request, employee $employee)
    {
       //validation
       $attributes=$request->validate([
        'UserName' => 'required|string|max:255|unique:users,UserName',
        'password' => 'required|string|min:8',
       ]);

       //create
       $this->userService->createEmployeeAccountFor($employee, $attributes);

       //redirect
         return redirect()->route('employees.show', $employee);
    }


    /*
     * Show the form for editing the user account of the employee.
     */
    public function editAccount(employee $employee)
    {
        return view('employees.edit-account', ['employee' => $employee]);   
    }

    /*
     * Update the user account of the employee.
     */
    public function updateAccount(Request $request, employee $employee)
    {
        //validation
        $attributes=$request->validate([
            'UserName' => 'required|string|max:255|unique:users,UserName,' . $employee->user->id,
            'password' => 'nullable|string|min:8',
            'Is_Active' => 'required|boolean'
        ]);

        //update
        $this->userService->updateAccount($employee->user, $attributes);

        //redirect
        return redirect()->route('employees.show', $employee);

    }

    public function destroyAccount(employee $employee)
    {
        $this->userService->deleteAccount($employee->user);

        return redirect()->route('employees.show', $employee);
    }   
}
