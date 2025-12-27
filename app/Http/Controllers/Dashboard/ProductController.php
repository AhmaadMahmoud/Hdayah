<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    /**
     * List products with images.
     */
    public function index(Request $request): View
    {
        $query = Product::with(['images', 'category:id,name']);

        $search = $request->get('q');
        $categoryFilter = $request->get('category_id');
        $stockFilter = $request->get('stock_status');

        $query->when($search, function ($q) use ($search) {
            $q->where(function ($sub) use ($search) {
                $sub->where('name', 'like', '%' . $search . '%')
                    ->orWhere('description', 'like', '%' . $search . '%');
            });
        });

        $query->when($categoryFilter, function ($q) use ($categoryFilter) {
            $q->where('category_id', $categoryFilter);
        });

        $query->when($stockFilter, function ($q) use ($stockFilter) {
            if ($stockFilter === 'instock') {
                $q->where('stock', '>', 5);
            } elseif ($stockFilter === 'low') {
                $q->whereBetween('stock', [1, 5]);
            } elseif ($stockFilter === 'out') {
                $q->where('stock', '=', 0);
            }
        });

        $products = $query->latest()->get();
        $categories = Category::orderBy('name')->get();

        return view('dashboard.products.index', compact('products', 'categories', 'search', 'categoryFilter', 'stockFilter'));
    }

    /**
     * Store a new product and its gallery.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'publish' => ['nullable', 'boolean'],
            'images' => ['required', 'array', 'min:1'],
            'images.*' => ['image', 'max:4096'],
        ]);

        $product = Product::create([
            'name' => $data['name'],
            'category_id' => $data['category_id'] ?? null,
            'price' => $data['price'],
            'cost' => $data['cost'] ?? null,
            'stock' => $data['stock'],
            'description' => $data['description'] ?? null,
            'is_published' => $request->boolean('publish'),
        ]);

        foreach ($request->file('images', []) as $index => $image) {
            $path = $image->store('products', 'public');

            $product->images()->create([
                'path' => $path,
                'is_primary' => $index === 0,
                'sort_order' => $index,
            ]);
        }

        return back()->with('status', 'تم إضافة المنتج بنجاح.');
    }

    /**
     * Update a product (data + optional new images).
     */
    public function update(Request $request, Product $product): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'category_id' => ['nullable', 'exists:categories,id'],
            'price' => ['required', 'numeric', 'min:0'],
            'cost' => ['nullable', 'numeric', 'min:0'],
            'stock' => ['required', 'integer', 'min:0'],
            'description' => ['nullable', 'string'],
            'publish' => ['nullable', 'boolean'],
            'images' => ['nullable', 'array'],
            'images.*' => ['image', 'max:4096'],
        ]);

        $product->update([
            'name' => $data['name'],
            'category_id' => $data['category_id'] ?? null,
            'price' => $data['price'],
            'cost' => $data['cost'] ?? null,
            'stock' => $data['stock'],
            'description' => $data['description'] ?? null,
            'is_published' => $request->boolean('publish'),
        ]);

        if ($request->hasFile('images')) {
            foreach ($request->file('images', []) as $index => $image) {
                $path = $image->store('products', 'public');

                $product->images()->create([
                    'path' => $path,
                    'is_primary' => $index === 0 && $product->images()->count() === 0,
                    'sort_order' => $product->images()->count() + $index,
                ]);
            }
        }

        return back()->with('status', 'تم تحديث المنتج بنجاح.');
    }

    /**
     * Delete product and its images.
     */
    public function destroy(Product $product): RedirectResponse
    {
        foreach ($product->images as $image) {
            Storage::disk('public')->delete($image->path);
        }

        $product->delete();

        return back()->with('status', 'تم حذف المنتج.');
    }
}
