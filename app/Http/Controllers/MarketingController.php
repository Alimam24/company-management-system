<?php

namespace App\Http\Controllers;

use App\Models\customer;
use App\Models\customer_type;
use App\Models\employee;
use App\Models\MarketingEmployeeCustomer;
use App\Models\Offer;
use Illuminate\Http\Request;

class MarketingController extends Controller
{
    /**
     * Show form to assign marketing employee to VIP customer
     */
    public function assignEmployeePage(customer $customer)
    {
        // Verify customer is VIP
        if ($customer->customer_type->TypeName !== 'VIP') {
            return redirect()->route('customers.show', $customer)
                ->with('error', 'Only VIP customers can be assigned to marketing employees.');
        }

        // Get all marketing employees (employees with marketer role)
        $marketingEmployees = employee::whereHas('emp_role', function ($q) {
            $q->where('RoleName', 'marketer');
        })
            ->with(['person', 'department'])
            ->get();

        // Check if customer already has a marketing employee
        $currentAssignment = MarketingEmployeeCustomer::where('customer_id', $customer->id)->first();

        return view('marketing.assign-employee', [
            'customer' => $customer,
            'marketingEmployees' => $marketingEmployees,
            'currentAssignment' => $currentAssignment,
        ]);
    }

    /**
     * Assign marketing employee to VIP customer
     */
    public function assignEmployee(Request $request, customer $customer)
    {
        // Verify customer is VIP
        if ($customer->customer_type->TypeName !== 'VIP') {
            return redirect()->route('customers.show', $customer)
                ->with('error', 'Only VIP customers can be assigned to marketing employees.');
        }

        $validated = $request->validate([
            'employee_id' => [
                'required',
                'integer',
                'exists:employees,id',
            ],
        ]);

        // Verify employee is a marketer
        $employee = employee::with('emp_role')->findOrFail($validated['employee_id']);
        if ($employee->emp_role->RoleName !== 'marketer') {
            return back()
                ->withInput()
                ->with('error', 'Selected employee must be a marketer.');
        }

        // Check if customer already has an assignment
        $existingAssignment = MarketingEmployeeCustomer::where('customer_id', $customer->id)->first();
        
        if ($existingAssignment) {
            // Update existing assignment
            $existingAssignment->update(['employee_id' => $validated['employee_id']]);
            $message = 'Marketing employee assignment updated successfully.';
        } else {
            // Create new assignment
            MarketingEmployeeCustomer::create([
                'customer_id' => $customer->id,
                'employee_id' => $validated['employee_id'],
            ]);
            $message = 'Marketing employee assigned successfully.';
        }

        return redirect()->route('customers.show', $customer)
            ->with('success', $message);
    }

    /**
     * Remove marketing employee assignment
     */
    public function removeEmployee(customer $customer)
    {
        $assignment = MarketingEmployeeCustomer::where('customer_id', $customer->id)->first();

        if ($assignment) {
            $assignment->delete();
            return redirect()->route('customers.show', $customer)
                ->with('success', 'Marketing employee assignment removed successfully.');
        }

        return redirect()->route('customers.show', $customer)
            ->with('error', 'No marketing employee assignment found.');
    }

    /**
     * Display list of offers
     */
    public function offersIndex(Request $request)
    {
        $query = Offer::with('customer_type');

        // Filter by active status
        if ($request->has('active')) {
            $query->where('IsActive', $request->boolean('active'));
        }

        // Search by title
        if ($search = $request->input('search')) {
            $query->where('Title', 'like', "%{$search}%");
        }

        $offers = $query->paginate(10)->withQueryString();
        $customerTypes = customer_type::all();

        return view('marketing.offers.index', [
            'offers' => $offers,
            'customerTypes' => $customerTypes,
        ]);
    }

    /**
     * Show form to create offer
     */
    public function createOffer()
    {
        $customerTypes = customer_type::all();

        return view('marketing.offers.create', [
            'customerTypes' => $customerTypes,
        ]);
    }

    /**
     * Store new offer
     */
    public function storeOffer(Request $request)
    {
        $validated = $request->validate([
            'Title' => ['required', 'string', 'min:3', 'max:255'],
            'Description' => ['nullable', 'string'],
            'customer_type_id' => ['nullable', 'exists:customer_types,id'],
            'StartDate' => ['required', 'date'],
            'EndDate' => ['nullable', 'date', 'after_or_equal:StartDate'],
            'IsActive' => ['boolean'],
        ]);

        Offer::create($validated);

        return redirect()->route('marketing.offers.index')
            ->with('success', 'Offer created successfully.');
    }

    /**
     * Show offer details
     */
    public function showOffer(Offer $offer)
    {
        $offer->load(['customer_type', 'customers.person', 'customers.customer_type']);

        return view('marketing.offers.show', [
            'offer' => $offer,
        ]);
    }

    /**
     * Show form to edit offer
     */
    public function editOffer(Offer $offer)
    {
        $customerTypes = customer_type::all();

        return view('marketing.offers.edit', [
            'offer' => $offer,
            'customerTypes' => $customerTypes,
        ]);
    }

    /**
     * Update offer
     */
    public function updateOffer(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'Title' => ['required', 'string', 'min:3', 'max:255'],
            'Description' => ['nullable', 'string'],
            'customer_type_id' => ['nullable', 'exists:customer_types,id'],
            'StartDate' => ['required', 'date'],
            'EndDate' => ['nullable', 'date', 'after_or_equal:StartDate'],
            'IsActive' => ['boolean'],
        ]);

        $offer->update($validated);

        return redirect()->route('marketing.offers.show', $offer)
            ->with('success', 'Offer updated successfully.');
    }

    /**
     * Show form to assign offer to customers
     */
    public function assignOfferPage(Offer $offer)
    {
        $offer->load('customer_type');

        // Get customers based on offer's target type
        $query = customer::with(['person', 'customer_type']);

        if ($offer->customer_type_id) {
            // If offer targets specific customer type, show only those customers
            $query->where('customer_type_id', $offer->customer_type_id);
        }

        // Exclude customers who already have this offer
        $assignedCustomerIds = $offer->customers()->pluck('customers.id');
        if ($assignedCustomerIds->isNotEmpty()) {
            $query->whereNotIn('id', $assignedCustomerIds);
        }

        $customers = $query->paginate(10);

        return view('marketing.offers.assign', [
            'offer' => $offer,
            'customers' => $customers,
        ]);
    }

    /**
     * Assign offer to selected customers
     */
    public function assignOffer(Request $request, Offer $offer)
    {
        $validated = $request->validate([
            'customers' => [
                'required',
                'array',
                'min:1',
            ],
            'customers.*' => [
                'required',
                'integer',
                'exists:customers,id',
            ],
        ]);

        $customerIds = $validated['customers'];

        // Verify customers match offer's target type if specified
        if ($offer->customer_type_id) {
            $invalidCustomers = customer::whereIn('id', $customerIds)
                ->where('customer_type_id', '!=', $offer->customer_type_id)
                ->pluck('id');

            if ($invalidCustomers->isNotEmpty()) {
                return back()
                    ->withInput()
                    ->with('error', 'Some selected customers do not match the offer\'s target customer type.');
            }
        }

        // Attach customers to offer
        $offer->customers()->attach($customerIds, ['AssignedDate' => now()]);

        return redirect()->route('marketing.offers.show', $offer)
            ->with('success', 'Offer assigned to selected customers successfully.');
    }

    /**
     * Remove offer from customer
     */
    public function removeOfferFromCustomer(Offer $offer, customer $customer)
    {
        $offer->customers()->detach($customer->id);

        return redirect()->route('marketing.offers.show', $offer)
            ->with('success', 'Offer removed from customer successfully.');
    }

    /**
     * Delete offer
     */
    public function destroyOffer(Offer $offer)
    {
        $offer->delete();

        return redirect()->route('marketing.offers.index')
            ->with('success', 'Offer deleted successfully.');
    }
}

