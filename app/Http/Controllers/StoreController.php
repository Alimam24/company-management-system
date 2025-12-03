<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\department;
use App\Models\employee;
use App\Models\retail_store;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $cities = City::all(); // all cities for the dropdown

        // Start a query on the retail_store model
        $query = Retail_Store::with('City'); // eager load the related City

        // Search by store name, city name, or phone
        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('StoreName', 'like', "%{$search}%")
                    ->orWhere('Phone', 'like', "%{$search}%")
                    ->orWhereHas('City', function ($q2) use ($search) {
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
        return view('stores.show', ['store' => $store]);
    }

    public function edit(retail_store $store)
    {
        $Cities = City::all();

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

    public function listEmployees(Retail_Store $store)
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

    public function destroyemp(Retail_Store $store, employee $employee)
    {
        // Check if this employee is actually assigned to this store
        if ($employee->assignable_type === Retail_Store::class && $employee->assignable_id == $store->id) {
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

    public function assignEmployeesPage(Retail_Store $store)
    {
        // Employees not assigned to any store
        $employees = Employee::whereNull('assignable_id')
            ->whereNull('assignable_type')
            ->with('department', 'emp_role', 'person')
            ->paginate(10);

       // $departments = Department::all();

        return view('stores.assign-employees', [
            'store' => $store,
            'employees' => $employees,
            // 'departments' => $departments,
        ]);
    }

    public function assignSelectedEmployees(Request $request, Retail_Store $store)
    {
        $employeeIds = $request->input('employees', []);

        if (empty($employeeIds)) {
            return back()->with('error', 'Please select at least one employee.');
        }

        Employee::whereIn('id', $employeeIds)->update([
            'assignable_id' => $store->id,
            'assignable_type' => Retail_Store::class,
        ]);

        return redirect()->route('stores.employees', $store)
            ->with('success', 'Employees assigned successfully.');
    }
}
