<?php

namespace App\Http\Controllers;

use App\Models\city;
use App\Models\department;
use App\Models\employee;
use App\Models\product;
use App\Models\retail_store;
use App\Models\warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

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
        $cities = city::all();

        return view('stores.create', [
            'cities' => $cities,
        ]);
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
                'city_id' => ['required', 'exists:cities,id'],
                'Brochure' => ['nullable', 'file', 'mimes:pdf'], // max 2MB
            ]
        );

        // handle file upload
        if ($request->hasFile('Brochure')) {
            $brochure_url = $request->file('Brochure')->store('brochures', 'public'); // store in 'storage/app/public/brochures'
        }
        // store
        retail_store::create(
            [
                'StoreName' => request('StoreName'),
                'Phone' => request('phone'),
                'Address' => request('Address'),
                'city_id' => request('city_id'),
                'Brochure_url' => $brochure_url ?? null,
            ]
        );

        // redirect
        return redirect('/');

    }

    /**
     * Display the specified resource.
     */
    public function show(retail_store $store)
    {
        $store->load(['city', 'manager.person', 'products']);

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
        // validate
        $request->validate([
            'store_name' => ['required', 'min:5'],
            'phone' => ['required', 'size:10'],
            'address' => ['required', 'min:10'],
            'city_id' => ['required', 'exists:cities,id'],
            'Brochure' => ['nullable', 'file', 'mimes:pdf'], // max 2MB
        ]);

        // handle file upload
        if ($request->hasFile('Brochure')) {
            // Delete old brochure if exists
            if ($store->Brochure_url && Storage::disk('public')->exists($store->Brochure_url)) {
                Storage::disk('public')->delete($store->Brochure_url);
            }
            $brochure_url = $request->file('Brochure')->store('brochures', 'public'); // store in 'storage/app/public/brochures'
        }
        $store->update([
            'StoreName' => $request->store_name,
            'Phone' => $request->phone,
            'Address' => $request->address,
            'city_id' => $request->city_id,
            'Brochure_url' => $brochure_url ?? $store->Brochure_url,
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

    public function download(retail_store $store)
    {
        if (! $store->Brochure_url || ! Storage::disk('public')->exists($store->Brochure_url)) {
            return redirect()->back()->with('error', 'Brochure not found.');
        }

        return response()->download(
            storage_path('app/public/'.$store->Brochure_url),
            $store->StoreName.'_Brochure.pdf'
        );
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
                return $emp->person->FirstName.' '.$emp->person->LastName;
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
                return $emp->person->FirstName.' '.$emp->person->LastName;
            })->implode(', ');

            return back()
                ->withInput()
                ->with('error', "The following employees are already assigned: {$names}. Please select unassigned employees only.");
        }

        // Verify employees have the correct roles (employee or marketer)
        $invalidRoles = $employees->filter(function ($emp) {
            return ! in_array($emp->emp_role->RoleName, ['employee', 'marketer']);
        });

        if ($invalidRoles->isNotEmpty()) {
            $names = $invalidRoles->map(function ($emp) {
                return $emp->person->FirstName.' '.$emp->person->LastName.' ('.$emp->emp_role->RoleName.')';
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
            return ! in_array($manager->id, $assignedManagerIds) || $manager->id === $store->manager_id;
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

    /**
     * Display page for linking warehouses to a store
     */
    public function linkWarehousesPage(retail_store $store)
    {
        // Get all warehouses and mark those already linked
        $warehouses = warehouse::with('city')->get();
        $linkedIds = $store->warehouses()->pluck('warehouses.id')->toArray();

        return view('stores.link-warehouses', [
            'store' => $store,
            'warehouses' => $warehouses,
            'linkedIds' => $linkedIds,
        ]);
    }

    /**
     * Link selected warehouses to the store
     */
    public function linkSelectedWarehouses(Request $request, retail_store $store)
    {
        $validated = $request->validate([
            'warehouses' => ['required', 'array', 'min:1'],
            'warehouses.*' => ['required', 'integer', 'exists:warehouses,id'],
        ], [
            'warehouses.required' => 'Please select at least one warehouse to link.',
            'warehouses.*.exists' => 'One or more selected warehouses do not exist.',
        ]);

        $warehouseIds = $validated['warehouses'];

        try {

            DB::transaction(function () use ($store, $warehouseIds) {
                // Attach the selected warehouses without removing existing links
                $store->warehouses()->syncWithoutDetaching($warehouseIds);
            });

            $count = count($warehouseIds);
            $message = $count === 1 ? 'Warehouse linked successfully.' : "{$count} warehouses linked successfully.";

            return redirect()->route('stores.show', $store)->with('success', $message);
        } catch (\Exception $e) {
            return back()->withInput()->with('error', 'An error occurred while linking warehouses. Please try again.');
        }
    }

    /**
     * Unlink a warehouse from the store
     */
    public function unlinkWarehouse(retail_store $store, warehouse $warehouse)
    {
        // Check if linked
        if (! $store->warehouses()->where('warehouses.id', $warehouse->id)->exists()) {
            return back()->with('error', 'This warehouse is not linked to the store.');
        }

        try {
            DB::transaction(function () use ($store, $warehouse) {
                $store->warehouses()->detach($warehouse->id);
            });

            return redirect()->route('stores.show', $store)->with('success', 'Warehouse unlinked successfully.');
        } catch (\Exception $e) {
            return back()->with('error', 'An error occurred while unlinking the warehouse. Please try again.');
        }
    }

    public function removeManager(retail_store $store)
    {
        if (! $store->manager_id) {
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

    /**
     * Display products in a retail store with pagination, search, and filtering
     */
    public function listProducts(retail_store $store, Request $request)
    {
        // Start query from the relationship
        $query = $store->products();

        // Search by product name
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        // Paginate the results
        $products = $query->paginate(10)->withQueryString();

        return view('stores.products', [
            'products' => $products,
            'store' => $store,
        ]);
    }

    /**
     * Display page for assigning products to store
     */
    public function assignProductsPage(retail_store $store, Request $request)
    {
        // Get products not already assigned to this store and present in linked warehouses
        $assignedProductIds = $store->products()->pluck('products.id')->toArray();

        // Get warehouses linked to this store
        $warehouseIds = $store->warehouses()->pluck('warehouses.id')->toArray();

        // Build query: products that exist in any of the linked warehouses
        if (! empty($warehouseIds)) {
            $query = product::whereHas('warehouses', function ($q) use ($warehouseIds) {
                $q->whereIn('warehouses.id', $warehouseIds);
            });
        } else {
            // No linked warehouses -> no products available for assignment
            $query = product::whereRaw('0 = 1');
        }

        if (! empty($assignedProductIds)) {
            $query->whereNotIn('id', $assignedProductIds);
        }

        // Search by product name
        if ($search = $request->input('search')) {
            $query->where('name', 'like', "%{$search}%");
        }

        $products = $query->paginate(10)->withQueryString();

        return view('stores.assign-products', [
            'store' => $store,
            'products' => $products,
        ]);
    }

    /**
     * Assign products to store with quantities
     */
    public function assignProducts(Request $request, retail_store $store)
    {
        // Get the products array from request (it's keyed by product ID)
        $productsData = $request->input('products', []);
        $productCheckboxes = $request->input('product_checkbox', []);

        // Filter only checked products
        $selectedProducts = [];
        foreach ($productCheckboxes as $productId) {
            if (isset($productsData[$productId]) && isset($productsData[$productId]['quantity'])) {
                $selectedProducts[$productId] = [
                    'id' => (int) $productId,
                    'quantity' => (int) $productsData[$productId]['quantity'],
                ];
            }
        }

        // Validate that at least one product is selected
        if (empty($selectedProducts)) {
            return back()
                ->withInput()
                ->with('error', 'Please select at least one product to assign.');
        }

        // Validate each product
        $validated = $request->validate([
            'products' => ['required', 'array'],
        ]);

        foreach ($selectedProducts as $productId => $productData) {
            $request->validate([
                "products.{$productId}.id" => ['required', 'integer', 'exists:products,id'],
                "products.{$productId}.quantity" => ['required', 'integer', 'min:1'],
            ], [
                "products.{$productId}.id.required" => 'Invalid product selection.',
                "products.{$productId}.id.exists" => 'One or more selected products do not exist.',
                "products.{$productId}.quantity.required" => 'Quantity is required for all products.',
                "products.{$productId}.quantity.integer" => 'Quantity must be an integer.',
                "products.{$productId}.quantity.min" => 'Quantity must be 0 or greater.',
            ]);
        }

        $productIds = array_column($selectedProducts, 'id');

        // Ensure store is linked to warehouses and selected products exist in linked warehouses
        $warehouseIds = $store->warehouses()->pluck('warehouses.id')->toArray();
        if (empty($warehouseIds)) {
            return back()
                ->withInput()
                ->with('error', 'This store is not linked to any warehouse. Please link at least one warehouse before assigning products.');
        }

        $availableProductIds = product::whereHas('warehouses', function ($q) use ($warehouseIds) {
            $q->whereIn('warehouses.id', $warehouseIds);
        })->pluck('id')->toArray();

        $notAllowed = array_diff($productIds, $availableProductIds);
        if (! empty($notAllowed)) {
            $names = product::whereIn('id', $notAllowed)->pluck('name')->implode(', ');

            return back()
                ->withInput()
                ->with('error', "The following products are not available in the linked warehouse(s): {$names}.");
        }

        // Check if any products are already assigned to this store
        $assignedProductIds = $store->products()->whereIn('products.id', $productIds)->pluck('products.id')->toArray();
        if (! empty($assignedProductIds)) {
            $assignedProducts = product::whereIn('id', $assignedProductIds)->pluck('name')->implode(', ');

            return back()
                ->withInput()
                ->with('error', "The following products are already assigned to this store: {$assignedProducts}.");
        }

        try {
            DB::transaction(function () use ($store, $selectedProducts) {
                $syncData = [];
                foreach ($selectedProducts as $productData) {
                    $syncData[$productData['id']] = ['amount' => $productData['quantity']];
                }
                $store->products()->syncWithoutDetaching($syncData);
            });

            $count = count($selectedProducts);
            $message = $count === 1
                ? 'Product assigned successfully.'
                : "{$count} products assigned successfully.";

            return redirect()->route('stores.products', $store)
                ->with('success', $message);
        } catch (\Exception $e) {
            return back()
                ->withInput()
                ->with('error', 'An error occurred while assigning products. Please try again.');
        }
    }

    /**
     * Update quantity of a product in a store
     */
    public function updateProductQuantity(Request $request, retail_store $store, product $product)
    {
        // Verify product is assigned to this store
        if (! $store->products()->where('products.id', $product->id)->exists()) {
            return back()
                ->with('error', 'This product is not assigned to this store.');
        }

        $validated = $request->validate([
            'quantity' => [
                'required',
                'integer',
                'min:0',
            ],
        ], [
            'quantity.required' => 'Quantity is required.',
            'quantity.integer' => 'Quantity must be an integer.',
            'quantity.min' => 'Quantity must be 0 or greater.',
        ]);

        try {
            DB::transaction(function () use ($store, $product, $validated) {
                $store->products()->updateExistingPivot($product->id, [
                    'amount' => $validated['quantity'],
                ]);
            });

            return redirect()->route('stores.products', $store)
                ->with('success', 'Product quantity updated successfully.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'An error occurred while updating the product quantity. Please try again.');
        }
    }

    /**
     * Remove a product from a store
     */
    public function removeProduct(retail_store $store, product $product)
    {
        // Verify product is assigned to this store
        if (! $store->products()->where('products.id', $product->id)->exists()) {
            return back()
                ->with('error', 'This product is not assigned to this store.');
        }

        try {
            DB::transaction(function () use ($store, $product) {
                $store->products()->detach($product->id);
            });

            return redirect()->route('stores.products', $store)
                ->with('success', 'Product removed from store successfully.');
        } catch (\Exception $e) {
            return back()
                ->with('error', 'An error occurred while removing the product. Please try again.');
        }
    }
}
