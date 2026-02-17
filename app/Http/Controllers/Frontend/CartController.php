<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * السلة من الجلسة: [ product_id => quantity ]
     */
    private function getCart(): array
    {
        return session('cart', []);
    }

    private function saveCart(array $cart): void
    {
        session(['cart' => $cart]);
    }

    /**
     * إضافة منتج للسلة (أو تحديث الكمية).
     */
    public function add(Request $request, Product $product)
    {
        $qty = (int) $request->input('quantity', 1);
        $qty = max(1, min($product->stock ?? 999, $qty));

        $cart = $this->getCart();
        $cart[$product->id] = ($cart[$product->id] ?? 0) + $qty;
        $this->saveCart($cart);

        if ($request->wantsJson()) {
            return response()->json([
                'ok' => true,
                'message' => 'تمت الإضافة إلى السلة',
                'cart_count' => array_sum($cart),
            ]);
        }

        return redirect()->route('cart.index')
            ->with('success', 'تمت الإضافة إلى السلة');
    }

    /**
     * عرض صفحة السلة.
     */
    public function index()
    {
        $cart = $this->getCart();
        $productIds = array_keys($cart);
        $products = Product::with(['images', 'category'])
            ->whereIn('id', $productIds)
            ->get()
            ->keyBy('id');

        $items = [];
        $total = 0;
        foreach ($cart as $id => $qty) {
            $product = $products->get($id);
            if (!$product) {
                continue;
            }
            $items[] = (object) [
                'product' => $product,
                'quantity' => $qty,
                'subtotal' => $product->price * $qty,
            ];
            $total += $product->price * $qty;
        }

        return view('frontend.cart.index', compact('items', 'total'));
    }

    /**
     * تحديث كمية صنف في السلة.
     */
    public function update(Request $request, Product $product)
    {
        $qty = (int) $request->input('quantity', 1);
        $cart = $this->getCart();

        if ($qty < 1) {
            unset($cart[$product->id]);
        } else {
            $cart[$product->id] = min($qty, $product->stock ?? 999);
        }
        $this->saveCart($cart);

        if ($request->wantsJson()) {
            return response()->json([
                'ok' => true,
                'cart_count' => array_sum($cart),
            ]);
        }

        return redirect()->route('cart.index');
    }

    /**
     * حذف صنف من السلة.
     */
    public function remove(Product $product)
    {
        $cart = $this->getCart();
        unset($cart[$product->id]);
        $this->saveCart($cart);

        return redirect()->route('cart.index')
            ->with('success', 'تم حذف المنتج من السلة');
    }
}
