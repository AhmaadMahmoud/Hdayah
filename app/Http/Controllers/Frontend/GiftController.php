<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GiftOption;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\View\View;

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
}
