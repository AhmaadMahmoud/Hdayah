@extends('frontend.layouts.master')

@section('content')
    <style>
        :root {
            --primary: #ee2b5b;
            --primary-dark: #d6204b;
            --bg-light: #fcf8f9;
            --surface: #ffffff;
            --text-main: #1b0d11;
            --text-sub: #9a4c5f;
            --soft: #f3e7ea;
        }



        .font-numbers {
            font-family: "Manrope", sans-serif;
        }

        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
            line-height: 1;
        }

        .navbar-blur {
            backdrop-filter: blur(10px);
            background: rgba(255, 255, 255, .85);
            border-bottom: 1px solid #f3e7ea;
        }

        .btn-primary {
            background: var(--primary);
            border-color: var(--primary);
        }

        .btn-primary:hover {
            background: var(--primary-dark);
            border-color: var(--primary-dark);
        }

        .stepper {
            position: relative;
        }

        .stepper::before {
            content: "";
            position: absolute;
            top: 24px;
            right: 0;
            left: 0;
            height: 6px;
            background: #f1f1f1;
            border-radius: 999px;
            z-index: 0;
        }

        .stepper .progress-line {
            position: absolute;
            top: 24px;
            right: 0;
            width: 66.666%;
            height: 6px;
            background: var(--primary);
            border-radius: 999px;
            z-index: 0;
        }

        .step {
            position: relative;
            z-index: 1;
            text-align: center;
            min-width: 90px;
        }

        .step .bubble {
            width: 44px;
            height: 44px;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: 800;
            box-shadow: 0 10px 20px rgba(0, 0, 0, .08);
            margin-inline: auto;
            border: 4px solid #fff;
        }

        .bubble.active {
            background: var(--primary);
            color: #fff;
        }

        .bubble.current {
            background: #fff;
            color: var(--primary);
            border: 2px solid var(--primary);
        }

        .bubble.todo {
            background: #fff;
            color: #aaa;
            border: 2px solid #e5e5e5;
            box-shadow: none;
        }

        .choice-radio input,
        .choice-check input {
            position: absolute;
            opacity: 0;
            pointer-events: none;
        }

        .choice-card {
            border: 2px solid transparent;
            border-radius: 16px;
            background: #fff;
            transition: .2s ease;
        }

        .choice-card:hover {
            box-shadow: 0 16px 30px rgba(0, 0, 0, .08);
        }

        .choice-radio input:checked+.choice-card,
        .choice-check input:checked+.choice-card {
            border-color: var(--primary);
            background: rgba(238, 43, 91, .05);
        }

        .img-price {
            position: absolute;
            top: 12px;
            left: 12px;
            background: linear-gradient(135deg, #ee2b5b, #ff6f8f);
            color: #fff;
            padding: 6px 10px;
            border-radius: 999px;
            font-weight: 900;
            font-size: 12px;
            box-shadow: 0 8px 18px rgba(238, 43, 91, .28);
        }

        .card-thumb {
            width: 140px;
            height: 86px;
            border-radius: 16px;
            border: 2px solid #eaeaea;
            overflow: hidden;
            background: #f8f9fa;
            position: relative;
            display: block;
            flex: 0 0 auto;
            transition: .2s ease;
        }

        .card-thumb.is-active {
            border-color: var(--primary);
            box-shadow: 0 10px 24px rgba(238, 43, 91, .18);
        }

        .card-thumb img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }

        .check-badge {
            width: 44px;
            height: 44px;
            background: var(--primary);
            color: #fff;
            border-radius: 999px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 16px 30px rgba(238, 43, 91, .25);
        }

        .addon-icon {
            width: 52px;
            height: 52px;
            border-radius: 999px;
            background: var(--soft);
            color: var(--primary);
            display: flex;
            align-items: center;
            justify-content: center;
            transition: .2s ease;
        }

        .choice-check input:checked+.choice-card .addon-icon {
            background: var(--primary);
            color: #fff;
        }

        .soft-text {
            color: var(--text-sub);
        }

        .sticky-summary {
            position: sticky;
            top: 110px;
        }

        .rounded-2xl {
            border-radius: 24px;
        }

        .rounded-xl {
            border-radius: 16px;
        }

        .product-chip {
            background: rgba(238, 43, 91, .08);
            color: var(--primary);
            border-radius: 999px;
            padding: 6px 14px;
            font-weight: 800;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .box-media {
            position: relative;
            aspect-ratio: 1 / 1;
            border-radius: 16px;
            overflow: hidden;
            background: #f8f9fa;
            border: 1px solid #f6d8e3;
            box-shadow: 0 10px 24px rgba(238, 43, 91, .08);
        }

        .box-media img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            display: block;
        }
    </style>

    @php
        $selectedBox = $boxes->firstWhere('id', $defaultBoxId);
        $selectedCard = $cards->firstWhere('id', $defaultCardId);
        $defaultAddons = $addons->where('is_default', true);
        $boxPrice = $selectedBox?->price ?? 0;
        $addonsPrice = $defaultAddons->sum('price');
        $cardPrice = $selectedCard?->price ?? 0;
        $total = $product->price + $boxPrice + $addonsPrice + $cardPrice;
    @endphp

    <div class="container py-4 py-md-5">
        <div class="mb-4 mb-md-5 text-center text-md-start">
            <div class="product-chip mb-2">
                <span class="material-symbols-outlined">redeem</span>
                <span>تخصيص هدية: {{ $product->name }}</span>
            </div>
            <h1 class="display-6 fw-black fw-bold mb-2" style="font-weight:900;">اختيار التغليف والإضافات</h1>
            <p class="mb-0 fs-5 soft-text">احجز تغليفاً يناسب ذوقك مع الحفاظ على لغة الواجهة الحالية، ويمكنك تغيير كل الخيارات من لوحة التحكم.</p>
        </div>

        <div class="row g-4 g-lg-5 align-items-start">
            <main class="col-12 col-lg-8">
                <div class="bg-white border rounded-2xl p-4 p-md-4 mb-4">
                    <div class="stepper d-flex justify-content-between align-items-start gap-2 position-relative">
                        <div class="progress-line"></div>

                        <div class="step">
                            <div class="bubble active font-numbers">1</div>
                            <div class="small fw-bold mt-2" style="color:var(--primary)">الهدية</div>
                        </div>

                        <div class="step">
                            <div class="bubble current font-numbers">2</div>
                            <div class="small fw-bold mt-2">اختيار التغليف</div>
                        </div>

                        <div class="step">
                            <div class="bubble todo font-numbers">3</div>
                            <div class="small fw-semibold mt-2 text-secondary">الدفع والتأكيد</div>
                        </div>
                    </div>
                </div>

                <section class="mb-5">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center font-numbers fw-bold"
                            style="width:32px;height:32px;background: rgba(238,43,91,.10); color: var(--primary);">
                            1
                        </div>
                        <h3 class="h4 fw-bold mb-0">اختر صندوق التغليف</h3>
                    </div>

                    <div class="row g-3">
                        @forelse ($boxes as $box)
                            <div class="col-12 col-sm-6 col-md-4">
                                <label class="choice-radio w-100 position-relative">
                                    <input type="radio" name="box_selection" value="{{ $box->id }}" data-price="{{ $box->price }}"
                                        @checked($box->id === $defaultBoxId)>
                                    <div class="choice-card p-3 h-100">
                                        <div class="box-media mb-3">
                                            @if ($box->image_url)
                                                <img alt="{{ $box->name }}" src="{{ $box->image_url }}">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary">
                                                    <span class="material-symbols-outlined">redeem</span>
                                                </div>
                                            @endif
                                            <div class="img-price font-numbers">{{ number_format($box->price, 2) }} ر.س</div>
                                        </div>

                                        <div class="text-center">
                                            <div class="fw-bold">{{ $box->name }}</div>
                                            @if ($box->description)
                                                <div class="small soft-text">{{ $box->description }}</div>
                                            @endif
                                        </div>
                                    </div>
                                </label>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-light border text-secondary m-0 rounded-2xl">
                                    لا توجد صناديق تغليف مضافة بعد، يمكنك إنشاء الخيارات من لوحة التحكم.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="mb-5">
                    <div class="d-flex align-items-center gap-3 mb-3">
                        <div class="rounded-circle d-flex align-items-center justify-content-center font-numbers fw-bold"
                            style="width:32px;height:32px;background: rgba(238,43,91,.10); color: var(--primary);">
                            2
                        </div>
                        <h3 class="h4 fw-bold mb-0">الإضافات</h3>
                    </div>

                    <div class="row g-3 row-cols-2 row-cols-sm-3">
                        @forelse ($addons as $addon)
                            <div class="col">
                                <label class="choice-check w-100">
                                    <input type="checkbox" name="addons[]" value="{{ $addon->id }}" data-price="{{ $addon->price }}"
                                        @checked($addon->is_default)>
                                    <div class="choice-card p-3 text-center h-100">
                                        <div class="addon-icon mx-auto mb-2">
                                            @if ($addon->icon)
                                                <span class="material-symbols-outlined">{{ $addon->icon }}</span>
                                            @else
                                                <span class="material-symbols-outlined">auto_awesome</span>
                                            @endif
                                        </div>
                                        <div class="fw-bold small">{{ $addon->name }}</div>
                                        @if ($addon->description)
                                            <div class="small soft-text">{{ $addon->description }}</div>
                                        @endif
                                        <div class="small soft-text font-numbers mt-1">+{{ number_format($addon->price, 2) }} ر.س</div>
                                    </div>
                                </label>
                            </div>
                        @empty
                            <div class="col-12">
                                <div class="alert alert-light border text-secondary m-0 rounded-2xl">
                                    لا توجد إضافات حتى الآن.
                                </div>
                            </div>
                        @endforelse
                    </div>
                </section>

                <section class="mb-5">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 mb-3">
                        <div class="d-flex align-items-center gap-3">
                            <div class="rounded-circle d-flex align-items-center justify-content-center font-numbers fw-bold"
                                style="width:32px;height:32px;background: rgba(238,43,91,.10); color: var(--primary);">
                                3
                            </div>
                            <h3 class="h4 fw-bold mb-0">بطاقة الإهداء</h3>
                        </div>

                        <div class="form-check form-switch m-0">
                            <input class="form-check-input" type="checkbox" id="giftCardSwitch" @checked($defaultCardId)>
                            <label class="form-check-label small soft-text" for="giftCardSwitch">إضافة بطاقة إهداء</label>
                        </div>
                    </div>

                    <div class="bg-white border rounded-2xl p-4">
                        <div class="mb-3">
                            <div class="fw-bold small mb-2">اختر تصميم البطاقة</div>
                            <div class="d-flex gap-3 overflow-auto pb-2">
                                @forelse ($cards as $card)
                                    @php
                                        $isActive = $card->id === $defaultCardId;
                                    @endphp
                                    <label class="card-thumb-label" style="cursor:pointer;">
                                        <input type="radio" name="gift_card" value="{{ $card->id }}" class="d-none" data-price="{{ $card->price }}"
                                            @checked($isActive)>
                                        <div class="card-thumb {{ $isActive ? 'is-active' : '' }}" data-card-thumb>
                                            @if ($card->image_url)
                                                <img alt="{{ $card->name }}" src="{{ $card->image_url }}">
                                            @else
                                                <div class="w-100 h-100 d-flex align-items-center justify-content-center soft-text fw-bold">
                                                    {{ $card->name }}
                                                </div>
                                            @endif
                                            @if ($card->price > 0)
                                                <span class="img-price font-numbers">{{ number_format($card->price, 2) }} ر.س</span>
                                            @endif
                                        </div>
                                    </label>
                                @empty
                                    <div class="text-secondary small">لم تتم إضافة بطاقات.</div>
                                @endforelse
                            </div>
                        </div>

                        <div>
                            <label class="form-label fw-bold small" for="message">رسالة الإهداء</label>
                            <div class="position-relative">
                                <textarea id="message" class="form-control border-0 rounded-xl p-3" style="background: var(--soft); resize:none;" rows="4" placeholder="اكتب كلماتك اللطيفة هنا..."></textarea>
                                <div class="position-absolute bottom-0 start-0 m-2 small soft-text font-numbers">0/200
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </main>

            <aside class="col-12 col-lg-4">
                <div class="sticky-summary">
                    <div class="bg-white border rounded-2xl overflow-hidden shadow"
                        style="box-shadow:0 25px 55px rgba(15,23,42,.10)!important;">
                        <div class="p-4 border-bottom">
                            <h3 class="h6 fw-bold mb-0">ملخص الهدية</h3>
                            <div class="d-flex align-items-center gap-2 mt-2 soft-text">
                                <span class="material-symbols-outlined">inventory_2</span>
                                <span>{{ $product->name }}</span>
                            </div>
                        </div>

                        <div class="p-4">
                            <div class="d-flex justify-content-between align-items-center small mb-3">
                                <span class="soft-text">الهدية الأصلية</span>
                                <span class="fw-bold font-numbers">{{ number_format($product->price, 2) }} ر.س</span>
                            </div>
                            @if ($selectedBox)
                                <div class="d-flex justify-content-between align-items-center small mb-3">
                                    <span class="soft-text">صندوق التغليف ({{ $selectedBox->name }})</span>
                                    <span class="fw-bold font-numbers" data-summary-box>{{ number_format($boxPrice, 2) }} ر.س</span>
                                </div>
                            @endif
                            <div class="d-flex justify-content-between align-items-center small mb-3">
                                <span class="soft-text">إضافات</span>
                                <span class="fw-bold font-numbers" data-summary-addons>{{ number_format($addonsPrice, 2) }} ر.س</span>
                            </div>
                            <div class="d-flex justify-content-between align-items-center small mb-3">
                                <span class="soft-text">بطاقة إهداء</span>
                                <span class="fw-bold font-numbers" data-summary-card>{{ number_format($cardPrice, 2) }} ر.س</span>
                            </div>

                            <hr>

                            <div class="d-flex justify-content-between align-items-center">
                                <span class="fw-bold fs-5">الإجمالي</span>
                                <span class="fw-black fs-2 font-numbers" data-summary-total
                                    style="color:var(--primary); font-weight:900;">{{ number_format($total, 2) }} ر.س</span>
                            </div>
                        </div>

                        <div class="p-4 pt-0">
                            <a href="{{ route('products.show', $product) }}" class="btn w-100 rounded-pill fw-bold mb-2"
                                style="background:#f3f3f3; color: var(--text-sub);">
                                تعديل اختيار الهدية
                                <span class="material-symbols-outlined align-middle ms-1">bookmark</span>
                            </a>

                            <button class="btn btn-primary w-100 rounded-pill fw-bold shadow"
                                style="box-shadow:0 16px 30px rgba(238,43,91,.25)!important;">
                                تابع للدفع
                                <span class="material-symbols-outlined align-middle ms-1">arrow_back</span>
                            </button>

                            <p class="text-center small soft-text mt-3 mb-0">يمكنك تعديل خيارات التغليف والإضافات في أي وقت من لوحة التحكم.</p>
                        </div>
                    </div>
                </div>
            </aside>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const basePrice = {{ $product->price }};
        const summaryTotal = document.querySelector('[data-summary-total]');
        const summaryBox = document.querySelector('[data-summary-box]');
        const summaryAddons = document.querySelector('[data-summary-addons]');
        const summaryCard = document.querySelector('[data-summary-card]');
        const cardSwitch = document.getElementById('giftCardSwitch');

        const fmt = (n) => n.toFixed(2) + ' ر.س';

        const recalc = () => {
            const box = document.querySelector('input[name="box_selection"]:checked');
            const card = document.querySelector('input[name="gift_card"]:checked');
            const addons = Array.from(document.querySelectorAll('input[name="addons[]"]:checked'));

            const boxPrice = box ? Number(box.dataset.price || 0) : 0;
            const cardPrice = cardSwitch?.checked ? Number(card?.dataset.price || 0) : 0;
            const addonsPrice = addons.reduce((sum, el) => sum + Number(el.dataset.price || 0), 0);
            const total = basePrice + boxPrice + cardPrice + addonsPrice;

            if (summaryBox) summaryBox.textContent = fmt(boxPrice);
            if (summaryAddons) summaryAddons.textContent = fmt(addonsPrice);
            if (summaryCard) summaryCard.textContent = fmt(cardSwitch?.checked ? cardPrice : 0);
            if (summaryTotal) summaryTotal.textContent = fmt(total);
        };
// ✅ خلي كارت الصندوق toggle (يتحدد ويتفك)
document.querySelectorAll('input[name="box_selection"]').forEach((input) => {
    const card = input.closest('label')?.querySelector('.choice-card');
    if (!card) return;

    card.addEventListener('click', (e) => {
        const wasChecked = input.checked;
        e.preventDefault(); // يمنع سلوك الـ label الافتراضي

        if (wasChecked) {
            // لو كان متحدد → فكّه
            input.checked = false;
        } else {
            // غير كده → شيل الكل وحدد الحالي
            document
                .querySelectorAll('input[name="box_selection"]')
                .forEach((i) => (i.checked = false));

            input.checked = true;
        }

        recalc(); // حدث الحساب
    });
});

        const cardThumbs = document.querySelectorAll('[data-card-thumb]');

        const syncCardThumbs = () => {
            const selected = document.querySelector('input[name="gift_card"]:checked');
            cardThumbs.forEach((thumb) => thumb.classList.remove('is-active'));
            if (selected) {
                const thumb = selected.closest('label')?.querySelector('[data-card-thumb]');
                thumb?.classList.add('is-active');
            }
        };

        const makeToggleableRadio = (name, onChange) => {
            const inputs = Array.from(document.querySelectorAll(`input[name="${name}"]`));
            inputs.forEach((input) => {
                input.addEventListener('mousedown', () => {
                    input.dataset.wasChecked = input.checked ? '1' : '';
                });
                input.addEventListener('click', (e) => {
                    const wasChecked = input.dataset.wasChecked === '1';
                    inputs.forEach((i) => {
                        if (i !== input) i.dataset.wasChecked = '';
                    });
                    if (wasChecked) {
                        input.checked = false;
                        input.dataset.wasChecked = '';
                        onChange();
                        e.preventDefault();
                    }
                });
                input.addEventListener('change', () => {
                    inputs.forEach((i) => (i.dataset.wasChecked = i === input && input.checked ? '1' : ''));
                    onChange();
                });
            });
        };

        makeToggleableRadio('gift_card', () => {
            syncCardThumbs();
            recalc();
        });
        makeToggleableRadio('box_selection', recalc);

        document.querySelectorAll('input[name="addons[]"]').forEach((el) => {
            el.addEventListener('change', recalc);
        });
        cardSwitch?.addEventListener('change', recalc);

        syncCardThumbs();
        recalc();
    });
</script>
<script>
document.addEventListener('DOMContentLoaded', () => {
    const basePrice = {{ $product->price }};
    const summaryTotal = document.querySelector('[data-summary-total]');
    const summaryBox = document.querySelector('[data-summary-box]');
    const summaryAddons = document.querySelector('[data-summary-addons]');
    const summaryCard = document.querySelector('[data-summary-card]');
    const cardSwitch = document.getElementById('giftCardSwitch');

    const fmt = (n) => n.toFixed(2) + ' ر.س';

    const recalc = () => {
        const box = document.querySelector('input[name="box_selection"]:checked');
        const card = document.querySelector('input[name="gift_card"]:checked');
        const addons = Array.from(document.querySelectorAll('input[name="addons[]"]:checked'));

        const boxPrice = box ? Number(box.dataset.price || 0) : 0;
        const cardPrice = cardSwitch?.checked ? Number(card?.dataset.price || 0) : 0;
        const addonsPrice = addons.reduce((sum, el) => sum + Number(el.dataset.price || 0), 0);
        const total = basePrice + boxPrice + cardPrice + addonsPrice;

        if (summaryBox) summaryBox.textContent = fmt(boxPrice);
        if (summaryAddons) summaryAddons.textContent = fmt(addonsPrice);
        if (summaryCard) summaryCard.textContent = fmt(cardSwitch?.checked ? cardPrice : 0);
        if (summaryTotal) summaryTotal.textContent = fmt(total);
    };

    const cardThumbs = document.querySelectorAll('[data-card-thumb]');

    const syncCardThumbs = () => {
        const selected = document.querySelector('input[name="gift_card"]:checked');
        cardThumbs.forEach((thumb) => thumb.classList.remove('is-active'));
        if (selected) {
            const thumb = selected.closest('label')?.querySelector('[data-card-thumb]');
            thumb?.classList.add('is-active');
        }
    };

    // ✅ toggle by clicking the thumb itself
    cardThumbs.forEach((thumb) => {
        thumb.addEventListener('click', (e) => {
            const input = thumb.closest('label')?.querySelector('input[name="gift_card"]');
            if (!input) return;

            const wasChecked = input.checked;

            // امنع السلوك الافتراضي بتاع الـ label (اللي بيخلي الراديو يفضل متحدد)
            e.preventDefault();

            // لو كان متحدد: فك التحديد
            if (wasChecked) {
                input.checked = false;
            } else {
                // غير كده: حدد الحالي وشيل الباقي
                document.querySelectorAll('input[name="gift_card"]').forEach((i) => (i.checked = false));
                input.checked = true;
            }

            syncCardThumbs();
            recalc();
        });
    });

    // باقي الكود زي ما هو
    document.querySelectorAll('input[name="addons[]"]').forEach((el) => {
        el.addEventListener('change', recalc);
    });
    document.querySelectorAll('input[name="box_selection"]').forEach((el) => {
        el.addEventListener('change', recalc);
    });
    cardSwitch?.addEventListener('change', recalc);

    syncCardThumbs();
    recalc();
});
</script>

