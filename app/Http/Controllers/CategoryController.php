<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Services\ActivityLogger;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::withCount('products')
            ->when($request->search, fn ($q, $s) => $q->where('name', 'like', "%$s%"))
            ->orderBy('name')->paginate(15)->withQueryString();

        return view('categories.index', compact('categories'));
    }

    public function create()
    {
        $parents = Category::active()->orderBy('name')->get();

        return view('categories.create', compact('parents'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'status' => ['required', 'in:active,archived'],
        ]);

        $category = Category::create($data);
        ActivityLogger::log('create', "Created category: {$category->name}", $category);

        return redirect()->route('categories.index')->with('success', 'Category created.');
    }

    public function edit(Category $category)
    {
        $parents = Category::active()->where('id', '!=', $category->id)->orderBy('name')->get();

        return view('categories.edit', compact('category', 'parents'));
    }

    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'parent_id' => ['nullable', 'exists:categories,id'],
            'status' => ['required', 'in:active,archived'],
        ]);

        $category->update($data);
        ActivityLogger::log('update', "Updated category: {$category->name}", $category);

        return redirect()->route('categories.index')->with('success', 'Category updated.');
    }

    public function archive(Category $category)
    {
        $category->update(['status' => $category->status === 'archived' ? 'active' : 'archived']);
        ActivityLogger::log('update', "Toggled archive for category: {$category->name}", $category);

        return back()->with('success', 'Category status updated.');
    }

    public function destroy(Category $category)
    {
        $name = $category->name;
        $category->delete();
        ActivityLogger::log('delete', "Deleted category: {$name}", $category);

        return back()->with('success', 'Category deleted.');
    }
}
