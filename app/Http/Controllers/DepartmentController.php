<?php

namespace App\Http\Controllers;

use App\Models\department;
use App\Models\employee;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = department::withCount('employees')->get();

        return view('departments.index', [
            'departments' => $departments,
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(department $department)
    {
        $department->load(['employees.person', 'employees.emp_role', 'employees.emp_state']);

        return view('departments.show', [
            'department' => $department,
        ]);
    }

    /**
     * Show the form for assigning employees to a department.
     */
    public function assignEmployeesPage(department $department)
    {
        // Get all employees that are not assigned to this department
        // Since employees must have a department, we'll show employees from other departments
        $employees = employee::where('department_id', '!=', $department->id)
            ->with(['person', 'department', 'emp_role', 'emp_state'])
            ->paginate(10);

        return view('departments.assign-employees', [
            'department' => $department,
            'employees' => $employees,
        ]);
    }

    /**
     * Assign selected employees to the department.
     */
    public function assignEmployees(Request $request, department $department)
    {
        $validated = $request->validate([
            'employees' => [
                'required',
                'array',
                'min:1',
            ],
            'employees.*' => [
                'required',
                'integer',
                'exists:employees,id',
            ],
        ], [
            'employees.required' => 'Please select at least one employee to assign.',
            'employees.array' => 'Invalid employee selection format.',
            'employees.min' => 'Please select at least one employee to assign.',
            'employees.*.required' => 'Invalid employee selection.',
            'employees.*.integer' => 'Employee ID must be a valid number.',
            'employees.*.exists' => 'One or more selected employees do not exist.',
        ]);

        $employeeIds = $validated['employees'];

        // Update employees to assign them to this department
        employee::whereIn('id', $employeeIds)
            ->update(['department_id' => $department->id]);

        return redirect()->route('departments.show', $department)
            ->with('success', 'Employees assigned to department successfully.');
    }

    /**
     * Remove an employee from the department.
     */
    public function removeEmployee(department $department, employee $employee)
    {
        // Check if this employee is actually assigned to this department
        if ($employee->department_id == $department->id) {
            // We can't remove the department_id as it's required, so we need to assign to a default department
            // Try to use "Headquarters" as default, otherwise use the first available department
            $defaultDepartment = department::where('id', '!=', $department->id)
                ->where('DeptName', 'Headquarters')
                ->first();
            
            if (!$defaultDepartment) {
                $defaultDepartment = department::where('id', '!=', $department->id)->first();
            }
            
            if ($defaultDepartment) {
                $employee->department_id = $defaultDepartment->id;
                $employee->save();

                return redirect()->route('departments.show', $department)
                    ->with('success', 'Employee removed from the department successfully.');
            } else {
                return redirect()->route('departments.show', $department)
                    ->with('error', 'Cannot remove employee. No other department available.');
            }
        }

        return redirect()->route('departments.show', $department)
            ->with('error', 'This employee is not assigned to this department.');
    }
}
