<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\GiftOption;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class GiftOptionController extends Controller
{
    public function index(): View
    {
        $options = GiftOption::orderBy('type')
            ->orderBy('sort_order')
            ->orderBy('name')
            ->get()
            ->groupBy('type');

        return view('dashboard.gifts.index', [
            'options' => $options,
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateData($request);
        $imagePath = $request->file('image')?->store('gifts', 'public');

        $option = GiftOption::create([
            'name' => $data['name'],
            'type' => $data['type'],
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
            'name' => $data['name'],
            'type' => $data['type'],
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
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'type' => ['required', 'in:' . implode(',', [GiftOption::TYPE_BOX, GiftOption::TYPE_ADDON, GiftOption::TYPE_CARD])],
            'description' => ['nullable', 'string'],
            'price' => ['required', 'numeric', 'min:0'],
            'icon' => ['nullable', 'string', 'max:120'],
            'sort_order' => ['nullable', 'integer', 'min:0'],
            'image' => ['nullable', 'image', 'max:4096'],
        ]);
    }

    protected function unsetOtherDefaults(GiftOption $option): void
    {
        GiftOption::where('type', $option->type)
            ->whereKeyNot($option->id)
            ->update(['is_default' => false]);
    }
}
