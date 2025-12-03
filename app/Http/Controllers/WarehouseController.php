<?php

namespace App\Http\Controllers;

use App\Models\warehouse;
use Illuminate\Http\Request;
use App\Models\city;

class WarehouseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $request)
{
    $cities = City::all(); // all cities for the dropdown

    // Start a query on the retail_store model
    $query = warehouse::with('City'); // eager load the related City

    // Search by store name, city name, or phone
    if ($search = $request->input('search')) {
        $query->where(function ($q) use ($search) {
            $q->where('WarehouseName', 'like', "%{$search}%")
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
         return view('warehouses.show', ['warehouse' => $warehouse]);
    }


    public function edit(warehouse $warehouse){
          $Cities = City::all();

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
}
