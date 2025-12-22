<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\Customer_state;
use App\Models\customer_type;
use App\Models\person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
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
        $types = customer_type::all();
        $states = Customer_state::all();

        return view('customers.create',
            [
                'types' => $types,
                'states' => $states,
            ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $attributes = $request->validate(
            [
                'FirstName' => ['required', 'min:3'],
                'LastName' => ['required', 'min:3'],
                'NationalId' => ['required', 'size:11'],
                'email' => ['required', 'email'],
                'phone_num' => ['required', 'size:10'],
                'BirthDate' => ['required', 'date', Rule::date()->beforeOrEqual(today()->subYears(18))],
                'customer_type_id' => ['required', 'exists:customer_types,id'],
                'customer_state_id' => ['required', 'exists:customer_states,id'],
                'avatar' => ['nullable', 'image'], // max 2MB:  'max:2048'

            ],
            [
                'BirthDate.before_or_equal' => 'You should be above 18 years old.',
            ]
        );

        $avarar_url = request('avatar')->store('avatars', 'public');

        $person = person::create(
            [
                'FirstName' => request('FirstName'),
                'LastName' => request('LastName'),
                'NationalId' => request('NationalId'),
                'email' => request('email'),
                'phone_num' => request('phone_num'),
                'BirthDate' => request('BirthDate'),
                'avatar_url' => $avarar_url,
            ]
        );
        $customer = customer::create([
            'person_id' => $person->id,
            'customer_type_id' => $attributes['customer_type_id'],
            'customer_state_id' => $attributes['customer_state_id'],
        ]);

        return redirect('/');

    }

    /**
     * Display the specified resource.
     */
    public function show(customer $customer)
    {
        $customer->load(['marketingEmployee.employee.person', 'marketingEmployee.employee.department', 'offers']);
        return view('customers.show', ['customer' => $customer]);
    }

    public function edit(customer $customer)
    {
        $types = customer_type::all();
        $states = Customer_state::all();

        return view('customers.edit',
            [
                'types' => $types,
                'customer' => $customer,
                'states' => $states,
            ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, customer $customer)
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
                'customer_type_id' => ['required', 'exists:customer_types,id'],
                'customer_state_id' => ['required', 'exists:customer_states,id'],
                'avatar' => ['nullable', 'image'], // max 2MB:  'max:2048'
            ],
            [
                'BirthDate.before_or_equal' => 'You should be above 18 years old.',
            ]
        );

        // Only store a new avatar if the user uploaded one
        if ($request->hasFile('avatar')) {
            // Optionally delete old avatar if it exists
            if ($customer->person->avatar_url) {
                Storage::disk('public')->delete($customer->person->avatar_url);
            }

            // Store new avatar
            $avarar_url = request('avatar')->store('avatars', 'public');

        } else {
            // Keep the existing avatar URL if no new file is uploaded
            $avarar_url = $customer->person->avatar_url;

        }

        // db record updating
        $customer->person->update([
            'FirstName' => request('FirstName'),
            'LastName' => request('LastName'),
            'NationalId' => request('NationalId'),
            'email' => request('email'),
            'phone_num' => request('phone_num'),
            'BirthDate' => request('BirthDate'),
            'avatar_url' => $avarar_url,

        ]);
        $customer->update([
            'customer_type_id' => request('customer_type_id'),
            'customer_state_id' => request('customer_state_id'),
        ]);

        // redirect
        return redirect("/customers/$customer->id");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(customer $customer)
    {
        if($customer->marketingEmployee()->exists()){
            return redirect("/customers/$customer->id")->withErrors(['error' => 'Cannot delete customer associated with marketing employees or offers.']);
        }

        $customer->delete();

        // redirect
        return redirect('/customers');
    }

    public function changeState(customer $customer)
    {
        $states = Customer_state::all();

        return view('customers.change-state', [
            'customer' => $customer,
            'states' => $states,
        ]);
    }

    public function updateState(customer $customer)
    {
        // validate
        request()->validate(
            [
                'customer_state_id' => ['required', 'exists:customer_states,id'],
            ]
        );

        $customer->update([
            'customer_state_id' => request('customer_state_id'),
        ]);

        return redirect("/customers/$customer->id");

    }
}
