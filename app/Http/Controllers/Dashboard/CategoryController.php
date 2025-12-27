<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoryController extends Controller
{
    public function index(): View
    {
        $categories = Category::latest()->get();

        return view('dashboard.categories.index', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:categories,name'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $imagePath = $request->file('image')?->store('categories', 'public');

        Category::create([
            'name' => $data['name'],
            'image' => $imagePath,
        ]);

        return back()->with('status', 'تم إضافة القسم.');
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:120', 'unique:categories,name,' . $category->id],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
            if ($category->image) {
                Storage::disk('public')->delete($category->image);
            }
        }

        $category->update([
            'name' => $data['name'],
            'image' => $imagePath,
        ]);

        return back()->with('status', 'تم تحديث القسم.');
    }

    public function destroy(Category $category): RedirectResponse
    {
        if ($category->image) {
            Storage::disk('public')->delete($category->image);
        }

        $category->delete();

        return back()->with('status', 'تم حذف القسم.');
    }
}
