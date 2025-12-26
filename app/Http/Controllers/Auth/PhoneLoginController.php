<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;
use Illuminate\View\View;

class PhoneLoginController extends Controller
{
    public function show(): View
    {
        return view('auth.phone');
    }

    public function sendCode(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'phone' => ['required', 'string', 'max:30'],
        ]);

        $code = random_int(100000, 999999);
        $key = $this->cacheKey($data['phone']);
        Cache::put($key, $code, now()->addMinutes(10));

        // TODO: integrate SMS provider. For now, show in session for demo.
        return back()->with(['status' => 'تم إرسال رمز الدخول', 'dev_code' => $code, 'phone' => $data['phone']]);
    }

    public function verify(Request $request): RedirectResponse
    {
        $data = $request->validate([
            'phone' => ['required', 'string', 'max:30'],
            'code' => ['required', 'digits:6'],
        ]);

        $key = $this->cacheKey($data['phone']);
        $cached = Cache::get($key);

        if (!$cached || $cached != $data['code']) {
            return back()->withErrors(['code' => 'رمز غير صحيح أو منتهي'])->withInput();
        }

        Cache::forget($key);

        $user = User::firstOrCreate(
            ['phone' => $data['phone']],
            [
                'name' => 'مستخدم ' . Str::random(4),
                'email' => Str::slug($data['phone']) . '@local',
                'password' => bcrypt(Str::random(32)),
                'role' => 'user',
            ]
        );

        Auth::login($user, true);

        $target = $user->role === 'admin' ? route('dashboard', absolute: false) : route('home', absolute: false);

        return redirect()->intended($target);
    }

    private function cacheKey(string $phone): string
    {
        return 'phone_login_' . md5($phone);
    }
}
