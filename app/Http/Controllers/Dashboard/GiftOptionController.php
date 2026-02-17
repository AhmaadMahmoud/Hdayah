<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\GiftOption;
use App\Models\GiftOptionType;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GiftOptionController extends Controller
{
    public function index(): View
    {
        $types = GiftOptionType::ordered()
            ->with(['options' => fn ($q) => $q->orderBy('sort_order')->orderBy('name')])
            ->get();

        return view('dashboard.gifts.index', [
            'types' => $types,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $imagePath = $request->file('image')?->store('gifts', 'public');

        $option = GiftOption::create([
            'gift_option_type_id' => $data['gift_option_type_id'],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
            'image_path' => $imagePath,
            'icon' => $data['icon'] ?? null,
            'is_default' => $request->boolean('is_default'),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        if ($option->is_default) {
            $this->unsetOtherDefaults($option);
        }

        return back()->with('status', 'تم حفظ خيار التغليف بنجاح.');
    }

    public function update(Request $request, GiftOption $giftOption): RedirectResponse
    {
        $data = $this->validateData($request);
        $imagePath = $giftOption->image_path;

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('gifts', 'public');
            if ($giftOption->image_path) {
                Storage::disk('public')->delete($giftOption->image_path);
            }
        }

        $giftOption->update([
            'gift_option_type_id' => $data['gift_option_type_id'],
            'name' => $data['name'],
            'description' => $data['description'] ?? null,
            'price' => $data['price'],
            'image_path' => $imagePath,
            'icon' => $data['icon'] ?? null,
            'is_default' => $request->boolean('is_default'),
            'is_active' => $request->boolean('is_active', true),
            'sort_order' => $data['sort_order'] ?? 0,
        ]);

        if ($giftOption->is_default) {
            $this->unsetOtherDefaults($giftOption);
        }

        return back()->with('status', 'تم تحديث خيار التغليف بنجاح.');
    }

    public function destroy(GiftOption $giftOption): RedirectResponse
    {
        if ($giftOption->image_path) {
            Storage::disk('public')->delete($giftOption->image_path);
        }

        $giftOption->delete();

        return back()->with('status', 'تم حذف خيار التغليف.');
    }

    protected function validateData(Request $request): array
    {
        $typeIds = GiftOptionType::pluck('id')->implode(',');

        return $request->validate([
            'gift_option_type_id' => ['required', 'in:' . $typeIds],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'icon' => ['nullable', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);
    }

    protected function unsetOtherDefaults(GiftOption $option): void
    {
        GiftOption::where('gift_option_type_id', $option->gift_option_type_id)
            ->whereKeyNot($option->id)
            ->update(['is_default' => false]);
    }
}
