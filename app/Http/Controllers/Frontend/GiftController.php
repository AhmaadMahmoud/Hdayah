<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GiftOption;
use App\Models\Product;
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

        $boxes = GiftOption::active()
            ->ofType(GiftOption::TYPE_BOX)
            ->orderBy('sort_order')
            ->get();

        $addons = GiftOption::active()
            ->ofType(GiftOption::TYPE_ADDON)
            ->orderBy('sort_order')
            ->get();

        $cards = GiftOption::active()
            ->ofType(GiftOption::TYPE_CARD)
            ->orderBy('sort_order')
            ->get();

        $defaultBoxId = optional($boxes->firstWhere('is_default', true) ?? $boxes->first())->id;
        $defaultCardId = optional($cards->firstWhere('is_default', true) ?? $cards->first())->id;

        return view('frontend.gifts.index', [
            'product' => $product,
            'boxes' => $boxes,
            'addons' => $addons,
            'cards' => $cards,
            'defaultBoxId' => $defaultBoxId,
            'defaultCardId' => $defaultCardId,
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

        $amountCents = (int) round($selection['total'] * 100);
        $billing = $this->defaultBillingData($request);

        $orderId = $paymob->createOrder(
            $amountCents,
            $product->name,
            [
                'merchant_order_id' => Str::uuid()->toString(),
                'box_id' => $selection['box']?->id,
                'addons' => $selection['addons']->pluck('id')->all(),
                'card_id' => $selection['card']?->id,
                'message' => $selection['message'],
            ],
            $billing
        );

        if ($validated['payment_method'] === 'cash') {
            $cashBill = $paymob->createCashCollection(
                $amountCents,
                $orderId,
                $billing,
                config('services.paymob.integration_id_cash')
            );

            return view('frontend.gifts.checkout', array_merge($selection, [
                'product' => $product,
                'paymentMethod' => 'cash',
                'cashBill' => $cashBill,
            ]));
        }

        $paymentKey = $paymob->createPaymentKey(
            $amountCents,
            $orderId,
            $billing,
            config('services.paymob.integration_id_card')
        );

        return redirect()->away($paymob->iframeUrl($paymentKey));
    }

    private function buildSelection(Request $request, Product $product): array
    {
        $box = GiftOption::active()
            ->ofType(GiftOption::TYPE_BOX)
            ->find($request->input('box_selection'));

        $addons = GiftOption::active()
            ->ofType(GiftOption::TYPE_ADDON)
            ->whereIn('id', (array) $request->input('addons', []))
            ->get();

        $includeCard = $request->boolean('include_card');

        $card = $includeCard
            ? GiftOption::active()
                ->ofType(GiftOption::TYPE_CARD)
                ->find($request->input('gift_card'))
            : null;

        if ($includeCard && ! $card) {
            $card = GiftOption::active()
                ->ofType(GiftOption::TYPE_CARD)
                ->where('is_default', true)
                ->first()
                ?? GiftOption::active()
                    ->ofType(GiftOption::TYPE_CARD)
                    ->first();
        }

        $message = $request->input('message', '');

        $boxPrice = $box?->price ?? 0;
        $addonsPrice = $addons->sum('price');
        $cardPrice = $card?->price ?? 0;
        $total = $product->price + $boxPrice + $addonsPrice + $cardPrice;

        return [
            'box' => $box,
            'addons' => $addons,
            'card' => $card,
            'includeCard' => $includeCard,
            'message' => $message,
            'boxPrice' => $boxPrice,
            'addonsPrice' => $addonsPrice,
            'cardPrice' => $cardPrice,
            'total' => $total,
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
}
