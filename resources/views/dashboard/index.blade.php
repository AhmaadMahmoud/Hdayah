@extends('dashboard.layouts.master')
@section('content_dash')
    <div class="content-scroll p-3 p-md-4">
        <div class="container-fluid" style="max-width: 1280px;">
            <div class="d-flex flex-column gap-4 gap-md-5">

                <!-- KPI -->
                <section class="row g-3 g-md-4">
                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="kpi-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="p-2 rounded-xl" style="background:#eff6ff; color:#2563eb;">
                                    <span class="material-symbols-outlined">shopping_bag</span>
                                </div>
                            </div>
                            <div class="text-sec small fw-semibold mb-1">إجمالي الطلبات</div>
                            <div class="display-6 fw-bold m-0" style="font-size:2rem;">{{ $stats['orders_count'] ?? 0 }}</div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="kpi-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="p-2 rounded-xl" style="background: rgba(238,173,43,.10); color: var(--primary);">
                                    <span class="material-symbols-outlined">payments</span>
                                </div>
                            </div>
                            <div class="text-sec small fw-semibold mb-1">إيرادات الطلبات</div>
                            <div class="fw-bold" style="font-size:2rem;">
                                {{ number_format($stats['revenue'] ?? 0, 2) }}
                                <span class="text-sec" style="font-size:1rem; font-weight:500;">ج.م</span>
                            </div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="kpi-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="p-2 rounded-xl" style="background:#f3e8ff; color:#7c3aed;">
                                    <span class="material-symbols-outlined">local_shipping</span>
                                </div>
                            </div>
                            <div class="text-sec small fw-semibold mb-1">طلبات الكاش</div>
                            <div class="display-6 fw-bold m-0" style="font-size:2rem;">{{ $stats['cash_count'] ?? 0 }}</div>
                        </div>
                    </div>

                    <div class="col-12 col-sm-6 col-lg-3">
                        <div class="kpi-card">
                            <div class="d-flex justify-content-between align-items-start mb-3">
                                <div class="p-2 rounded-xl" style="background:#fff7ed; color:#ea580c;">
                                    <span class="material-symbols-outlined">credit_card</span>
                                </div>
                            </div>
                            <div class="text-sec small fw-semibold mb-1">طلبات الدفع أونلاين</div>
                            <div class="display-6 fw-bold m-0" style="font-size:2rem;">{{ $stats['card_count'] ?? 0 }}</div>
                        </div>
                    </div>
                </section>

                <!-- Latest orders -->
                <section>
                    <div class="d-flex align-items-center justify-content-between mb-3">
                        <h3 class="h5 fw-bold m-0">أحدث الطلبات</h3>
                    </div>

                    <div class="card border-0 shadow-sm">
                        <div class="table-responsive">
                            <table class="table align-middle mb-0">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>المنتج</th>
                                        <th>العميل</th>
                                        <th>طريقة الدفع</th>
                                        <th>الإجمالي</th>
                                        <th>الحالة</th>
                                        <th>التفاصيل</th>
                                        <th>التاريخ</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($orders ?? [] as $order)
                                        <tr>
                                            <td>{{ $order->id }}</td>
                                            <td>{{ $order->product->name ?? '-' }}</td>
                                            <td>{{ $order->user->name ?? 'ضيف' }}</td>
                                            <td class="text-capitalize">{{ $order->payment_method }}</td>
                                            <td>{{ number_format($order->total, 2) }} ج.م</td>
                                            <td>
                                                <span class="badge bg-light text-dark">{{ $order->status }}</span>
                                            </td>
                                            <td class="small">
                                                <div>صندوق: {{ $order->meta['box_name'] ?? '-' }} ({{ number_format($order->meta['box_price'] ?? 0, 2) }} ج.م)</div>
                                                @php
                                                    $addons = collect($order->meta['addons'] ?? []);
                                                    $addonsTotal = $addons->sum('price');
                                                    $addonsList = $addons->map(fn($a) => ($a['name'] ?? '-') . ' (' . number_format($a['price'] ?? 0, 2) . ' ج.م)')->join('، ');
                                                @endphp
                                                <div>إضافات: {{ $addonsList ?: 'بدون' }}</div>

                                                <div>كارت: {{ ($order->meta['include_card'] ?? false) ? ($order->meta['card_name'] ?? 'كارت') : 'بدون كارت' }} @if(($order->meta['include_card'] ?? false)) ({{ number_format($order->meta['card_price'] ?? 0, 2) }} ج.م) @endif</div>
                                                @if(!empty($order->meta['message']))
                                                    <div class="text-muted">رسالة: {{ $order->meta['message'] }}</div>
                                                @endif
                                            </td>
                                            <td>{{ $order->created_at?->format('Y-m-d H:i') }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center text-muted py-4">لا توجد طلبات بعد</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>

                        @if (($orders ?? null) && method_exists($orders, 'links'))
                            <div class="p-3">
                                {{ $orders->links() }}
                            </div>
                        @endif
                    </div>
                </section>

            </div>
        </div>
    </div>
@endsection
