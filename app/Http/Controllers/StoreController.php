<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\department;
use App\Models\employee;
use App\Models\retail_store;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cities = city::all(); // all cities for the dropdown

        // Start a query on the retail_store model
        $query = retail_store::with('city'); // eager load the related city

        // Search by store name, city name, or phone
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('StoreName', 'like', "%{$search}%")
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
        $stores = $query->paginate(10)->withQueryString();

        // Return the view with stores and cities
        return view('stores.index', [
            'stores' => $stores,
            'cities' => $cities,
        ]);
    }

    public function create()
    {
        return view('stores.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validate
        $attributes = $request->validate(
            [
                'StoreName' => ['required', 'min:5'],
                'phone' => ['required', 'size:10'],
                'Address' => ['required', 'min:10'],
                'city' => ['required'],
            ]
        );
        // dd($attributes);

        // store
        retail_store::create($attributes);

        // redirect
        return redirect('/');

    }

    /**
     * Display the specified resource.
     */
    public function show(retail_store $store)
    {
        $store->load(['city', 'manager.person']);
        return view('stores.show', ['store' => $store]);
    }

    public function edit(retail_store $store)
    {
        $Cities = city::all();

        return view('stores.edit', [
            'Cities' => $Cities,
            'store' => $store]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, retail_store $store)
    {
        $request->validate([
            'store_name' => ['required', 'min:5'],
            'phone' => ['required', 'size:10'],
            'address' => ['required', 'min:10'],
            'city_id' => ['required', 'exists:cities,id'],
        ]);

        $store->update([
            'StoreName' => $request->store_name,
            'Phone' => $request->phone,
            'Address' => $request->address,
            'city_id' => $request->city_id,
        ]);

        return redirect("/stores/{$store->id}")->with('success', 'Store updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(retail_store $store)
    {
        // authenticat

        $store->delete();

        // redirect
        return redirect('/stores');
    }

    public function listEmployees(retail_store $store)
    {
        $departments = Department::all();

        // Start query from the relationship
        $query = $store->employees()->with('department', 'emp_role', 'person');

        // Filter by employee first name if provided
        if ($search = request('search')) {
            $query->whereHas('person', function ($q) use ($search) {
                $q->where('FirstName', 'like', "%{$search}%")
                    ->orWhere('LastName', 'like', "%{$search}%"); // optional: search last name too
            });
        }

        // Filter by department if provided
        if ($deptId = request('department')) {
            $query->where('department_id', $deptId);
        }

        // Paginate the results
        $employees = $query->paginate(3)->withQueryString();

        return view('stores.employees', [
            'employees' => $employees,
            'departments' => $departments,
            'store' => $store,
        ]);
    }

    public function destroyemp(retail_store $store, employee $employee)
    {
        // Check if this employee is actually assigned to this store
        if ($employee->assignable_type === retail_store::class && $employee->assignable_id == $store->id) {
            // Remove the assignment
            $employee->assignable_type = null;
            $employee->assignable_id = null;
            $employee->save();

            return redirect()->route('stores.employees', $store)
                ->with('success', 'Employee removed from the store successfully.');
        }

        return redirect()->route('stores.employees', $store)
            ->with('error', 'This employee is not assigned to this store.');
    }

    public function assignEmployeesPage(retail_store $store)
    {
        // Employees not assigned to any store
        $employees = Employee::whereNull('assignable_id')
            ->whereNull('assignable_type')
            ->with(['department', 'emp_role', 'person'])
            ->whereHas('emp_role', function ($q) {
                $q->whereIn('RoleName', ['employee', 'marketer']);
            })
            ->paginate(10);

        // $departments = Department::all();

        return view('stores.assign-employees', [
            'store' => $store,
            'employees' => $employees,
            // 'departments' => $departments,
        ]);
    }

    public function assignSelectedEmployees(Request $request, retail_store $store)
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

        // Check if employees are already assigned to this store
        $alreadyAssignedToThisStore = $employees->filter(function ($emp) use ($store) {
            return $emp->assignable_type === retail_store::class && $emp->assignable_id == $store->id;
        });

        if ($alreadyAssignedToThisStore->isNotEmpty()) {
            $names = $alreadyAssignedToThisStore->map(function ($emp) {
                return $emp->person->FirstName . ' ' . $emp->person->LastName;
            })->implode(', ');

            return back()
                ->withInput()
                ->with('error', "The following employees are already assigned to this store: {$names}.");
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
                ->with('error', "The following employees have invalid roles for store assignment: {$names}. Only employees and marketers can be assigned to stores.");
        }

        // try to assign employees to the store
        try {
            DB::transaction(function () use ($employeeIds, $store) {
                employee::whereIn('id', $employeeIds)->update([
                    'assignable_id' => $store->id,
                    'assignable_type' => retail_store::class,
                ]);
            });

            $count = count($employeeIds);
            $message = $count === 1 
                ? 'Employee assigned successfully.' 
                : "{$count} employees assigned successfully.";

            return redirect()->route('stores.employees', $store)
                ->with('success', $message);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'An error occurred while assigning employees. Please try again.');
        }
    }

    public function assignManagerPage(retail_store $store)
    {
        // Get all employees with manager role
        $allManagers = employee::whereHas('emp_role', function ($q) {
                $q->where('RoleName', 'manager');
            })
            ->with(['person', 'emp_role'])
            ->get();

        // Get IDs of managers already assigned to other stores or warehouses
        $assignedManagerIds = retail_store::whereNotNull('manager_id')
            ->where('id', '!=', $store->id)
            ->pluck('manager_id')
            ->merge(
                \App\Models\warehouse::whereNotNull('manager_id')->pluck('manager_id')
            )
            ->unique()
            ->toArray();

        // Filter out already assigned managers, but include current manager if exists
        $managers = $allManagers->filter(function ($manager) use ($assignedManagerIds, $store) {
            return !in_array($manager->id, $assignedManagerIds) || $manager->id === $store->manager_id;
        });

        $currentManager = $store->manager;

        return view('stores.assign-manager', [
            'store' => $store,
            'managers' => $managers,
            'currentManager' => $currentManager,
        ]);
    }

    public function assignManager(Request $request, retail_store $store)
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
                ->with('error', 'The selected employee is not a manager. Only employees with manager role can be assigned as store managers.');
        }

        // Check if this manager is already managing another store
        $otherStore = retail_store::where('manager_id', $managerId)
            ->where('id', '!=', $store->id)
            ->first();

        if ($otherStore) {
            return back()
                ->withInput()
                ->with('error', "This manager is already assigned to another store: {$otherStore->StoreName}.");
        }

        // Check if this manager is already managing a warehouse
        $warehouse = \App\Models\warehouse::where('manager_id', $managerId)->first();
        if ($warehouse) {
            return back()
                ->withInput()
                ->with('error', "This manager is already assigned to warehouse: {$warehouse->WarehouseName}.");
        }

        try {
            DB::transaction(function () use ($store, $managerId) {
                $store->update(['manager_id' => $managerId]);
            });

            return redirect()->route('stores.show', $store)
                ->with('success', 'Manager assigned successfully.');
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'An error occurred while assigning the manager. Please try again.');
        }
    }

    public function removeManager(retail_store $store)
    {
        if (!$store->manager_id) {
            return back()->with('error', 'This store does not have a manager assigned.');
        }

        try {
            DB::transaction(function () use ($store) {
                $store->update(['manager_id' => null]);
            });

            return redirect()->route('stores.show', $store)
                ->with('success', 'Manager removed successfully.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'An error occurred while removing the manager. Please try again.');
        }
    }
}
