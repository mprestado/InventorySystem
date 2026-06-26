<?php

namespace App\Http\Controllers;

use App\Models\Supplier;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
    public function index(Request $request)
    {
        $suppliers = Supplier::withCount('products')
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%$s%")
                ->orWhere('contact_person', 'like', "%$s%"))
            ->orderBy('name')->paginate(15)->withQueryString();

        return view('suppliers.index', compact('suppliers'));
    }

    public function create()
    {
        return view('suppliers.create');
    }

    public function store(Request $request)
    {
        $supplier = Supplier::create($this->validateData($request));
        ActivityLogger::log('create', "Created supplier: {$supplier->name}", $supplier);

        return redirect()->route('suppliers.index')->with('success', 'Supplier created.');
    }

    public function show(Supplier $supplier)
    {
        $supplier->load(['purchaseOrders' => fn ($q) => $q->latest()->limit(10), 'products']);

        return view('suppliers.show', compact('supplier'));
    }

    public function edit(Supplier $supplier)
    {
        return view('suppliers.edit', compact('supplier'));
    }

    public function update(Request $request, Supplier $supplier)
    {
        $supplier->update($this->validateData($request));
        ActivityLogger::log('update', "Updated supplier: {$supplier->name}", $supplier);

        return redirect()->route('suppliers.index')->with('success', 'Supplier updated.');
    }

    public function destroy(Supplier $supplier)
    {
        $name = $supplier->name;
        $supplier->delete();
        ActivityLogger::log('delete', "Deleted supplier: {$name}", $supplier);

        return back()->with('success', 'Supplier deleted.');
    }

    private function validateData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'contact_person' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:50'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:active,archived'],
        ]);
    }
}
