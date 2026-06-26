<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $brands = Brand::withCount('products')
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%$s%"))
            ->orderBy('name')->paginate(15)->withQueryString();

        return view('brands.index', compact('brands'));
    }

    public function create()
    {
        return view('brands.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,archived'],
        ]);
        $brand = Brand::create($data);
        ActivityLogger::log('create', "Created brand: {$brand->name}", $brand);

        return redirect()->route('brands.index')->with('success', 'Brand created.');
    }

    public function edit(Brand $brand)
    {
        return view('brands.edit', compact('brand'));
    }

    public function update(Request $request, Brand $brand)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'status' => ['required', 'in:active,archived'],
        ]);
        $brand->update($data);
        ActivityLogger::log('update', "Updated brand: {$brand->name}", $brand);

        return redirect()->route('brands.index')->with('success', 'Brand updated.');
    }

    public function destroy(Brand $brand)
    {
        $name = $brand->name;
        $brand->delete();
        ActivityLogger::log('delete', "Deleted brand: {$name}", $brand);

        return back()->with('success', 'Brand deleted.');
    }
}
