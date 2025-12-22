<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\emp_role;
use App\Models\emp_state;
use App\Models\employee;
use App\Models\person;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Storage;


class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $states = emp_state::all();
        $roles = emp_role::all();

        $query = Employee::query()->with(['person', 'department', 'emp_role', 'emp_state']);

        // Search by name or email
        if ($search = $request->input('search')) {
            $query->whereHas('person', function ($q) use ($search) {
                $q->where('FirstName', 'like', "%{$search}%")
                    ->orWhere('LastName', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($role = $request->input('role')) {
            $query->whereHas('emp_role', function ($q) use ($role) {
                $q->where('RoleName', $role);
            });
        }

        // Filter by status
        if ($status = $request->input('status')) {
            $query->whereHas('emp_state', function ($q) use ($status) {
                $q->where('StateName', $status);
            });
        }

        $employees = $query->paginate(10)->withQueryString();

        return view('employees.index', [
            'employees' => $employees,
            'states' => $states,
            'roles' => $roles,
        ]);
    }

    public function create()
    {
        $roles = emp_role::all();
        $departments = department::all();

        return view('employees.create',
            [
                'roles' => $roles,
                'departments' => $departments,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request->all());
        // validate
        $attributes = $request->validate(
            [
                'FirstName' => ['required', 'min:3'],
                'LastName' => ['required', 'min:3'],
                'NationalId' => ['required', 'size:11'],
                'email' => ['required', 'email'],
                'phone_num' => ['required', 'size:10'],
                'BirthDate' => ['required', 'date', Rule::date()->beforeOrEqual(today()->subYears(18))],
                'emp_role_id' => ['required', 'exists:emp_roles,id'],
                'dept_id' => ['required', 'exists:departments,id'],
                'avatar' => ['nullable', 'image'], // max 2MB:  'max:2048'
            ],
            [
                'BirthDate.before_or_equal' => 'You should be above 18 years old.',
            ]
        );

        if ($request->hasFile('avatar')) {
        $avarar_url = request('avatar')->store('avatars', 'public');
        }
        // create
        $person = person::create(
            [
                'FirstName' => $attributes['FirstName'],
                'LastName' => $attributes['LastName'],
                'NationalId' => $attributes['NationalId'],
                'email' => $attributes['email'],
                'phone_num' => $attributes['phone_num'],
                'BirthDate' => $attributes['BirthDate'],
                'avatar_url' => $avarar_url?? 'avatares/profile.jpg',
            ]
        );
        $employee = employee::create([
            'person_id' => $person->id,
            'emp_role_id' => $attributes['emp_role_id'],
            'department_id' => $attributes['dept_id'],
        ]);

        // redirect
        return redirect('/');

    }

    /**
     * Display the specified resource.
     */
    public function show(employee $employee)
    {
        return view('employees.show', ['employee' => $employee]);
    }

    public function edit(employee $employee)
    {
        $roles = emp_role::all();
        $states = emp_state::all();
        $departments = department::all();

        return view('employees.edit',
            [
                'roles' => $roles,
                'states' => $states,
                'departments' => $departments,
                'employee' => $employee,
            ]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, employee $employee)
    {
        // validation
        request()->validate(
            [
                'FirstName' => ['required', 'min:3'],
                'LastName' => ['required', 'min:3'],
                'NationalId' => ['required', 'size:11'],
                'email' => ['required', 'email'],
                'phone_num' => ['required', 'size:10'],
                'BirthDate' => ['required', 'date', Rule::date()->beforeOrEqual(today()->subYears(18))],
                'emp_role_id' => ['exists:emp_roles,id'],
                'dept_id' => ['required', 'exists:departments,id'],
                'avatar' => ['nullable', 'image'], // max 2MB:  'max:2048'
            ],
            [
                'BirthDate.before_or_equal' => 'You should be above 18 years old.',
            ]
        );

         // Only store a new avatar if the user uploaded one
        if ($request->hasFile('avatar')) {
            // Optionally delete old avatar if it exists
            if ($employee->person->avatar_url) {
                Storage::disk('public')->delete($employee->person->avatar_url);
            }

            // Store new avatar
                $avarar_url=request('avatar')->store('avatars','public');

        } else {
            // Keep the existing avatar URL if no new file is uploaded
            $avarar_url = $employee->person->avatar_url;

        }

        // db record updating
        $employee->person->update([
            'FirstName' => request('FirstName'),
            'LastName' => request('LastName'),
            'NationalId' => request('NationalId'),
            'email' => request('email'),
            'phone_num' => request('phone_num'),
            'BirthDate' => request('BirthDate'),
            'avatar_url' => $avarar_url,

        ]);
        $employee->update([
            'emp_role_id' => request('emp_role_id')?? '1',
            'department_id' => request('dept_id'),
        ]);

        // redirect
        return redirect("/employees/$employee->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(employee $employee)
    {
        // authenticat

        $employee->delete();

        // redirect
        return redirect('/employees');
    }




    public function changeRole(employee $employee)
    {
        $roles = emp_role::all();
        $departments=department::all();
        $states=emp_state::all();

        return view('employees.change-role', [
            'employee' => $employee,
            'roles' => $roles,
            'departments' => $departments,
            'states'=>$states,
        ]);
    }

    public function updateRole(Request $request, employee $employee)
    {
        // Validate the request
        $request->validate([
            'emp_role_id' => ['required', 'exists:emp_roles,id'],
            'department_id' => request('dept_id'),
        ]);

        // Update the employee's role
        $employee->update([
            'emp_role_id' => $request->input('emp_role_id',$employee->emp_role_id),
            'department_id' => $request->input('department_id', $employee->department_id), // Keep the same department if not provided
        ]);

        // Redirect back to the employee's profile with a success message
        return redirect()->route('employees.show', $employee)->with('success', 'Employee role updated successfully.');
    }
}
