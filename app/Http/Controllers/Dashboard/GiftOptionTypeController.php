<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\GiftOptionType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class GiftOptionTypeController extends Controller
{
    public function store(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:64', 'unique:gift_option_types,slug', 'regex:/^[a-z0-9_]+$/'],
            'selection_mode' => ['required', 'in:single,multiple,optional_single'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        GiftOptionType::create([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'selection_mode' => $data['selection_mode'],
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('status', 'تم إضافة النوع بنجاح.');
    }

    public function update(Request $request, GiftOptionType $giftOptionType): RedirectResponse
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:64', 'unique:gift_option_types,slug,' . $giftOptionType->id, 'regex:/^[a-z0-9_]+$/'],
            'selection_mode' => ['required', 'in:single,multiple,optional_single'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
        ]);

        $giftOptionType->update([
            'name' => $data['name'],
            'slug' => $data['slug'],
            'selection_mode' => $data['selection_mode'],
            'sort_order' => $data['sort_order'] ?? 0,
            'is_active' => $request->boolean('is_active'),
        ]);

        return back()->with('status', 'تم تحديث النوع بنجاح.');
    }

    public function destroy(GiftOptionType $giftOptionType): RedirectResponse
    {
        $giftOptionType->options()->delete();
        $giftOptionType->delete();

        return back()->with('status', 'تم حذف النوع وجميع عناصره.');
    }
}
