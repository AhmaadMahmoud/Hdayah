@extends('frontend.layouts.master')

@section('content')
    @php
        $displayAddons = $addons ?? collect();
        $totalAddons = $addonsPrice ?? $displayAddons->sum('price');
        $useCard = $includeCard ?? false;
        $cardCost = $useCard ? ($cardPrice ?? ($card?->price ?? 0)) : 0;
        $boxCost = $boxPrice ?? ($box?->price ?? 0);
        $grandTotal = $total ?? (($product?->price ?? 0) + $boxCost + $cardCost + $totalAddons);
        $method = $paymentMethod ?? 'card';
    @endphp

    <style>
        :root {
            --primary: #ee2b5b;
            --primary-dark: #c91f49;
            --bg: #fdf4f7;
            --card: #ffffff;
            --text: #1a0f14;
            --muted: #9a4c5f;
        }

        .hero-ribbon {
            background: radial-gradient(circle at 10% 20%, rgba(255, 211, 224, .5), transparent 30%), radial-gradient(circle at 90% 10%, rgba(255, 168, 199, .35), transparent 32%), linear-gradient(120deg, #fff7fa, #fdf1f5 50%, #ffe6f0);
            border-radius: 24px;
            border: 1px solid rgba(238, 43, 91, .1);
            box-shadow: 0 20px 50px rgba(238, 43, 91, .08);
        }

        .pill {
            display: inline-flex;
            align-items: center;
            gap: 8px;
            padding: 10px 14px;
            border-radius: 999px;
            background: rgba(238, 43, 91, .12);
            color: var(--primary);
            font-weight: 800;
            letter-spacing: .4px;
        }

        .pay-card {
            border: 2px solid transparent;
            border-radius: 18px;
            background: var(--card);
            transition: .2s ease;
            box-shadow: 0 20px 45px rgba(0, 0, 0, .06);
        }

        .pay-card.is-active {
            border-color: var(--primary);
            box-shadow: 0 24px 55px rgba(238, 43, 91, .18);
        }

        .badge-soft {
            background: rgba(238, 43, 91, .08);
            color: var(--primary);
            border-radius: 12px;
            padding: 6px 10px;
            font-weight: 700;
            font-size: 12px;
        }

        .summary {
            border-radius: 20px;
            border: 1px solid #f6d8e3;
            box-shadow: 0 20px 55px rgba(238, 43, 91, .08);
        }

        .glass {
            background: rgba(255, 255, 255, .92);
            backdrop-filter: blur(12px);
        }

        .wavy {
            position: relative;
        }

        .wavy::after {
            content: "";
            position: absolute;
            inset: 0;
            background: radial-gradient(circle at 20% 20%, rgba(238, 43, 91, .05), transparent 35%), radial-gradient(circle at 80% 10%, rgba(255, 132, 180, .1), transparent 40%);
            pointer-events: none;
            border-radius: inherit;
        }

        .trust {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(160px, 1fr));
            gap: 12px;
        }
    </style>

    <div class="container py-4 py-md-5">
        <div class="hero-ribbon p-4 p-md-5 mb-4">
            <div class="d-flex flex-wrap justify-content-between align-items-start gap-3">
                <div>
                    <div class="pill mb-3">
                        <span class="material-symbols-outlined">credit_card</span>
                        <span>الدفع الآمن للهدايا</span>
                    </div>
                    <h1 class="h3 h-md2 fw-black mb-2" style="color:var(--text); font-weight:900;">اختر طريقة الدفع المناسبة لك</h1>
                    <p class="mb-0 text-secondary">أكمل هديتك بصفحة دفع أنيقة تدعم الكاش والبطاقات وتتماشى مع ألوان الهوية.</p>
                </div>
                <div class="d-flex align-items-center gap-2 text-secondary">
                    <span class="material-symbols-outlined text-warning">lock</span>
                    <span class="small">مشفر عبر Paymob • يدعم فيزا وماستركارد</span>
                </div>
            </div>
        </div>

        <div class="row g-4 align-items-start">
            <div class="col-12 col-lg-7">
                <form action="{{ route('gifts.pay', $product) }}" method="POST" class="h-100">
                    @csrf
                    <input type="hidden" name="payment_method" id="paymentMethod" value="{{ $method }}">
                    @if ($box)
                        <input type="hidden" name="box_selection" value="{{ $box->id }}">
                    @endif
                    @foreach ($displayAddons as $addon)
                        <input type="hidden" name="addons[]" value="{{ $addon->id }}">
                    @endforeach
                    @if ($useCard && $card)
                        <input type="hidden" name="gift_card" value="{{ $card->id }}">
                    @endif
                    <input type="hidden" name="include_card" value="{{ $useCard ? 1 : 0 }}">
                    <input type="hidden" name="message" value="{{ $message }}">

                    <div class="d-flex flex-column gap-3">
                        <div class="pay-card p-4 position-relative wavy {{ $method === 'card' ? 'is-active' : '' }}"
                            data-method-card>
                            <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="material-symbols-outlined text-danger">credit_card</span>
                                    <div>
                                        <div class="fw-bold">الدفع أونلاين (بطاقات Visa / MasterCard)</div>
                                        <div class="text-secondary small">إعادة توجيه لبوابة Paymob الآمنة</div>
                                    </div>
                                </div>
                                <div class="badge-soft">موصى به</div>
                            </div>
                            <div class="d-flex align-items-center gap-3 mt-3 flex-wrap">
                                <div class="d-flex align-items-center gap-2 text-secondary small">
                                    <span class="material-symbols-outlined text-success">verified_user</span>
                                    <span>3D Secure</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 text-secondary small">
                                    <span class="material-symbols-outlined text-info">update</span>
                                    <span>تأكيد فوري</span>
                                </div>
                                <div class="d-flex align-items-center gap-2 text-secondary small">
                                    <span class="material-symbols-outlined text-warning">payments</span>
                                    <span>يدعم البطاقات البنكية</span>
                                </div>
                            </div>
                        </div>

                        <div class="pay-card p-4 glass {{ $method === 'cash' ? 'is-active' : '' }}" data-method-cash>
                            <div class="d-flex align-items-center justify-content-between gap-2 flex-wrap">
                                <div class="d-flex align-items-center gap-2">
                                    <span class="material-symbols-outlined text-primary">local_shipping</span>
                                    <div>
                                        <div class="fw-bold">الدفع كاش عند الاستلام</div>
                                        <div class="text-secondary small">ندعم الدفع النقدي مع توثيق الطلب</div>
                                    </div>
                                </div>
                                <div class="badge-soft" style="background:rgba(53, 162, 76, .1); color:#2b8c42;">بدون رسوم إضافية</div>
                            </div>
                            <div class="mt-3 text-secondary small">سيتم تأكيد الطلب وإرساله مع إمكانية الدفع نقداً عند الوصول.</div>
                        </div>

                        @isset($cashBill)
                            <div class="alert alert-success border-0 rounded-4 shadow-sm mb-0">
                                <div class="d-flex align-items-start gap-2">
                                    <span class="material-symbols-outlined">task_alt</span>
                                    <div>
                                        <div class="fw-bold">تم إنشاء طلب الدفع كاش</div>
                                        <div class="small mb-1">رقم المتابعة: {{ $cashBill['id'] ?? '—' }}</div>
                                        <div class="small text-secondary">{{ $cashBill['message'] ?? 'تم تسجيل الطلب بنجاح.' }}</div>
                                    </div>
                                </div>
                            </div>
                        @endisset

                        <div class="d-flex gap-3 flex-wrap">
                            <a href="{{ route('gifts.index', $product) }}" class="btn btn-light rounded-pill px-4">
                                الرجوع لتعديل الهدية
                            </a>
                            <button type="submit" class="btn btn-primary rounded-pill px-4 shadow"
                                id="payCta"
                                style="box-shadow:0 16px 30px rgba(238,43,91,.25)!important;">
                                {{ $method === 'cash' ? 'تأكيد الدفع كاش' : 'إتمام الدفع أونلاين' }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>

            <div class="col-12 col-lg-5">
                <div class="summary p-4 bg-white">
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <div class="fw-bold">ملخص الطلب</div>
                        <span class="badge-soft">{{ $product->category->name ?? 'منتج' }}</span>
                    </div>

                    <div class="d-flex align-items-center gap-3 mb-3">
                        @php
                            $primaryImage = $product->images->first();
                            $imgUrl = $primaryImage ? asset('storage/' . ltrim($primaryImage->path, '/')) : null;
                        @endphp
                        @if ($imgUrl)
                            <img src="{{ $imgUrl }}" alt="{{ $product->name }}" class="rounded-3"
                                style="width:72px;height:72px;object-fit:cover;">
                        @else
                            <div class="rounded-3 d-flex align-items-center justify-content-center"
                                style="width:72px;height:72px;background:rgba(238,43,91,.08);">
                                <span class="material-symbols-outlined text-danger">inventory_2</span>
                            </div>
                        @endif
                        <div>
                            <div class="fw-bold">{{ $product->name }}</div>
                            <div class="small text-secondary">{{ number_format($product->price, 2) }} ج.م</div>
                        </div>
                    </div>

                    <div class="border rounded-3 p-3 mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-secondary small">صندوق التغليف</span>
                            <span class="fw-bold">{{ $box?->name ?? 'بدون صندوق' }}</span>
                            <span class="fw-bold font-numbers">{{ number_format($boxCost, 2) }} ج.م</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <span class="text-secondary small">الإضافات</span>
                            <span class="fw-bold">
                                @if ($displayAddons->isNotEmpty())
                                    {{ $displayAddons->pluck('name')->join('، ') }}
                                @else
                                    بدون إضافات
                                @endif
                            </span>
                            <span class="fw-bold font-numbers">{{ number_format($totalAddons, 2) }} ج.م</span>
                        </div>
                        <div class="d-flex justify-content-between align-items-center">
                            <span class="text-secondary small">كارت الإهداء</span>
                            <span class="fw-bold">{{ $useCard ? ($card->name ?? 'كارت افتراضي') : 'بدون كارت' }}</span>
                            <span class="fw-bold font-numbers">{{ number_format($cardCost, 2) }} ج.م</span>
                        </div>
                    </div>

                    @if (!empty($message))
                        <div class="p-3 rounded-3 bg-light mb-3">
                            <div class="small text-secondary mb-1">رسالة الإهداء</div>
                            <div class="fw-bold">{{ $message }}</div>
                        </div>
                    @endif

                    <div class="d-flex justify-content-between align-items-center">
                        <span class="fw-bold">الإجمالي</span>
                        <span class="display-6 fw-black" style="color:var(--primary); font-weight:900;">
                            {{ number_format($grandTotal, 2) }} ج.م
                        </span>
                    </div>

                    <hr>

                    <div class="trust mt-3">
                        <div class="d-flex gap-2 align-items-center">
                            <span class="material-symbols-outlined text-success">verified</span>
                            <span class="small text-secondary">حماية معاملات PCI-DSS</span>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <span class="material-symbols-outlined text-primary">support_agent</span>
                            <span class="small text-secondary">دعم مباشر عند الدفع</span>
                        </div>
                        <div class="d-flex gap-2 align-items-center">
                            <span class="material-symbols-outlined text-warning">shield_lock</span>
                            <span class="small text-secondary">توثيق فوري للطلب</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const methodInput = document.getElementById('paymentMethod');
        const payCard = document.querySelector('[data-method-card]');
        const payCash = document.querySelector('[data-method-cash]');
        const payCta = document.getElementById('payCta');

        const activate = (method) => {
            methodInput.value = method;
            payCard.classList.toggle('is-active', method === 'card');
            payCash.classList.toggle('is-active', method === 'cash');
            payCta.textContent = method === 'cash' ? 'تأكيد الدفع كاش' : 'إتمام الدفع أونلاين';
        };

        payCard?.addEventListener('click', () => activate('card'));
        payCash?.addEventListener('click', () => activate('cash'));
    });
</script>
