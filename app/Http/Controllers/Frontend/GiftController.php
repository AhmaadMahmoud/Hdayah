<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GiftOption;
use App\Models\GiftOptionType;
use App\Models\Product;
use App\Models\Order;
use App\Services\PaymobService;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Str;

class GiftController extends Controller
{
    public function index(Request $request, Product $product): View
    {
        $product->load(['images', 'category:id,name']);

        $types = GiftOptionType::active()
            ->ordered()
            ->with(['options' => fn ($q) => $q->where('is_active', true)->orderBy('sort_order')->orderBy('name')])
            ->get();

        $defaults = [];
        $defaultsEnabled = [];
        foreach ($types as $type) {
            $opts = $type->options;
            if ($type->selection_mode === 'single' || $type->selection_mode === 'optional_single') {
                $default = $opts->firstWhere('is_default', true) ?? $opts->first();
                $defaults[$type->slug] = $default?->id;
                $defaultsEnabled[$type->slug] = (bool) $default;
            } else {
                $defaults[$type->slug] = $opts->where('is_default', true)->pluck('id')->all();
            }
        }

        return view('frontend.gifts.index', [
            'product' => $product,
            'types' => $types,
            'defaults' => $defaults,
            'defaultsEnabled' => $defaultsEnabled,
        ]);
    }

    public function checkout(Request $request, Product $product): View
    {
        $product->load(['images', 'category:id,name']);
        $selection = $this->buildSelection($request, $product);

        return view('frontend.gifts.checkout', array_merge($selection, [
            'product' => $product,
            'paymentMethod' => $request->input('payment_method', 'card'),
        ]));
    }

    public function pay(Request $request, Product $product, PaymobService $paymob): RedirectResponse|View
    {
        $product->load(['images', 'category:id,name']);
        $selection = $this->buildSelection($request, $product);

        $validated = $request->validate([
            'payment_method' => ['required', 'in:card,cash'],
        ]);

        if (!$paymob->isConfigured()) {
            return view('frontend.gifts.checkout', array_merge($selection, [
                'product' => $product,
                'paymentMethod' => $validated['payment_method'],
                'error' => __('Payment gateway is not configured. Please add Paymob credentials (PAYMOB_API_KEY, etc.) in .env and try again.'),
            ]));
        }

        $amountCents = (int) round($selection['total'] * 100);
        $billing = $this->defaultBillingData($request);

        $order = Order::create([
            'product_id' => $product->id,
            'user_id' => $request->user()?->id,
            'total' => $selection['total'],
            'payment_method' => $validated['payment_method'],
            'status' => $validated['payment_method'] === 'cash' ? Order::STATUS_CASH_PENDING : Order::STATUS_PENDING_PAYMENT,
            'meta' => $selection['meta_for_order'],
        ]);

        try {
            $orderId = $paymob->createOrder(
                $amountCents,
                $product->name,
                [
                    'merchant_order_id' => Str::uuid()->toString(),
                    'selection' => $selection['by_slug'],
                    'message' => $selection['message'],
                ],
                $billing
            );
        } catch (RequestException $e) {
            $this->logPaymobException($e, 'createOrder');
            $order->delete();
            return view('frontend.gifts.checkout', array_merge($selection, [
                'product' => $product,
                'paymentMethod' => $validated['payment_method'],
                'error' => __('Payment service is temporarily unavailable. Please try again later or choose another payment method.'),
            ]));
        }

        $order->update([
            'gateway_order_id' => $orderId,
        ]);

        if ($validated['payment_method'] === 'cash') {
            try {
                $cashBill = $paymob->createCashCollection(
                    $amountCents,
                    $orderId,
                    $billing,
                    config('services.paymob.integration_id_cash')
                );
            } catch (RequestException $e) {
                $this->logPaymobException($e, 'createCashCollection');
                return view('frontend.gifts.checkout', array_merge($selection, [
                    'product' => $product,
                    'paymentMethod' => 'cash',
                    'error' => __('Payment service is temporarily unavailable. Please try again later.'),
                ]));
            }

            return view('frontend.gifts.checkout', array_merge($selection, [
                'product' => $product,
                'paymentMethod' => 'cash',
                'cashBill' => $cashBill,
                'order' => $order,
            ]));
        }

        try {
            $paymentKey = $paymob->createPaymentKey(
                $amountCents,
                $orderId,
                $billing,
                config('services.paymob.integration_id_card')
            );
        } catch (RequestException $e) {
            $this->logPaymobException($e, 'createPaymentKey');
            return view('frontend.gifts.checkout', array_merge($selection, [
                'product' => $product,
                'paymentMethod' => 'card',
                'error' => __('Payment service is temporarily unavailable. Please try again later.'),
            ]));
        }

        $order->update([
            'status' => Order::STATUS_PENDING_PAYMENT,
        ]);

        return redirect()->away($paymob->iframeUrl($paymentKey));
    }

    private function buildSelection(Request $request, Product $product): array
    {
        $types = GiftOptionType::active()->ordered()->get();
        $selectionBySlug = [];
        $total = (float) $product->price;
        $metaForOrder = ['types_selection' => []];

        foreach ($types as $type) {
            $slug = $type->slug;
            $options = GiftOption::active()
                ->where('gift_option_type_id', $type->id)
                ->orderBy('sort_order')
                ->get();

            $idOrIds = null;
            $enabled = true;
            if ($slug === 'box') {
                $idOrIds = $request->input("selection.box") ?? $request->input('box_selection');
            } elseif ($slug === 'addon') {
                $idOrIds = $request->input("selection.addon") ?? $request->input('addons', []);
            } elseif ($slug === 'card') {
                $enabled = $request->boolean("selection_enabled.card") || $request->boolean('include_card');
                $idOrIds = $request->input("selection.card") ?? $request->input('gift_card');
            } else {
                $idOrIds = $request->input("selection.{$slug}");
                $enabled = $request->boolean("selection_enabled.{$slug}");
            }

            if ($type->selection_mode === 'single') {
                $id = is_array($idOrIds) ? ($idOrIds[0] ?? null) : $idOrIds;
                $option = $id ? $options->find($id) : null;
                if (!$option && $options->isNotEmpty()) {
                    $option = $options->firstWhere('is_default', true) ?? $options->first();
                }
                $selectionBySlug[$slug] = $option ? collect([$option]) : collect();
                $price = $option ? (float) $option->price : 0;
                $total += $price;
                $metaForOrder['types_selection'][$slug] = $option ? ['id' => $option->id, 'name' => $option->name, 'price' => $option->price] : null;
            } elseif ($type->selection_mode === 'multiple') {
                $ids = is_array($idOrIds) ? $idOrIds : ($idOrIds ? [$idOrIds] : []);
                $selected = $options->whereIn('id', $ids)->values();
                $selectionBySlug[$slug] = $selected;
                $price = $selected->sum('price');
                $total += $price;
                $metaForOrder['types_selection'][$slug] = $selected->map(fn ($o) => ['id' => $o->id, 'name' => $o->name, 'price' => $o->price])->all();
            } else {
                $id = is_array($idOrIds) ? ($idOrIds[0] ?? null) : $idOrIds;
                $option = $enabled && $id ? $options->find($id) : null;
                if ($enabled && !$option && $options->isNotEmpty()) {
                    $option = $options->firstWhere('is_default', true) ?? $options->first();
                }
                $selectionBySlug[$slug] = $option ? collect([$option]) : collect();
                $price = $option ? (float) $option->price : 0;
                $total += $price;
                $metaForOrder['types_selection'][$slug] = $option ? ['id' => $option->id, 'name' => $option->name, 'price' => $option->price] : null;
            }
        }

        $message = $request->input('message', '');
        $box = $selectionBySlug['box'][0] ?? null;
        $addons = $selectionBySlug['addon'] ?? collect();
        $card = $selectionBySlug['card'][0] ?? null;

        $metaForOrder['product_price'] = $product->price;
        $metaForOrder['box_id'] = $box?->id;
        $metaForOrder['box_name'] = $box?->name;
        $metaForOrder['box_price'] = $box ? (float) $box->price : 0;
        $metaForOrder['addons'] = $addons->map(fn ($o) => ['id' => $o->id, 'name' => $o->name, 'price' => $o->price])->values()->all();
        $metaForOrder['card_id'] = $card?->id;
        $metaForOrder['card_name'] = $card?->name;
        $metaForOrder['card_price'] = $card ? (float) $card->price : 0;
        $metaForOrder['include_card'] = $card !== null;
        $metaForOrder['message'] = $message;

        return [
            'by_slug' => $selectionBySlug,
            'total' => $total,
            'message' => $message,
            'meta_for_order' => $metaForOrder,
            'box' => $selectionBySlug['box'][0] ?? null,
            'addons' => $selectionBySlug['addon'] ?? collect(),
            'card' => $selectionBySlug['card'][0] ?? null,
            'includeCard' => ($selectionBySlug['card'][0] ?? null) !== null,
            'boxPrice' => ($selectionBySlug['box'][0] ?? null) ? (float)($selectionBySlug['box'][0]->price) : 0,
            'addonsPrice' => ($selectionBySlug['addon'] ?? collect())->sum('price'),
            'cardPrice' => ($selectionBySlug['card'][0] ?? null) ? (float)($selectionBySlug['card'][0]->price) : 0,
        ];
    }

    private function defaultBillingData(Request $request): array
    {
        $user = $request->user();

        $nameParts = $user?->name ? explode(' ', $user->name, 2) : [];
        $firstName = $nameParts[0] ?? ($user?->name ?? 'Guest');
        $lastName = $nameParts[1] ?? 'Customer';
        $email = $user?->email ?? 'guest@example.com';
        $phone = preg_replace('/\D+/', '', $user?->phone ?? '01000000000');

        return [
            'apartment' => 'NA',
            'email' => $email,
            'floor' => 'NA',
            'first_name' => $firstName,
            'street' => 'NA',
            'building' => 'NA',
            'phone_number' => $phone,
            'shipping_method' => 'PKG',
            'postal_code' => 'NA',
            'city' => 'Cairo',
            'country' => 'EG',
            'last_name' => $lastName,
            'state' => 'NA',
        ];
    }

    private function logPaymobException(RequestException $e, string $step): void
    {
        report($e);
        $response = $e->response;
        $uri = null;
        if ($response && method_exists($response, 'effectiveUri')) {
            $u = $response->effectiveUri();
            $uri = $u ? (string) $u : null;
        }
        $failingEndpoint = $uri ? (str_contains($uri, 'auth/tokens') ? 'auth (tokens)' : (str_contains($uri, 'ecommerce/orders') ? 'orders' : (str_contains($uri, 'payment_keys') ? 'payment_keys' : 'pay'))) : 'unknown';
        Log::error('Paymob API failed: ' . $step . ' | failing endpoint: ' . $failingEndpoint, [
            'message' => $e->getMessage(),
            'status' => $response?->status(),
            'body' => $response?->body(),
            'url' => $uri,
        ]);
    }
}
