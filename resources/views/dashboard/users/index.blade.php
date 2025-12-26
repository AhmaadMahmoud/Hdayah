@extends('dashboard.layouts.master')

@section('content_dash')
    <div class="content-scroll p-3 p-md-4">
        <div class="container-fluid" style="max-width:1280px;">
            <div class="d-flex flex-column gap-4 gap-md-5">

                <header class="d-flex flex-column flex-md-row align-items-md-center justify-content-between gap-3">
                    <div>
                        <h1 class="display-6 fw-black m-0" style="font-weight:900;">إدارة المستخدمين</h1>
                        <p class="text-sec mb-0">تحكم في صلاحيات الحسابات واضبط أدوار الأدمن والمستخدمين.</p>
                    </div>
                </header>

                @if (session('status'))
                    <div class="alert alert-success rounded-xl border-0" role="alert">
                        {{ session('status') }}
                    </div>
                @endif

                <div class="panel rounded-xl shadow-sm overflow-hidden">
                    <div class="table-responsive">
                        <table class="table table-hover align-middle m-0 text-end">
                            <thead>
                                <tr style="background: var(--surface-hi);">
                                    <th class="px-4 py-3 text-secondary-custom small fw-bold">الاسم</th>
                                    <th class="px-4 py-3 text-secondary-custom small fw-bold">البريد</th>
                                    <th class="px-4 py-3 text-secondary-custom small fw-bold">الدور</th>
                                    <th class="px-4 py-3 text-secondary-custom small fw-bold text-center">تحكم</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($users as $user)
                                    <tr>
                                        <td class="px-4 py-3 fw-bold">{{ $user->name }}</td>
                                        <td class="px-4 py-3 text-secondary-custom">{{ $user->email }}</td>
                                        <td class="px-4 py-3 fw-semibold">
                                            <span class="badge rounded-pill"
                                                style="background: {{ $user->role === 'admin' ? '#fff1e6' : '#e5edff' }}; color: {{ $user->role === 'admin' ? '#ea580c' : '#1d4ed8' }};">
                                                {{ $user->role === 'admin' ? 'أدمن' : 'مستخدم' }}
                                            </span>
                                        </td>
                                        <td class="px-4 py-3 text-center">
                                            <form class="d-inline-flex gap-2 align-items-center justify-content-center"
                                                method="POST" action="{{ route('dashboard.users.update-role', $user) }}">
                                                @csrf
                                                @method('PATCH')
                                                <select name="role" class="form-select form-select-sm rounded-xl border-0"
                                                    style="min-width: 140px; background: var(--surface-hi);">
                                                    <option value="user" @selected($user->role === 'user')>مستخدم</option>
                                                    <option value="admin" @selected($user->role === 'admin')>أدمن</option>
                                                </select>
                                                <button class="btn btn-sm text-white rounded-xl px-3"
                                                    style="background: var(--primary); border:0;">
                                                    حفظ
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="4" class="px-4 py-4 text-center text-secondary-custom">لا يوجد مستخدمون.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
