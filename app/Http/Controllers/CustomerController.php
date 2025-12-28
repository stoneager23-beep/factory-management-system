<?php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::latest()->paginate(20);
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|unique:customers,email',
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        Customer::create($validated);

        return redirect()->route('customers.index')->with('success', 'customers created successfully.');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'nullable|email|unique:customers,email,' . $customer->id,
            'phone'   => 'nullable|string|max:20',
            'address' => 'nullable|string',
        ]);

        $customer->update($validated);

        return redirect()->route('customers.index')->with('success', 'customers updated successfully.');
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();
        return back()->with('success', 'customers deleted.');
    }
}
