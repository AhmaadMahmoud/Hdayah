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
        $total = (float) $product->price;
        $pricesBySlug = [];
        foreach ($types as $type) {
            $slug = $type->slug;
            $def = $defaults[$slug] ?? null;
            if ($type->selection_mode === 'multiple') {
                $ids = is_array($def) ? $def : [];
                $opts = $type->options->whereIn('id', $ids);
            } elseif ($type->selection_mode === 'optional_single') {
                $enabled = $defaultsEnabled[$slug] ?? false;
                $id = is_array($def) ? null : $def;
                $opts = ($enabled && $id) ? $type->options->where('id', $id) : $type->options->take(0);
            } else {
                $id = is_array($def) ? null : $def;
                $opts = $id ? $type->options->where('id', $id) : $type->options->take(0);
            }
            $p = $opts->sum('price');
            $pricesBySlug[$slug] = $p;
            $total += $p;
        }
    @endphp

    <div class="container py-4 py-md-5">
        <form action="{{ route('gifts.checkout', $product) }}" method="POST" id="giftBuilderForm">
            @csrf
            <div class="mb-4 mb-md-5 text-center text-md-start">
                <div class="product-chip mb-2">
                    <span class="material-symbols-outlined">redeem</span>
                    <span>تجهيز الهدية: {{ $product->name }}</span>
                </div>
                <h1 class="display-6 fw-black fw-bold mb-2" style="font-weight:900;">صمّم هديتك وانتقل للدفع</h1>
                <p class="mb-0 fs-5 soft-text">اختر الصندوق والإضافات ثم اضغط على “تابع الدفع” لإكمال عملية الدفع كاش أو فيزا.</p>
            </div>

            <div class="row g-4 g-lg-5 align-items-start">
                <main class="col-12 col-lg-8">
                    <div class="bg-white border rounded-2xl p-4 p-md-4 mb-4">
                        <div class="stepper d-flex justify-content-between align-items-start gap-2 position-relative">
                            <div class="progress-line"></div>

                            <div class="step">
                                <div class="bubble active font-numbers">1</div>
                                <div class="small fw-bold mt-2" style="color:var(--primary)">اختيار المنتج</div>
                            </div>

                            <div class="step">
                                <div class="bubble current font-numbers">2</div>
                                <div class="small fw-bold mt-2">تخصيص الهدية</div>
                            </div>

                            <div class="step">
                                <div class="bubble todo font-numbers">3</div>
                                <div class="small fw-semibold mt-2 text-secondary">الدفع والتأكيد</div>
                            </div>
                        </div>
                    </div>

                    @foreach ($types as $step => $type)
                        <section class="mb-5" data-type-slug="{{ $type->slug }}">
                            <div class="d-flex align-items-center gap-3 mb-3 @if($type->selection_mode === 'optional_single') justify-content-between flex-wrap @endif">
                                <div class="d-flex align-items-center gap-3">
                                    <div class="rounded-circle d-flex align-items-center justify-content-center font-numbers fw-bold"
                                        style="width:32px;height:32px;background: rgba(238,43,91,.10); color: var(--primary);">
                                        {{ $step + 1 }}
                                    </div>
                                    <h3 class="h4 fw-bold mb-0">{{ $type->name }}</h3>
                                </div>
                                @if ($type->selection_mode === 'optional_single')
                                    <div class="form-check form-switch m-0">
                                        <input class="form-check-input selection-enabled" type="checkbox" id="sel_enabled_{{ $type->slug }}" name="selection_enabled[{{ $type->slug }}]" value="1" data-slug="{{ $type->slug }}" @checked($defaultsEnabled[$type->slug] ?? false)>
                                        <label class="form-check-label small soft-text" for="sel_enabled_{{ $type->slug }}">تضمين</label>
                                    </div>
                                @endif
                            </div>

                            @if ($type->selection_mode === 'single')
                                <div class="row g-3">
                                    @forelse ($type->options as $opt)
                                        <div class="col-12 col-sm-6 col-md-4">
                                            <label class="choice-radio w-100 position-relative">
                                                <input type="radio" name="selection[{{ $type->slug }}]" value="{{ $opt->id }}" data-price="{{ $opt->price }}" data-slug="{{ $type->slug }}"
                                                    @checked($opt->id === ($defaults[$type->slug] ?? null))>
                                                <div class="choice-card p-3 h-100">
                                                    <div class="box-media mb-3">
                                                        @if ($opt->image_url)
                                                            <img alt="{{ $opt->name }}" src="{{ $opt->image_url }}">
                                                        @else
                                                            <div class="w-100 h-100 d-flex align-items-center justify-content-center text-secondary">
                                                                <span class="material-symbols-outlined">redeem</span>
                                                            </div>
                                                        @endif
                                                        <div class="img-price font-numbers">{{ number_format($opt->price, 2) }} ر.س</div>
                                                    </div>
                                                    <div class="text-center">
                                                        <div class="fw-bold">{{ $opt->name }}</div>
                                                        @if ($opt->description)
                                                            <div class="small soft-text">{{ $opt->description }}</div>
                                                        @endif
                                                    </div>
                                                </div>
                                            </label>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-light border text-secondary m-0 rounded-2xl">لا توجد خيارات متاحة.</div>
                                        </div>
                                    @endforelse
                                </div>
                            @elseif ($type->selection_mode === 'multiple')
                                <div class="row g-3 row-cols-2 row-cols-sm-3">
                                    @forelse ($type->options as $opt)
                                        @php $defIds = $defaults[$type->slug] ?? []; $checked = in_array($opt->id, is_array($defIds) ? $defIds : []); @endphp
                                        <div class="col">
                                            <label class="choice-check w-100">
                                                <input type="checkbox" name="selection[{{ $type->slug }}][]" value="{{ $opt->id }}" data-price="{{ $opt->price }}" data-slug="{{ $type->slug }}" @checked($checked)>
                                                <div class="choice-card p-3 text-center h-100">
                                                    <div class="addon-icon mx-auto mb-2">
                                                        @if ($opt->icon)
                                                            <span class="material-symbols-outlined">{{ $opt->icon }}</span>
                                                        @else
                                                            <span class="material-symbols-outlined">auto_awesome</span>
                                                        @endif
                                                    </div>
                                                    <div class="fw-bold small">{{ $opt->name }}</div>
                                                    @if ($opt->description)
                                                        <div class="small soft-text">{{ $opt->description }}</div>
                                                    @endif
                                                    <div class="small soft-text font-numbers mt-1">+{{ number_format($opt->price, 2) }} ر.س</div>
                                                </div>
                                            </label>
                                        </div>
                                    @empty
                                        <div class="col-12">
                                            <div class="alert alert-light border text-secondary m-0 rounded-2xl">لا توجد خيارات متاحة.</div>
                                        </div>
                                    @endforelse
                                </div>
                            @else
                                <div class="bg-white border rounded-2xl p-4">
                                    <div class="d-flex gap-3 overflow-auto pb-2 flex-wrap">
                                        @forelse ($type->options as $opt)
                                            @php $isActive = ($defaultsEnabled[$type->slug] ?? false) && ($defaults[$type->slug] ?? null) == $opt->id; @endphp
                                            <label class="card-thumb-label" style="cursor:pointer;">
                                                <input type="radio" name="selection[{{ $type->slug }}]" value="{{ $opt->id }}" class="d-none selection-radio-opt" data-price="{{ $opt->price }}" data-slug="{{ $type->slug }}" @checked($isActive)>
                                                <div class="card-thumb {{ $isActive ? 'is-active' : '' }}" data-card-thumb data-slug="{{ $type->slug }}">
                                                    @if ($opt->image_url)
                                                        <img alt="{{ $opt->name }}" src="{{ $opt->image_url }}">
                                                    @else
                                                        <div class="w-100 h-100 d-flex align-items-center justify-content-center soft-text fw-bold">{{ $opt->name }}</div>
                                                    @endif
                                                    @if ($opt->price > 0)
                                                        <span class="img-price font-numbers">{{ number_format($opt->price, 2) }} ر.س</span>
                                                    @endif
                                                </div>
                                            </label>
                                        @empty
                                            <span class="text-secondary small">لا توجد خيارات.</span>
                                        @endforelse
                                    </div>
                                </div>
                            @endif
                        </section>
                    @endforeach

                    <section class="mb-5">
                        <div class="bg-white border rounded-2xl p-4">
                            <label class="form-label fw-bold small" for="message">رسالة الإهداء</label>
                            <div class="position-relative">
                                <textarea id="message" name="message" class="form-control border-0 rounded-xl p-3" style="background: var(--soft); resize:none;" rows="4" placeholder="اكتب رسالتك الخاصة هنا..." maxlength="200"></textarea>
                                <div class="position-absolute bottom-0 start-0 m-2 small soft-text font-numbers" data-message-count>0/200</div>
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
                                    <span class="soft-text">سعر المنتج</span>
                                    <span class="fw-bold font-numbers">{{ number_format($product->price, 2) }} ر.س</span>
                                </div>
                                @foreach ($types as $type)
                                    <div class="d-flex justify-content-between align-items-center small mb-3" data-summary-row="{{ $type->slug }}">
                                        <span class="soft-text">{{ $type->name }}</span>
                                        <span class="fw-bold font-numbers" data-summary-price="{{ $type->slug }}">{{ number_format($pricesBySlug[$type->slug] ?? 0, 2) }} ر.س</span>
                                    </div>
                                @endforeach
                                <hr>
                                <div class="d-flex justify-content-between align-items-center">
                                    <span class="fw-bold fs-5">الإجمالي</span>
                                    <span class="fw-black fs-2 font-numbers" data-summary-total style="color:var(--primary); font-weight:900;">{{ number_format($total, 2) }} ر.س</span>
                                </div>
                            </div>

                            <div class="p-4 pt-0">
                                <a href="{{ route('products.show', $product) }}" class="btn w-100 rounded-pill fw-bold mb-2"
                                    style="background:#f3f3f3; color: var(--text-sub);">
                                    عرض المنتج
                                    <span class="material-symbols-outlined align-middle ms-1">bookmark</span>
                                </a>

                                <button class="btn btn-primary w-100 rounded-pill fw-bold shadow" type="submit"
                                    style="box-shadow:0 16px 30px rgba(238,43,91,.25)!important;">
                                    تابع الدفع
                                    <span class="material-symbols-outlined align-middle ms-1">arrow_forward</span>
                                </button>

                                <p class="text-center small soft-text mt-3 mb-0">بالضغط على “تابع الدفع” سيتم نقلك لصفحة الدفع لاختيار الكاش أو الفيزا.</p>
                            </div>
                        </div>
                    </div>
                </aside>
            </div>
        </form>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const basePrice = {{ (float) $product->price }};
        const slugs = @json($types->pluck('slug'));
        const summaryTotal = document.querySelector('[data-summary-total]');
        const messageField = document.getElementById('message');
        const messageCount = document.querySelector('[data-message-count]');
        const fmt = (n) => n.toFixed(2) + ' ر.س';

        const recalc = () => {
            let total = basePrice;
            slugs.forEach((slug) => {
                const enabled = document.querySelector(`input[name="selection_enabled[${slug}]"]`);
                const enabledChecked = !enabled || enabled.checked;
                let price = 0;
                const radios = document.querySelectorAll(`input[name="selection[${slug}]"]`);
                const checkboxes = document.querySelectorAll(`input[name="selection[${slug}][]"]:checked`);
                if (radios.length) {
                    const r = document.querySelector(`input[name="selection[${slug}]"]:checked`);
                    if (enabledChecked && r) price = Number(r.dataset.price || 0);
                } else if (checkboxes.length) {
                    checkboxes.forEach((el) => { price += Number(el.dataset.price || 0); });
                }
                total += price;
                const el = document.querySelector(`[data-summary-price="${slug}"]`);
                if (el) el.textContent = fmt(price);
            });
            if (summaryTotal) summaryTotal.textContent = fmt(total);
        };

        document.querySelectorAll('input[data-slug]').forEach((input) => {
            input.addEventListener('change', recalc);
        });
        document.querySelectorAll('.selection-enabled').forEach((el) => {
            el.addEventListener('change', recalc);
        });

        document.querySelectorAll('input[type="radio"][name^="selection["]').forEach((input) => {
            const slug = input.dataset.slug;
            if (!slug) return;
            const card = input.closest('label')?.querySelector('.choice-card, .card-thumb');
            if (!card) return;
            card.addEventListener('click', (e) => {
                const wasChecked = input.checked;
                e.preventDefault();
                if (wasChecked) {
                    const enabled = document.querySelector(`input[name="selection_enabled[${slug}]"]`);
                    if (enabled?.checked) { input.checked = false; }
                    else { return; }
                } else {
                    document.querySelectorAll(`input[name="selection[${slug}]"]`).forEach((i) => (i.checked = false));
                    input.checked = true;
                }
                document.querySelectorAll(`[data-card-thumb][data-slug="${slug}"]`).forEach((t) => t.classList.remove('is-active'));
                const thumb = input.closest('label')?.querySelector('[data-card-thumb]');
                if (thumb) thumb.classList.add('is-active');
                recalc();
            });
        });

        document.querySelectorAll('[data-card-thumb]').forEach((thumb) => {
            const slug = thumb.dataset.slug;
            if (!slug) return;
            const radio = thumb.closest('label')?.querySelector('input[type="radio"]');
            if (!radio) return;
            radio.addEventListener('change', () => {
                document.querySelectorAll(`[data-card-thumb][data-slug="${slug}"]`).forEach((t) => t.classList.remove('is-active'));
                thumb.classList.add('is-active');
            });
        });

        if (messageField && messageCount) {
            messageField.addEventListener('input', () => {
                messageCount.textContent = `${messageField.value.length}/200`;
            });
        }

        recalc();
    });
</script>
