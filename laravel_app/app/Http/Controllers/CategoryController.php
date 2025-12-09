<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Notification;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('sort_order')->paginate(15);
        return view('admin.categories', compact('categories'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'icon' => 'nullable|string|max:50',
            'color' => 'nullable|string|max:20',
        ]);

        $validated['slug'] = Str::slug($validated['name']);
        $validated['is_active'] = true;

        $category = Category::create($validated);

        Notification::createNotification(
            auth()->id(),
            'Category Created',
            "Category '{$category->name}' has been created.",
            'success',
            'fa-folder-plus'
        );

        return redirect()->route('admin.categories')
            ->with('success', 'Category created successfully!');
    }

    public function destroy(Category $category)
    {
        $name = $category->name;
        $category->delete();

        Notification::createNotification(
            auth()->id(),
            'Category Deleted',
            "Category '{$name}' has been deleted.",
            'warning',
            'fa-folder-minus'
        );

        return redirect()->route('admin.categories')
            ->with('success', 'Category deleted successfully!');
    }
}
