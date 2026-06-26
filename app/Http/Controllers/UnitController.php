<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index()
    {
        $units = Unit::withCount('products')->orderBy('name')->paginate(20);

        return view('units.index', compact('units'));
    }

    public function create()
    {
        return view('units.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'abbreviation' => ['required', 'string', 'max:20'],
        ]);
        $unit = Unit::create($data);
        ActivityLogger::log('create', "Created unit: {$unit->name}", $unit);

        return redirect()->route('units.index')->with('success', 'Unit created.');
    }

    public function edit(Unit $unit)
    {
        return view('units.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:100'],
            'abbreviation' => ['required', 'string', 'max:20'],
        ]);
        $unit->update($data);
        ActivityLogger::log('update', "Updated unit: {$unit->name}", $unit);

        return redirect()->route('units.index')->with('success', 'Unit updated.');
    }

    public function destroy(Unit $unit)
    {
        $unit->delete();
        ActivityLogger::log('delete', "Deleted unit: {$unit->name}", $unit);

        return back()->with('success', 'Unit deleted.');
    }
}
