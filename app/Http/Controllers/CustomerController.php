<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $customers = Customer::withCount('orders')
                           ->with(['orders' => function($query) {
                               $query->latest()->take(1);
                           }])
                           ->latest()
                           ->get();
        
        return view('customers.index', compact('customers'));
    }

    public function create()
    {
        return view('customers.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers',
            'phone_number' => 'required|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        if ($request->hasFile('avatar')) {
            $validated['avatar'] = $request->file('avatar')->store('customers', 'public');
        }

        Customer::create($validated);
        return redirect()->route('customers.index')->with('success', 'Customer created successfully!');
    }

    public function show(Customer $customer)
    {
        $customer->load('orders.items.product');
        return view('customers.show', compact('customer'));
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', compact('customer'));
    }

    public function update(Request $request, Customer $customer)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email,' . $customer->id,
            'phone_number' => 'required|string|max:20',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg|max:1024'
        ]);

        if ($request->hasFile('avatar')) {
            if ($customer->avatar) {
                \Storage::disk('public')->delete($customer->avatar);
            }
            $validated['avatar'] = $request->file('avatar')->store('customers', 'public');
        }

        $customer->update($validated);
        return redirect()->route('customers.index')->with('success', 'Customer updated successfully!');
    }

    public function destroy(Customer $customer)
    {
        if ($customer->orders()->count() > 0) {
            return redirect()->route('customers.index')->with('error', 'Cannot delete customer with existing orders!');
        }

        if ($customer->avatar) {
            \Storage::disk('public')->delete($customer->avatar);
        }

        $customer->delete();
        return redirect()->route('customers.index')->with('success', 'Customer deleted successfully!');
    }

    public function search(Request $request)
    {
        $query = $request->get('q');
        $customers = Customer::where('name', 'LIKE', "%{$query}%")
                           ->orWhere('email', 'LIKE', "%{$query}%")
                           ->limit(10)
                           ->get();
        return response()->json($customers);
    }
}
