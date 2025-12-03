<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\customer_type;
use App\Models\person;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $types = customer_type::all();

        $query = Customer::query()->with(['person', 'customer_type']);

        // Search filter
        if ($search = $request->input('search')) {
            $query->whereHas('person', function ($q) use ($search) {
                $q->where('FirstName', 'like', "%{$search}%")
                    ->orWhere('LastName', 'like', "%{$search}%")
                    ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Type filter
        if ($type = $request->input('type')) {
            $query->whereHas('customer_type', function ($q) use ($type) {
                $q->where('TypeName', $type);
            });
        }

        $customers = $query->paginate(10)->withQueryString();

        return view('customers.index', [
            'customers' => $customers,
            'types' => $types,
        ]);
    }

    public function create()
    {
        $types=customer_type::all();
        return view('customers.create',['types'=>$types]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate(
            [
                'FirstName' => ['required', 'min:5'],
                'LastName' => ['required', 'min:5'],
                'NationalId' => ['required', 'size:10'],
                'email' => ['required', 'email'],
                'phone_num' => ['required', 'size:10'],
                'BirthDate' => ['required', 'date', Rule::date()->beforeOrEqual(today()->subYears(18))],
                'customer_type_id' => ['required', 'exists:customer_types,id'],

            ],
            [
                'BirthDate.before_or_equal' => 'You should be above 18 years old.',
            ]
        );

        $person = person::create(Arr::except($attributes, ['customer_type_id']));
        $customer = customer::create([
            'person_id' => $person->id,
            'customer_type_id' => $attributes['customer_type_id'],
        ]);

        return redirect('/');

    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        return view('customers.show', ['customer' => $customer]);
    }

public function edit(customer $customer){
    $types=customer_type::all();
    return view('customers.edit',
    ['types'=>$types,
     'customer'=>$customer]);
}

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
         // authenticat

        $customer->delete();

        // redirect
        return redirect('/customers');
    }
}
