<?php
namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ProductController extends Controller
{
    public function index(Request $request): View
    {
        $query = Product::with(['images', 'category:id,name'])->latest();

        if ($request->filled('category_id')) {
            $query->where('category_id', $request->integer('category_id'));
        }

        $products = $query->get();

        return view('frontend.products.index', compact('products'));
    }

    public function show(Product $product): View
    {
        $product->load(['images', 'category:id,name']);

        $relatedQuery = Product::with('images')->whereKeyNot($product->id);

        if ($product->category_id) {
            $relatedQuery->where('category_id', $product->category_id);
        }

        $related = $relatedQuery->latest()->take(4)->get();

        return view('frontend.products.show', compact('product', 'related'));
    }
}