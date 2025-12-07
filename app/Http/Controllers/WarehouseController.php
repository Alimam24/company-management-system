<?php

namespace App\Http\Controllers;

use App\Models\warehouse;
use App\Models\employee;
use App\Models\department;
use App\Models\retail_store;
use Illuminate\Http\Request;
use App\Models\city;
use Illuminate\Support\Facades\DB;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
{
    $cities = city::all(); // all cities for the dropdown

    // Start a query on the warehouse model
    $query = warehouse::with('city'); // eager load the related city

    // Search by warehouse name, city name, or phone
    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('WarehouseName', 'like', "%{$search}%")
              ->orWhere('Phone', 'like', "%{$search}%")
              ->orWhereHas('city', function ($q2) use ($search) {
                  $q2->where('Name', 'like', "%{$search}%");
              });
        });
    }

    // Filter by city if provided
    if ($cityId = $request->input('city')) {
        $query->where('city_id', $cityId);
    }

    // Paginate results
    $warehouses = $query->paginate(10)->withQueryString();

    // Return the view with stores and cities
    return view('warehouses.index', [
        'warehouses' => $warehouses,
        'cities' => $cities,
    ]);
}

   public function create()
    {
        return view('warehouses.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validate
        $attributes=$request->validate(
            [
                'WarehouseName'=>['required','min:5'],
                'phone'=>['required','size:10'],
                'Address'=>['required','min:10'],
                'city_id'=>['required']
            ]
        );
        //dd($attributes);

        //store
        warehouse::create($attributes);

        //redirect
        return redirect('/');


    }

    /**
     * Display the specified resource.
     */
    public function show(warehouse $warehouse)
    {
         $warehouse->load(['city', 'manager.person']);
         return view('warehouses.show', ['warehouse' => $warehouse]);
    }


    public function edit(warehouse $warehouse){
          $Cities = city::all();

        return view('warehouses.edit', [
            'Cities' => $Cities,
            'warehouse' => $warehouse]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, warehouse $warehouse)
    {
        $request->validate([
        'WarehouseName' => ['required', 'min:5'],
        'phone'      => ['required', 'size:10'],
        'address'    => ['required', 'min:10'],
        'city_id'    => ['required', 'exists:cities,id'],
    ]);

    $warehouse->update([
        'WarehouseName' => $request->WarehouseName,
        'Phone'     => $request->phone,
        'Address'   => $request->address,
        'city_id'   => $request->city_id,
    ]);

    return redirect("/warehouses/{$warehouse->id}")->with('success', 'warehouse updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(warehouse $warehouse)
    {
        //authenticat

        $warehouse->delete();
        return redirect('/warehouses');
    }

    public function listEmployees(warehouse $warehouse)
    {
        $departments = department::all();

        // Start query from the relationship
        $query = $warehouse->employees()->with('department', 'emp_role', 'person');

        // Filter by employee first name if provided
        if ($search = request('search')) {
            $query->whereHas('person', function ($q) use ($search) {
                $q->where('FirstName', 'like', "%{$search}%")
                    ->orWhere('LastName', 'like', "%{$search}%");
            });
        }

        // Filter by department if provided
        if ($deptId = request('department')) {
            $query->where('department_id', $deptId);
        }

        // Paginate the results
        $employees = $query->paginate(3)->withQueryString();

        return view('warehouses.employees', [
            'employees' => $employees,
            'departments' => $departments,
            'warehouse' => $warehouse,
        ]);
    }

    public function destroyemp(warehouse $warehouse, employee $employee)
    {
        // Check if this employee is actually assigned to this warehouse
        if ($employee->assignable_type === warehouse::class && $employee->assignable_id == $warehouse->id) {
            // Remove the assignment
            $employee->assignable_type = null;
            $employee->assignable_id = null;
            $employee->save();

            return redirect()->route('warehouses.employees', $warehouse)
                ->with('success', 'Employee removed from the warehouse successfully.');
        }

        return redirect()->route('warehouses.employees', $warehouse)
            ->with('error', 'This employee is not assigned to this warehouse.');
    }

    public function assignEmployeesPage(warehouse $warehouse)
    {
        // Employees not assigned to any warehouse or store
        $employees = employee::whereNull('assignable_id')
            ->whereNull('assignable_type')
            ->with(['department', 'emp_role', 'person'])
            ->whereHas('emp_role', function ($q) {
                $q->whereIn('RoleName', ['employee', 'marketer']);
            })
            ->paginate(10);

        return view('warehouses.assign-employees', [
            'warehouse' => $warehouse,
            'employees' => $employees,
        ]);
    }

    public function assignSelectedEmployees(Request $request, warehouse $warehouse)
    {
        // Validate the request with proper Laravel validation rules
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

        // Fetch all employees once with all necessary relationships
        $employees = employee::whereIn('id', $employeeIds)
            ->with(['person', 'emp_role', 'assignable'])
            ->get();

        // Check if employees are already assigned to this warehouse
        $alreadyAssignedToThisWarehouse = $employees->filter(function ($emp) use ($warehouse) {
            return $emp->assignable_type === warehouse::class && $emp->assignable_id == $warehouse->id;
        });

        if ($alreadyAssignedToThisWarehouse->isNotEmpty()) {
            $names = $alreadyAssignedToThisWarehouse->map(function ($emp) {
                return $emp->person->FirstName . ' ' . $emp->person->LastName;
            })->implode(', ');

            return back()
                ->withInput()
                ->with('error', "The following employees are already assigned to this warehouse: {$names}.");
        }

        // Check if employees are already assigned to another store or warehouse
        $alreadyAssigned = $employees->filter(function ($emp) {
            return $emp->assignable_id !== null && $emp->assignable_type !== null;
        });

        if ($alreadyAssigned->isNotEmpty()) {
            $names = $alreadyAssigned->map(function ($emp) {
                return $emp->person->FirstName . ' ' . $emp->person->LastName;
            })->implode(', ');

            return back()
                ->withInput()
                ->with('error', "The following employees are already assigned: {$names}. Please select unassigned employees only.");
        }

        // Verify employees have the correct roles (employee or marketer)
        $invalidRoles = $employees->filter(function ($emp) {
            return !in_array($emp->emp_role->RoleName, ['employee', 'marketer']);
        });

        if ($invalidRoles->isNotEmpty()) {
            $names = $invalidRoles->map(function ($emp) {
                return $emp->person->FirstName . ' ' . $emp->person->LastName . ' (' . $emp->emp_role->RoleName . ')';
            })->implode(', ');

            return back()
                ->withInput()
                ->with('error', "The following employees have invalid roles for warehouse assignment: {$names}. Only employees and marketers can be assigned to warehouses.");
        }

        // Use database transaction for safety
        try {
            DB::transaction(function () use ($employeeIds, $warehouse) {
                employee::whereIn('id', $employeeIds)->update([
                    'assignable_id' => $warehouse->id,
                    'assignable_type' => warehouse::class,
                ]);
            });

            $count = count($employeeIds);
            $message = $count === 1 
                ? 'Employee assigned successfully.' 
                : "{$count} employees assigned successfully.";

            return redirect()->route('warehouses.employees', $warehouse)
                ->with('success', $message);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'An error occurred while assigning employees. Please try again.');
        }
    }

    public function assignManagerPage(warehouse $warehouse)
    {
        // Get all employees with manager role
        $allManagers = employee::whereHas('emp_role', function ($q) {
                $q->where('RoleName', 'manager');
            })
            ->with(['person', 'emp_role'])
            ->get();

        // Get IDs of managers already assigned to other stores or warehouses
        $assignedManagerIds = retail_store::whereNotNull('manager_id')
            ->pluck('manager_id')
            ->merge(
                warehouse::whereNotNull('manager_id')
                    ->where('id', '!=', $warehouse->id)
                    ->pluck('manager_id')
            )
            ->unique()
            ->toArray();

        // Filter out already assigned managers, but include current manager if exists
        $managers = $allManagers->filter(function ($manager) use ($assignedManagerIds, $warehouse) {
            return !in_array($manager->id, $assignedManagerIds) || $manager->id === $warehouse->manager_id;
        });

        $currentManager = $warehouse->manager;

        return view('warehouses.assign-manager', [
            'warehouse' => $warehouse,
            'managers' => $managers,
            'currentManager' => $currentManager,
        ]);
    }

    public function assignManager(Request $request, warehouse $warehouse)
    {
        $validated = $request->validate([
            'manager_id' => [
                'required',
                'integer',
                'exists:employees,id',
            ],
        ], [
            'manager_id.required' => 'Please select a manager.',
            'manager_id.exists' => 'The selected employee does not exist.',
        ]);

        $managerId = $validated['manager_id'];

        // Verify the employee has manager role
        $manager = employee::with(['person', 'emp_role'])->findOrFail($managerId);
        
        if ($manager->emp_role->RoleName !== 'manager') {
            return back()
                ->withInput()
                ->with('error', 'The selected employee is not a manager. Only employees with manager role can be assigned as warehouse managers.');
        }

        // Check if this manager is already managing a store
        $store = retail_store::where('manager_id', $managerId)->first();
        if ($store) {
            return back()
                ->withInput()
                ->with('error', "This manager is already assigned to store: {$store->StoreName}.");
        }

        // Check if this manager is already managing another warehouse
        $otherWarehouse = warehouse::where('manager_id', $managerId)
            ->where('id', '!=', $warehouse->id)
            ->first();

        if ($otherWarehouse) {
            return back()
                ->withInput()
                ->with('error', "This manager is already assigned to another warehouse: {$otherWarehouse->WarehouseName}.");
        }

        try {
            DB::transaction(function () use ($warehouse, $managerId) {
                $warehouse->update(['manager_id' => $managerId]);
            });

            return redirect()->route('warehouses.show', $warehouse)
                ->with('success', 'Manager assigned successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'An error occurred while assigning the manager. Please try again.');
        }
    }

    public function removeManager(warehouse $warehouse)
    {
        if (!$warehouse->manager_id) {
            return back()->with('error', 'This warehouse does not have a manager assigned.');
        }

        try {
            DB::transaction(function () use ($warehouse) {
                $warehouse->update(['manager_id' => null]);
            });

            return redirect()->route('warehouses.show', $warehouse)
                ->with('success', 'Manager removed successfully.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'An error occurred while removing the manager. Please try again.');
        }
    }
}
